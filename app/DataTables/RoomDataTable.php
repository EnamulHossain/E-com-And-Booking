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
use App\Models\Room;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class RoomDataTable extends DataTable
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
            ->addColumn('room_number', function ($room) {
                return $room->room_number;
            })
            ->addColumn('floor', function ($room) {
                return $room->floor;
            })
            ->addColumn('amount', function ($room) {
                return $room->amount;
            })
            ->editColumn('available', function ($room) {
                if($room->available == 1) {
                    return '<span class="badge bg-success">' . ($room->available == 0 ? "Not Available" : "Available") . '</span>';
                }else {
                    return '<span class="badge bg-danger">' . ($room->available == 0 ? "Not Available" : "Available") . '</span>';
                }
            })
            ->addColumn('action', 'hotels.room.datatables_actions')
            ->rawColumns(array_merge($columns, ['available','action']));

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
                'data' => 'room_number',
                'title' => trans('lang.room_number'),

            ],
            [
                'data' => 'floor',
                'title' => trans('lang.floor'),

            ],
            [
                'data' => 'amount',
                'title' => trans('lang.amount'),

            ],
            [
                'data' => 'available',
                'title' => trans('lang.room_available'),

            ],
        ];

        $hasCustomField = in_array(Room::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', Room::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.room_' . $field->name),
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
    public function query(Room $model)
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
        return 'roomdatatable_' . time();
    }
}
