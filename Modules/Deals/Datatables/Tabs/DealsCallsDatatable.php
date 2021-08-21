<?php

namespace Modules\Deals\Datatables\Tabs;


use Modules\Calls\Datatables\CallDatatable;
use Modules\Calls\Entities\Call;
use Modules\Platform\Core\Datatable\RelationDataTable;
use Modules\Platform\Core\Helper\DataTableHelper;
use Modules\Platform\Core\QueryBuilderParser\QueryBuilderParser;
use Yajra\DataTables\EloquentDataTable;

/**
 * Class DealsContactsDatatable
 * @package Modules\Deals\Tabs\Datatables
 */
class DealsCallsDatatable extends RelationDataTable
{
    const SHOW_URL_ROUTE = 'calls.calls.show';

    protected $unlinkRoute = 'deals.calls.unlink';

    protected $editRoute = 'calls.calls.edit';

    public static function availableColumns()
    {
        return CallDatatable::availableColumns();
    }

    public static function availableQueryFilters()
    {
        return CallDatatable::availableQueryFilters();
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

        $this->applyLinks($dataTable, self::SHOW_URL_ROUTE, 'contacts_');



        $dataTable->editColumn('phone', function ($record) {
            $text ='';
            if ($record->phone) {
                $text = "<span class='badge bg-grey'><i class='fa fa-mobile-phone'></i> $record->phone</span>";
            }
            return DataTableHelper::applyLink($text,route(self::SHOW_URL_ROUTE,$record->id));
        });
        $dataTable->editColumn('email', function ($record) {
            $text = "<span class='badge bg-grey'><i class='fa fa-envelope-o'></i> $record->email</span>";
            return DataTableHelper::applyLink($text,route(self::SHOW_URL_ROUTE,$record->id));
        });

        $dataTable->filterColumn('owner', function ($query, $keyword) {
            DataTableHelper::queryOwner($query, $keyword, 'contacts');
        });

        $dataTable->filterColumn('created_at', function ($query, $keyword) {
            $dates = DataTableHelper::getDatesForFilter($keyword);

            if ($dates != null) {
                $query->whereBetween('contacts.created_at', array($dates[0], $dates[1]));
            }
        });
        $dataTable->filterColumn('updated_at', function ($query, $keyword) {
            $dates = DataTableHelper::getDatesForFilter($keyword);

            if ($dates != null) {
                $query->whereBetween('contacts.updated_at', array($dates[0], $dates[1]));
            }
        });
        $dataTable->filterColumn('birth_date', function ($query, $keyword) {

            $dates = DataTableHelper::getDatesForFilter($keyword);

            if ($dates != null) {
                $query->whereBetween('contacts.birth_date', array($dates[0], $dates[1]));
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
    public function query(Call $model)
    {
        $query = $model->newQuery()
            ->with('owner')
            ->leftJoin('calls_dict_direction', 'calls.direction_id', '=', 'calls_dict_direction.id')
            ->leftJoin('calls_dict_status', 'calls.status_id', '=', 'calls_dict_status.id')
            ->leftJoin('accounts', 'calls.account_id', '=', 'accounts.id')
            ->leftJoin('deals', 'calls.deal_id', '=', 'deals.id')
            ->leftJoin('contacts', 'calls.contact_id', '=', 'contacts.id')
            ->leftJoin('leads', 'calls.lead_id', '=', 'leads.id')
            ->select(
                'calls.*',
                'calls_dict_direction.name as direction',
                'calls_dict_status.name as status',
                'deals.name as deal_name',
                'accounts.name as account_name',
                'contacts.full_name as contact_name',
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

        $columns = CallDatatable::availableColumns();

        $result = [];

        if ($this->allowSelect) {
            $result =  $this->btnCheck_selection;
        }
        if ($this->allowUnlink) {
            $result =  $this->btnUnlink ;
        }
        if ($this->allowUnlink) {
            $result =  $result + $this->btnQuick_edit; ;
        }

        $result = $result + $columns;

        return $result;
    }
}
