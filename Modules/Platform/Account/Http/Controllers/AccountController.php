<?php

namespace Modules\Platform\Account\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Modules\Platform\Account\Datatables\ActivityLogDatatable;
use Modules\Platform\Account\Dto\EmailSettingsDTO;
use Modules\Platform\Account\Http\Forms\AccountForm;
use Modules\Platform\Account\Http\Forms\ChangePasswordForm;
use Modules\Platform\Account\Http\Forms\DashboardWidgetsForm;
use Modules\Platform\Account\Http\Forms\MailSettingsForm;
use Modules\Platform\Account\Http\Requests\AccountChangePasswordRequest;
use Modules\Platform\Account\Http\Requests\AccountUpdateRequest;
use Modules\Platform\Account\Http\Requests\DashboardWidgetsRequest;
use Modules\Platform\Account\Http\Requests\MailSettingsRequest;
use Modules\Platform\Account\Repositories\AccountRepository;
use Modules\Platform\Account\Service\AccountService;
use Modules\Platform\Account\Service\UserDashboardWidgetsService;
use Modules\Platform\Account\Service\UserMailService;
use Modules\Platform\Core\Datatable\Scope\UserActivityScope;
use Modules\Platform\Core\Helper\UserHelper;
use Modules\Platform\Core\Http\Controllers\AppBaseController;

/**
 * Class AccountController
 * @package Modules\Platform\Account\Http\Controllers
 */
class AccountController extends AppBaseController
{
    use FormBuilderTrait;

    private $accountRepo;

    private $userMailService;

    private $accountService;

    private $userDashboardService;

    public function __construct(
        AccountRepository $repository,
        UserMailService $mailService,
        AccountService $accountService,
        UserDashboardWidgetsService $dashboardWidgetsService
    )
    {
        parent::__construct();

        $this->accountRepo = $repository;
        $this->userMailService = $mailService;
        $this->accountService = $accountService;
        $this->userDashboardService = $dashboardWidgetsService;
    }


    /**
     * Show preferences
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function preferences(ActivityLogDatatable $datatable)
    {
        $datatable->addScope(new UserActivityScope(\Auth::user()->id));

        $accountForm = $this->form(AccountForm::class, [
            'method' => 'POST',
            'url' => route('account.update'),
            'id' => 'account_update_form',
            'model' => \Auth::user()->toArray(),
        ]);

        $passwordForm = $this->form(ChangePasswordForm::class, [
            'method' => 'POST',
            'url' => route('account.password'),
            'id' => 'account_password_form',
        ]);

        $mailSettings = $this->form(MailSettingsForm::class, [
            'method' => 'POST',
            'url' => route('account.mail_settings'),
            'id' => 'mail_settings_form',
            'model' => $this->userMailService->getSettings()
        ]);


        $dashboardWidgets = $this->form(DashboardWidgetsForm::class, [
            'method' => 'POST',
            'url' => route('account.dashboard-widgets'),
            'id' => 'dashboard_widgets_form',
            'model' => $this->userDashboardService->getSettings(\Auth::user()->id)
        ]);

        return $datatable->render('account::preferences', [
            'accountForm' => $accountForm,
            'passwordForm' => $passwordForm,
            'mailSettingsForm' => $mailSettings,
            'dashboardWidgets' => $dashboardWidgets
        ]);
    }


    /**
     * @param AccountUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateAccount(AccountUpdateRequest $request)
    {
        $user = \Auth::user();

        if (config('bap.demo')) {
            flash(trans('core::core.you_cant_do_that_its_demo'))->error();
            return redirect()->back();
        }

        // UPLOAD PROFILE PICTURE
        $profilePicture = $request->file('profile_picture');

        $this->accountRepo->update($request->all(), $user->id);

        if ($profilePicture != null) {
            $image = 'profile_' . $user->id . '_.' . $profilePicture->getClientOriginalExtension();

            $uploadSuccess = $profilePicture->move(UserHelper::PROFILE_PICTURE_UPLOAD, $image);

            if ($uploadSuccess) {
                // Resize uploaded image to 100x100
                $img = Image::make(base_path() . '/public/' . UserHelper::PROFILE_PICTURE_UPLOAD . $image)->resize(
                    100,
                    100
                );
                $img->save(base_path() . '/public/' . UserHelper::PROFILE_PICTURE_UPLOAD . $image);

                $this->accountRepo->update([
                    'profile_image_path' => $image
                ], $user->id);
            }
        }

        flash(trans('account::account.updated'))->success();

        return redirect(url('account#preferences'));
    }

    /**
     * @param AccountChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changePassword(AccountChangePasswordRequest $request)
    {
        $user = \Auth::user();

        if (config('bap.demo')) {
            flash(trans('core::core.you_cant_do_that_its_demo'))->error();
            return redirect()->back();
        }

        $this->accountRepo->update([
            'password' => bcrypt($request->get('password'))
        ], $user->id);

        flash(trans('account::account.updated'))->success();

        return redirect(url('account#password'));
    }

    /**
     * Enable Disable Dashboard Widgets
     * @param DashboardWidgetsRequest $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function dashboardWidgets(DashboardWidgetsRequest $request)
    {
        $user = \Auth::user();

        if (config('bap.demo')) {
            flash(trans('core::core.you_cant_do_that_its_demo'))->error();
            return redirect()->back();
        }

        $values = $this->form(DashboardWidgetsForm::class)->getFieldValues(true);

        $this->userDashboardService->saveSettings($values, \Auth::user()->id);

        flash(trans('account::account.updated'))->success();

        return redirect(url('account#dashboard'));
    }

    public function generateApiKey()
    {
        $user = \Auth::user();

        if (config('bap.demo')) {
            flash(trans('core::core.you_cant_do_that_its_demo'))->error();
            return redirect()->back();
        }

        $this->accountService->generateApiKey($user->id);

        flash(trans('account::account.api_key_generated'))->success();

        return redirect(url('account#api_key'));
    }


    public function mailSettings(MailSettingsRequest $request)
    {

        $user = \Auth::user();

        if (config('bap.demo')) {
            flash(trans('core::core.you_cant_do_that_its_demo'))->error();
            return redirect()->back();
        }

        $values = $this->form(MailSettingsForm::class)->getFieldValues(true);

        $emailSettingsDto = new EmailSettingsDTO();
        $emailSettingsDto->map($values);

        $this->userMailService->saveSettings($emailSettingsDto);

        flash(trans('account::account.mail_settings_updated'))->success();

        return redirect(url('account#mail_settings'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxUpdateAccountSettings(Request $request)
    {
        $result = false;

        $auth = \Auth::user();

        $input = $request->all();

        if (isset($input['theme'])) {
            $auth->theme = $input['theme'];
            $auth->save();

            $result = true;
        }

        return response()->json([
            'result' => $result,
        ]);
    }
}
