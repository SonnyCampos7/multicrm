<?php

namespace Modules\Deals\Http\Controllers;

use Modules\Deals\Datatables\DealDatatable;
use Modules\Deals\Datatables\Tabs\DealsCallsDatatable;
use Modules\Deals\Datatables\Tabs\DealsContactsDatatable;
use Modules\Deals\Datatables\Tabs\DealsQuotesDatatable;
use Modules\Deals\Entities\Deal;
use Modules\Deals\Entities\DealStatus;
use Modules\Deals\Http\Forms\DealForm;
use Modules\Deals\Http\Requests\DealsRequest;
use Modules\Deals\Service\DealService;
use Modules\Platform\Core\Http\Controllers\ModuleCrudController;

class DealsController extends ModuleCrudController
{
    protected $datatable = DealDatatable::class;
    protected $formClass = DealForm::class;
    protected $storeRequest = DealsRequest::class;
    protected $updateRequest = DealsRequest::class;
    protected $entityClass = Deal::class;

    protected $moduleName = 'deals';

    protected $showMassActionButtons = true;

    protected $submitActionButtons = [];


    protected $permissions = [
        'browse' => 'deals.browse',
        'create' => 'deals.create',
        'update' => 'deals.update',
        'destroy' => 'deals.destroy'
    ];

    protected $moduleSettingsLinks = [

        ['route' => 'deals.stage.index', 'label' => 'settings.stage'],
        ['route' => 'deals.status.index', 'label' => 'settings.status'],
        ['route' => 'deals.businesstype.index', 'label' => 'settings.businesstype'],


    ];

    protected $settingsPermission = 'deals.settings';

    protected $relationTabs = [

        'contacts' => [
            'icon' => 'contacts',
            'permissions' => [
                'browse' => 'contacts.browse',
                'update' => 'contacts.update',
                'create' => 'contacts.create'
            ],
            'datatable' => [
                'datatable' => DealsContactsDatatable::class
            ],
            'route' => [
                'linked' => 'deals.contacts.linked',
                'create' => 'contacts.contacts.create',
                'select' => 'deals.contacts.selection',
                'bind_selected' => 'deals.contacts.link'
            ],
            'create' => [
                'allow' => false,
                'modal_title' => 'contacts::contacts.create_new',
                'post_create_bind' => [
                    'relationType' => 'manyToMany',
                    'relatedField' => 'campaigns',
                ]
            ],

            'select' => [
                'allow' => true,
                'modal_title' => 'contacts::contacts.module'
            ],

        ],

        'calls' => [
            'icon' => 'phone',
            'permissions' => [
                'browse' => 'calls.browse',
                'update' => 'calls.update',
                'create' => 'calls.create'
            ],
            'datatable' => [
                'datatable' => DealsCallsDatatable::class
            ],
            'route' => [
                'linked' => 'deals.calls.linked',
                'create' => 'calls.calls.create',
                'select' => 'deals.calls.selection',
                'bind_selected' => 'deals.calls.link'
            ],
            'create' => [
                'allow' => true,
                'modal_title' => 'calls::calls.create_new',
                'post_create_bind' => [
                    'relationType' => 'oneToMany',
                    'relatedField' => 'deal_id',
                ]
            ],

            'select' => [
                'allow' => true,
                'modal_title' => 'calls::calls.module'
            ],

        ],

        'quotes' => [
            'icon' => 'chat',
            'permissions' => [
                'browse' => 'quotes.browse',
                'update' => 'quotes.update',
                'create' => 'quotes.create'
            ],
            'datatable' => [
                'datatable' => DealsQuotesDatatable::class
            ],
            'route' => [
                'linked' => 'deals.quotes.linked',
                'create' => 'quotes.quotes.create',
                'select' => 'deals.quotes.selection',
                'bind_selected' => 'deals.quotes.link'
            ],
            'create' => [
                'allow' => true,
                'modal_title' => 'quotes::quotes.create_new',
                'post_create_bind' => [
                    'relationType' => 'oneToMany',
                    'relatedField' => 'deal_id',
                ]
            ],

            'select' => [
                'allow' => true,
                'modal_title' => 'quotes::quotes.module'
            ],

        ],
    ];


    protected $showFields = [

        'information' => [

            'name' => [
                'type' => 'text',

            ],

            'percentage' => [
                'type' => 'percent',
            ],


            'owned_by' => [
                'type' => 'assigned_to',
            ],


            'amount' => [
                'type' => 'text',
            ],


            'closing_date' => [
                'type' => 'date',
            ],


            'probability' => [
                'type' => 'text',
            ],


            'expected_revenue' => [
                'type' => 'text',
            ],


            'next_step' => [
                'type' => 'text',
            ],


            'deal_stage_id' => [
                'type' => 'manyToOne',
                'relation' => 'dealStage',
                'column' => 'name'
            ],

            'deal_status_id' => [
                'type' => 'manyToOne',
                'relation' => 'dealStatus',
                'column' => 'name'
            ],

            'deal_business_type_id' => [
                'type' => 'manyToOne',
                'relation' => 'dealBusinessType',
                'column' => 'name'
            ],

            'account_id' => [
                'type' => 'manyToOne',
                'relation' => 'account',
                'column' => 'name',
                'dont_translate' => true,
                'route' => 'accounts.accounts.show'
            ],

        ],


        'notes' => [

            'notes' => [
                'type' => 'text',
                'col-class' => 'col-lg-12 col-md-12 col-sm-12'
            ],

        ],


    ];

    protected $languageFile = 'deals::deals';

    protected $routes = [
        'index' => 'deals.deals.index',
        'create' => 'deals.deals.create',
        'show' => 'deals.deals.show',
        'edit' => 'deals.deals.edit',
        'store' => 'deals.deals.store',
        'destroy' => 'deals.deals.destroy',
        'update' => 'deals.deals.update'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    protected function setupActionButtons()
    {
        $this->actionButtons[] = array(
            'href' => route($this->routes['create'], ['copy' => $this->entity->id]),
            'attr' => [

            ],
            'label' => trans('core::core.btn.copy')
        );
        $this->actionButtons[] = array(
            'href' => route('deals.deals.convert.to.quote', ['id' => $this->entity->id]),
            'attr' => [

            ],
            'label' => trans('deals::deals.convert_to_quote')
        );


        foreach (DealStatus::all() as $status) {
            $this->submitActionButtons[] = array(
                'href' => route('deals.submit.status', ['id' => $this->entity->id, 'status' => $status->id]),
                'attr' => [

                ],
                'label' => $status->step_name
            );
        }


        $this->showView->with('submitButtons', $this->submitActionButtons);
    }


    public function submitStatus($id, $status)
    {
        if ($this->permissions['browse'] != '' && !\Auth::user()->hasPermissionTo($this->permissions['browse'])) {
            flash(trans('core::core.you_dont_have_access'))->error();
            return redirect()->route($this->routes['index']);
        }

        $repository = $this->getRepository();

        $entity = $repository->find($id);

        $this->entity = $entity;

        if (empty($entity)) {
            flash(trans('core::core.entity.entity_not_found'))->error();
            return redirect(route($this->routes['index']));
        }

        if ($this->blockEntityOwnableAccess()) {
            flash(trans('core::core.you_dont_have_access'))->error();
            return redirect()->route($this->routes['index']);
        }

        $status = DealStatus::findOrFail($status);

        $entity->dealStatus()->associate($status);
        $entity->changeOwnerTo($status->getOwner());
        $entity->save();

        flash(trans('core::core.entity.updated'))->success();

        return redirect(route($this->routes['show'], $entity));
    }


    public function convertToQuote($dealId)
    {

        if ($this->permissions['create'] != '' && !\Auth::user()->hasPermissionTo($this->permissions['create'])) {
            flash(trans('core::core.you_dont_have_access'))->error();
            return redirect()->route($this->routes['index']);
        }

        $dealService = \App::make(DealService::class);

        $quote = $dealService->convertToQuote($dealId);

        if (!empty($quote)) {
            flash(trans('core::core.record_converted'))->success();

            return redirect()->route('quotes.quotes.show', $quote->id);
        }

        flash(trans('core::core.error_while_converting'))->error();
        return redirect()->route($this->routes['index']);
    }
}
