<?php

namespace Modules\Deals\Http\Controllers\Settings;

use Modules\Deals\Datatables\Settings\DealStatusDatatable;
use Modules\Deals\Entities\DealStatus;
use Modules\Deals\Http\Forms\DealStatusForm;
use Modules\Deals\Http\Requests\DealsStatusRequest;
use Modules\Platform\Core\Http\Controllers\ModuleCrudController;

class StatusController extends ModuleCrudController
{
    protected $datatable = DealStatusDatatable::class;
    protected $formClass = DealStatusForm::class;
    protected $storeRequest = DealsStatusRequest::class;
    protected $updateRequest = DealsStatusRequest::class;
    protected $entityClass = DealStatus::class;

    protected $disableWidgets = true;

    protected $moduleDictionary = true;

    protected $moduleName = 'deals';

    protected $permissions = [
        'browse' => 'deals.settings',
        'create' => 'deals.settings',
        'update' => 'deals.settings',
        'destroy' => 'deals.settings'
    ];

    protected $settingsBackRoute = 'deals.deals.index';

    protected $showFields = [
        'details' => [
            'name' => ['type' => 'text', 'col-class' => 'col-lg-4 col-md-4 col-sm-4'],
            'step_name' => ['type' => 'text', 'col-class' => 'col-lg-4 col-md-4 col-sm-4'],

            'owned_by' => [
                'type' => 'assigned_to',
                'col-class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ],
        'notes' => [

            'description' => [
                'type' => 'text',
                'col-class' => 'col-lg-12 col-md-12 col-sm-12'
            ],

        ],

    ];

    protected $languageFile = 'deals::deals.status';

    protected $routes = [
        'index' => 'deals.status.index',
        'create' => 'deals.status.create',
        'show' => 'deals.status.show',
        'edit' => 'deals.status.edit',
        'store' => 'deals.status.store',
        'destroy' => 'deals.status.destroy',
        'update' => 'deals.status.update'
    ];

    public function __construct()
    {
        parent::__construct();
    }

}
