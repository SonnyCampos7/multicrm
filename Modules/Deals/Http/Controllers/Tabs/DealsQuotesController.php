<?php

namespace Modules\Deals\Http\Controllers\Tabs;


use Modules\Deals\Datatables\Tabs\DealsQuotesDatatable;
use Modules\Deals\Entities\Deal;
use Modules\Platform\Core\Datatable\Scope\BasicRelationScope;
use Modules\Platform\Core\Http\Controllers\ModuleCrudRelationController;
use Modules\Quotes\Entities\Quote;


class DealsQuotesController extends ModuleCrudRelationController
{
    protected $datatable = DealsQuotesDatatable::class;

    protected $ownerModel = Deal::class;

    protected $relationModel = Quote::class;

    protected $ownerModuleName = 'deals';

    protected $relatedModuleName = 'quotes';

    protected $scopeLinked = BasicRelationScope::class;

    protected $relationType = self::RT_ONE_TO_MANY;

    protected $belongsToName = 'deal';

    protected $whereCondition = 'quotes.deal_id';

    protected $whereType = self::WHERE_TYPE__COLUMN;
}
