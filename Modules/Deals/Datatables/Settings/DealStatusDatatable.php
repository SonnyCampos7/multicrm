<?php

namespace Modules\Deals\Datatables\Settings;

use Modules\Deals\Entities\DealStatus;
use Modules\Platform\Core\Datatable\PlatformDataTable;
use Modules\Platform\Core\Helper\DataTableHelper;
use Yajra\DataTables\EloquentDataTable;

class DealStatusDatatable extends PlatformDataTable
{
    const SHOW_URL_ROUTE = 'deals.status.show';

    protected $editRoute = 'deals.status.edit';


    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        $this->applyLinks($dataTable, self::SHOW_URL_ROUTE);

        $dataTable->filterColumn('owner', function ($query, $keyword) {
            DataTableHelper::queryOwner($query, $keyword,'deals_dict_status');
        });

        $dataTable->filterColumn('created_at', function ($query, $keyword) {
            $dates = DataTableHelper::getDatesForFilter($keyword);

            if ($dates != null) {
                $query->whereBetween('created_at', array($dates[0], $dates[1]));
            }
        });
        $dataTable->filterColumn('updated_at', function ($query, $keyword) {
            $dates = DataTableHelper::getDatesForFilter($keyword);

            if ($dates != null) {
                $query->whereBetween('updated_at', array($dates[0], $dates[1]));
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
    public function query(DealStatus $model)
    {
        return $model->disableModelCaching()->newQuery()->with('owner')->select();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->setTableAttribute('class', 'table table-hover')
            ->parameters([
                'dom' => 'lBfrtip',
                'responsive' => false,
                'stateSave' => true,
                'headerFilters' => true,
                'buttons' => DataTableHelper::buttons(),
                'regexp' => true
            ]);
    }

    /**
     * @return array
     */
    protected function getColumns()
    {
        return
            $this->btnQuick_edit +
            [
                'name' => [
                    'data' => 'name',
                    'title' => trans('core::core.table.name'),
                    'data_type' => 'text',
                    'filter_type' => 'text'
                ],
                'step_name' => [
                    'data' => 'step_name',
                    'title' => trans('deals::deals.status.form.step_name'),
                    'data_type' => 'text',
                    'filter_type' => 'text'
                ],

                'created_at' => [
                    'data' => 'created_at',
                    'title' => trans('core::core.table.created_at'),
                    'data_type' => 'datetime',
                    'filter_type' => 'bap_date_range_picker',
                ],
                'updated_at' => [
                    'data' => 'updated_at',
                    'title' => trans('core::core.table.updated_at'),
                    'data_type' => 'datetime',
                    'filter_type' => 'bap_date_range_picker',
                ],
                'owner' => [
                    'data' => 'owner',
                    'title' => trans('core::core.table.assigned_to'),
                    'data_type' => 'assigned_to',
                    'orderable' => false,

                    'filter_type' => 'select',
                    'select_type' => 'select2',
                    'select_type_options' => [
                        'theme' => "bootstrap",
                        'width' => '100%'
                    ],
                    'filter_data' => DataTableHelper::filterOwnerDropdown()
                ],
            ];
    }
}
