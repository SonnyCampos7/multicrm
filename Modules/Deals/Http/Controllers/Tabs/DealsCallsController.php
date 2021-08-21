<?php

namespace Modules\Deals\Http\Controllers\Tabs;


use Modules\Calls\Entities\Call;
use Modules\Deals\Datatables\Tabs\DealsCallsDatatable;
use Modules\Deals\Entities\Deal;
use Modules\Platform\Core\Datatable\Scope\BasicRelationScope;
use Modules\Platform\Core\Http\Controllers\ModuleCrudRelationController;


class DealsCallsController extends ModuleCrudRelationController
{
    protected $datatable = DealsCallsDatatable::class;

    protected $ownerModel = Deal::class;

    protected $relationModel = Call::class;

    protected $ownerModuleName = 'deals';

    protected $relatedModuleName = 'calls';

    protected $scopeLinked = BasicRelationScope::class;

    protected $relationType = self::RT_ONE_TO_MANY;

    protected $belongsToName = 'deal';

    protected $whereCondition = 'calls.deal_id';

    protected $whereType = self::WHERE_TYPE__COLUMN;
}
