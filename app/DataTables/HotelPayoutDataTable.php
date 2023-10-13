<?php
/*
 * File name: HotelPayoutDataTable.php
 * Last modified: 2022.02.02 at 21:31:35
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\HotelPayout;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class HotelPayoutDataTable extends DataTable
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
            ->editColumn('hotel.name', function ($earning) {
                return getLinksColumnByRouteName([$earning->hotel], "hotels.edit", 'id', 'name');
            })
            ->editColumn('note', function ($hotelPayout) {
                return getStripedHtmlColumn($hotelPayout, 'note');
            })
            ->editColumn('paid_date', function ($hotelPayout) {
                return getDateColumn($hotelPayout, "paid_date");
            })
            ->editColumn('amount', function ($hotels_payout) {
                return getPriceColumn($hotels_payout, 'amount');
            })
            ->rawColumns(array_merge($columns));

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
                'data' => 'hotel.name',
                'name' => 'hotel.name',
                'title' => trans('lang.hotel_payout_hotel_id'),

            ],
            [
                'data' => 'method',
                'title' => trans('lang.hotel_payout_method'),

            ],
            [
                'data' => 'amount',
                'title' => trans('lang.hotel_payout_amount'),

            ],
            [
                'data' => 'paid_date',
                'name' => 'paidDate',
                'title' => trans('lang.hotel_payout_paid_date'),

            ],
            [
                'data' => 'note',
                'title' => trans('lang.hotel_payout_note'),

            ]
        ];

        $hasCustomField = in_array(HotelPayout::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', HotelPayout::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.hotel_payout_' . $field->name),
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
     * @param HotelPayout $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(HotelPayout $model)
    {
        return $model->newQuery()->with("hotel")->select("$model->table.*");
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
        return 'hotel_payoutsdatatable_' . time();
    }
}
