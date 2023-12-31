<?php
/*
 * File name: HotelLevelDataTable.php
 * Last modified: 2022.02.03 at 14:23:26
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\Post;
use App\Models\HotelLevel;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class HotelLevelDataTable extends DataTable
{
    /**
     * custom fields columns
     * @var array
     */
    public static $customFields = [];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $columns = array_column($this->getColumns(), 'data');
        $dataTable = $dataTable
            ->editColumn('name', function ($hotelLevel) {
                return $hotelLevel->name;
            })
            ->editColumn('updated_at', function ($hotelLevel) {
                return getDateColumn($hotelLevel, 'updated_at');
            })
            ->editColumn('disabled', function ($hotelLevel) {
                return getNotBooleanColumn($hotelLevel, 'disabled');
            })
            ->editColumn('default', function ($hotelLevel) {
                return getBooleanColumn($hotelLevel, 'default');
            })
            ->addColumn('action', 'hotel_levels.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            [
                'data' => 'name',
                'title' => trans('lang.hotel_level_name'),

            ],
            [
                'data' => 'commission',
                'title' => trans('lang.hotel_level_commission'),

            ],
            [
                'data' => 'disabled',
                'title' => trans('lang.hotel_level_disabled'),

            ],
            [
                'data' => 'default',
                'title' => trans('lang.hotel_level_default'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.hotel_level_updated_at'),
                'searchable' => false,
            ]
        ];

        $hasCustomField = in_array(HotelLevel::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', HotelLevel::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.hotel_level_' . $field->name),
                    'orderable' => false,
                    'searchable' => false,
                ]]);
            }
        }
        return $columns;
    }

    /**
     * Get query source of dataTable.
     *
     * @param Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(HotelLevel $model)
    {
        return $model->newQuery()->select("$model->table.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px', 'printable' => false, 'responsivePriority' => '100'])
            ->parameters(array_merge(
                config('datatables-buttons.parameters'), [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/' . app()->getLocale() . '/datatable.json')
                        ), true)
                ]
            ));
    }

    /**
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = PDF::loadView($this->printPreview, compact('data'));
        return $pdf->download($this->filename() . '.pdf');
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'hotel_levelsdatatable_' . time();
    }
}
