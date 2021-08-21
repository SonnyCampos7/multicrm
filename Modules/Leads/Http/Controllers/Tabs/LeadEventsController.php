<?php

namespace Modules\Leads\Http\Controllers\Tabs;


use Modules\Calendar\Entities\Event;
use Modules\Leads\Datatables\Tabs\LeadEventsDatatable;
use Modules\Leads\Entities\Lead;
use Modules\Platform\Core\Datatable\Scope\BasicRelationScope;
use Modules\Platform\Core\Http\Controllers\ModuleCrudRelationController;

/**
 * Class LeadEventsController
 * @package Modules\Leads\Http\Controllers\Tabs
 */
class LeadEventsController extends ModuleCrudRelationController
{
    protected $datatable = LeadEventsDatatable::class;

    protected $ownerModel = Lead::class;

    protected $relationModel = Event::class;

    protected $ownerModuleName = 'leads';

    protected $relatedModuleName = 'calendar';

    protected $scopeLinked = BasicRelationScope::class;

    protected $modelRelationName = 'events';

    protected $relationType = self::RT_ONE_TO_MANY;

    protected $belongsToName = 'lead';

    protected $whereCondition = 'bap_calendar_event.lead_id';

    protected $whereType = self::WHERE_TYPE__COLUMN;

}
