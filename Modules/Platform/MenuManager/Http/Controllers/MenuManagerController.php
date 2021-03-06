<?php

namespace Modules\Platform\MenuManager\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Modules\Platform\Core\Http\Controllers\AppBaseController;
use Modules\Platform\MenuManager\Helper\MenuHelper;
use Modules\Platform\MenuManager\Http\Forms\MenuForm;
use Modules\Platform\MenuManager\Http\Requests\SaveMenuElementRequest;
use Modules\Platform\MenuManager\Repositories\MenuRepository;

/**
 * Class MenuManagerController
 * @package Modules\Platform\MenuManager\Http\Controllers
 */
class MenuManagerController extends AppBaseController
{
    use FormBuilderTrait;

    /**
     * @var MenuRepository
     */
    private $repo;

    /**
     * MenuManagerController constructor.
     * @param MenuRepository $repository
     */
    public function __construct(MenuRepository $repository)
    {
        parent::__construct();

        $this->repo = $repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $view = view('menumanager::index');

        $menuForm = $this->form(MenuForm::class, [
            'method' => 'POST',
            'url' => route('settings.menu_manager.create_element'),
            'id' => 'save_menu_element_form'
        ]);

        $view->with('mainMenu', $this->repo->getMainMenu());
        $view->with('menuForm', $menuForm);

        return $view;
    }

    /**
     * Create Menu Element and redirect to menu manager
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createMenuElement()
    {
        if (config('bap.demo')) {
            flash(trans('core::core.you_cant_do_that_its_demo'))->error();
            return redirect()->back();
        }

        $this->repo->create([
            'label' => 'example',
            'url' => '#',
            'icon' => 'settings',
            'permission' => '',
            'order_by' => 0,
            'visibility' => 0,
            'dont_translate' => 0
        ]);

        flash(trans('menumanager::menu_manager.created'))->info();

        return redirect()->route('settings.menu_manager.index');
    }

    /**
     * Ajax get menu element to edit
     *
     * @param $identifier
     * @return JsonResponse
     */
    public function getMenuElement($identifier)
    {
        $entity = $this->repo->find($identifier);

        if (empty($entity)) {
            return \response()->json([

            ]);
        } else {
            return response()->json([
                'menu_element' => $entity->toArray(),
            ]);
        }
    }

    /**
     * Removed
     * @param $id
     * @return JsonResponse
     */
    public function deleteElement($id)
    {
        if(config('bap.demo')){
            return response()->json([
                'type' => 'error',
                'message' => trans('core::core.you_cant_do_that_its_demo'),
                'action' => 'none',
                'color' => 'bg-red'
            ]);
        }

        // remove entity
        $this->repo->delete($id);

        // clear menu cache
        \Cache::forget(MenuHelper::MAIN_MENU_CACHE_KEY);

        return response()->json([
            'message' => trans('menumanager::menu_manager.deleted'),
            'color' => 'bg-orange'
        ]);
    }

    /**
     * Update Order From Request
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateOrder(Request $request)
    {
        $elements = json_decode($request->get('order'), true);

        if(config('bap.demo')){
            return response()->json([
                'type' => 'error',
                'message' => trans('core::core.you_cant_do_that_its_demo'),
                'action' => 'none',
                'color' => 'bg-red'
            ]);
        }

        // clear menu cache
        \Cache::forget(MenuHelper::MAIN_MENU_CACHE_KEY);

        try {
            $order = 1;
            foreach ($elements as $element) {
                $this->updateMenuOrder($element, $order, null);
                $order++;
            }
            return response()->json([
                'message' => trans('menumanager::menu_manager.success'),
                'color' => 'bg-green'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => trans('menumanager::menu_manager.error'),
                'color' => 'bg-red'
            ]);
        }
    }

    /**
     * Recursive update of menu order
     * @param $element
     * @param $order
     * @param $parent
     */
    private function updateMenuOrder($element, $order, $parent)
    {
        $menuItem = $this->repo->find($element['id']);

        $menuItem->order_by = $order;
        $menuItem->parent_id = $parent;

        $menuItem->update();

        if (isset($element['children'])) {
            $orderChild = 1;
            foreach ($element['children'] as $child) {
                $this->updateMenuOrder($child, $orderChild, $menuItem->id);
                $orderChild++;
            }
        }
    }

    /**
     * Update Or Create Menu Element
     *
     * @param SaveMenuElementRequest $request
     * @return JsonResponse
     */
    public function saveElement(SaveMenuElementRequest $request)
    {

        if(config('bap.demo')){
            return response()->json([
                'type' => 'error',
                'message' => trans('core::core.you_cant_do_that_its_demo'),
                'action' => 'none',
                'color' => 'bg-red'
            ]);
        }

        $form = $this->form(MenuForm::class);

        $id = $request->get($form->getField('id')->getName());

        // clear menu cache
        \Cache::forget(MenuHelper::MAIN_MENU_CACHE_KEY);

        try {
            if ($id > 0) {
                $this->repo->update([
                    'label' => $request->get($form->getField('label')->getName()),
                    'url' => $request->get($form->getField('url')->getName()),
                    'icon' => $request->get($form->getField('icon')->getName()),
                    'permission' => $request->get($form->getField('permission')->getName()),
                    'dont_translate' => $request->get($form->getField('dont_translate')->getName()),
                    'visibility' => $request->get($form->getField('visibility')->getName()),
                ], $id);

                return response()->json([
                    'message' => trans('menumanager::menu_manager.success'),
                    'color' => 'bg-green',
                    'id' => $id,
                    'label' => $request->get($form->getField('label')->getName())
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => trans('menumanager::menu_manager.error'),
                'color' => 'bg-red'
            ]);
        }
    }
}
