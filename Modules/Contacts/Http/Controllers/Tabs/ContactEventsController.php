<?php

namespace Modules\Contacts\Http\Controllers\Tabs;


use Modules\Calendar\Entities\Event;
use Modules\Contacts\Datatables\Tabs\ContactEventsDatatable;
use Modules\Contacts\Entities\Contact;
use Modules\Leads\Datatables\Tabs\LeadEventsDatatable;
use Modules\Leads\Entities\Lead;
use Modules\Platform\Core\Datatable\Scope\BasicRelationScope;
use Modules\Platform\Core\Http\Controllers\ModuleCrudRelationController;

/**
 * Class ContactEventsController
 * @package Modules\Contacts\Http\Controllers\Tabs
 */
class ContactEventsController extends ModuleCrudRelationController
{
    protected $datatable = ContactEventsDatatable::class;

    protected $ownerModel = Contact::class;

    protected $relationModel = Event::class;

    protected $ownerModuleName = 'contacts';

    protected $relatedModuleName = 'calendar';

    protected $scopeLinked = BasicRelationScope::class;

    protected $modelRelationName = 'events';

    protected $relationType = self::RT_ONE_TO_MANY;

    protected $belongsToName = 'contact';

    protected $whereCondition = 'bap_calendar_event.contact_id';

    protected $whereType = self::WHERE_TYPE__COLUMN;

}
