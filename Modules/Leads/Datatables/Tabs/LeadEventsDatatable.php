<?php

namespace Modules\Leads\Datatables\Tabs;

use Modules\Calendar\Datatables\EventDatatable;
use Modules\Calendar\Entities\Event;
use Modules\Calls\Datatables\CallDatatable;
use Modules\Calls\Entities\Call;
use Modules\Platform\Core\Datatable\RelationDataTable;
use Modules\Platform\Core\Helper\DataTableHelper;
use Modules\Platform\Core\QueryBuilderParser\QueryBuilderParser;
use Modules\Tickets\Entities\Ticket;
use Yajra\DataTables\EloquentDataTable;

/**
 * Class LeadCallsDatatable
 * @package Modules\Contacts\Datatables\Tabs
 */
class LeadEventsDatatable extends RelationDataTable
{
    const SHOW_URL_ROUTE = 'calendar.events.show';

    protected $unlinkRoute = 'leads.events.unlink';

    protected $deleteRoute = 'leads.events.delete';

    protected $editRoute = 'calendar.events.edit';

    protected $editRouteAdditionalParams = [
        'quickEditModel' => true
    ];


    public static function availableColumns()
    {
        return [
            'name' => [
                'data' => 'name',
                'title' => trans('calendar::events.table.name'),
                'data_type' => 'text',
                'filter_type' => 'text'
            ],
            'status' => [
                'data' => 'status',
                'name' => 'bap_calendar_dict_event_status.name',
                'title' => trans('calendar::events.table.status'),
                'data_type' => 'text',
                'filter_type' => 'text'
            ],
            'priority' => [
                'data' => 'priority',
                'name' => 'bap_calendar_dict_event_priority.name',
                'title' => trans('calendar::events.table.priority'),
                'data_type' => 'text',
                'filter_type' => 'text'
            ],

            'start_date' => [
                'data' => 'start_date',
                'title' => trans('calendar::events.table.start_date'),
                'data_type' => 'datetime',
                'filter_type' => 'bap_date_range_picker',
            ],
            'end_date' => [
                'data' => 'end_date',
                'title' => trans('calendar::events.table.end_date'),
                'data_type' => 'datetime',
                'filter_type' => 'bap_date_range_picker',
            ],
        ];
    }

    public static function availableQueryFilters()
    {
        return [

        ];
    }

    protected function setFilterDefinition()
    {
        $this->filterDefinition = self::availableQueryFilters();
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        $this->applyLinks($dataTable, self::SHOW_URL_ROUTE, 'calls_');

        $dataTable->filterColumn('owner', function ($query, $keyword) {
            DataTableHelper::queryOwner($query, $keyword, 'calls');
        });

        $dataTable->editColumn('name', function($record){

            $text = "<span class='badge badge-default' style='color: $record->event_color'>$record->name</span>";
            return DataTableHelper::applyLink($text,route(self::SHOW_URL_ROUTE,$record->id));
        });

        $dataTable->filterColumn('start_date', function ($query, $keyword) {
            $dates = DataTableHelper::getDatesForFilter($keyword);

            if ($dates != null) {
                $query->whereBetween('bap_calendar_event.start_date', array($dates[0], $dates[1]));
            }
        });

        $dataTable->filterColumn('end_date', function ($query, $keyword) {
            $dates = DataTableHelper::getDatesForFilter($keyword);

            if ($dates != null) {
                $query->whereBetween('bap_calendar_event.end_date', array($dates[0], $dates[1]));
            }
        });



        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Event $model)
    {
        $query = $model->newQuery()
            ->with('owner')
            ->leftJoin('bap_calendar_dict_event_status', 'bap_calendar_event.event_status_id', '=', 'bap_calendar_dict_event_status.id')
            ->leftJoin('bap_calendar_dict_event_priority', 'bap_calendar_event.event_priority_id', '=', 'bap_calendar_dict_event_priority.id')
            ->leftJoin('leads', 'bap_calendar_event.lead_id', '=', 'leads.id')
            ->select(
                'bap_calendar_event.*',
                'bap_calendar_dict_event_status.name as status',
                'bap_calendar_dict_event_priority.name as priority',
                'leads.full_name as lead_name'
            );

        if (!empty($this->filterRules)) {
            $queryBuilderParser = new  QueryBuilderParser();
            $queryBuilder = $queryBuilderParser->parse($this->filterRules, $query);

            return $queryBuilder;
        }

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        // If you need to Customize override this
        return $this->tableBuilder();
    }

    /**
     * @return array
     */
    protected function getColumns()
    {

        $this->allowUnlink = false;
        $this->allowDelete = true;

        $result = $this->btnDelete + $this->btnQuick_edit;

        $result = $result + self::availableColumns();

        return $result;
    }
}
