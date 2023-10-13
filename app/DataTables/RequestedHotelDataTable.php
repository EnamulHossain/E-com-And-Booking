<?php
/*
 * File name: RequestedHotelDataTable.php
 * Last modified: 2022.02.12 at 02:17:42
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\Hotel;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class RequestedHotelDataTable extends DataTable
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
            ->editColumn('image', function ($hotel) {
                return getMediaColumn($hotel, 'image');
            })
            ->editColumn('name', function ($hotel) {
                if ($hotel['featured']) {
                    return $hotel->name . "<span class='badge bg-" . setting('theme_color') . " p-1 m-2'>" . trans('lang.e_service_featured') . "</span>";
                }
                return $hotel->name;
            })
            ->editColumn('hotel_level.name', function ($hotel) {
                return getLinksColumnByRouteName([$hotel->hotelLevel], "hotelLevels.edit", 'id', 'name');
            })
            ->editColumn('users', function ($hotel) {
                return getLinksColumnByRouteName($hotel->users, 'users.edit', 'id', 'name');
            })->editColumn('address.address', function ($hotel) {
                return getLinksColumnByRouteName([$hotel->address], 'addresses.edit', 'id', 'address');
            })->editColumn('taxes', function ($hotel) {
                return getLinksColumnByRouteName($hotel->taxes, 'taxes.edit', 'id', 'name');
            })
            ->editColumn('available', function ($hotel) {
                return getBooleanColumn($hotel, 'available');
            })
            ->editColumn('updated_at', function ($hotel) {
                return getDateColumn($hotel);
            })
            ->addColumn('action', 'hotels.datatables_actions')
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
                'data' => 'image',
                'title' => trans('lang.hotel_image'),
                'searchable' => false, 'orderable' => false, 'exportable' => false, 'printable' => false,
            ],
            [
                'data' => 'name',
                'title' => trans('lang.hotel_name'),

            ],
            [
                'data' => 'hotel_level.name',
                'name' => 'hotelLevel.name',
                'title' => trans('lang.hotel_hotel_level_id'),

            ],
            [
                'data' => 'users',
                'title' => trans('lang.hotel_users'),
                'searchable' => false,
                'orderable' => false
            ],
            [
                'data' => 'phone_number',
                'title' => trans('lang.hotel_phone_number'),

            ],
            [
                'data' => 'mobile_number',
                'title' => trans('lang.hotel_mobile_number'),

            ],
            [
                'data' => 'address.address',
                'title' => trans('lang.hotel_address'),
                'searchable' => false,
                'orderable' => false
            ],
            [
                'data' => 'availability_range',
                'title' => trans('lang.hotel_availability_range'),

            ],
            [
                'data' => 'taxes',
                'title' => trans('lang.hotel_taxes'),
                'searchable' => false,
                'orderable' => false
            ],
            [
                'data' => 'available',
                'title' => trans('lang.hotel_available'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.address_updated_at'),
                'searchable' => false,
            ]
        ];

        $hasCustomField = in_array(Hotel::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', Hotel::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.hotel_' . $field->name),
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
     * @param Hotel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Hotel $model)
    {
        if (auth()->user()->hasRole('admin')) {
            return $model->newQuery()->with("hotelLevel")->with("address")->where('hotels.accepted', '0')->select("$model->table.*");
        } else {
            return $model->newQuery()
                ->with("hotelLevel")
                ->join("hotel_users", "hotel_id", "=", "hotels.id")
                ->where('hotel_users.user_id', auth()->id())
                ->where('hotels.accepted', '0')
                ->groupBy("hotels.id")
                ->select("$model->table.*");
        }
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
                        ), true),
                    'fixedColumns' => [],
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
        return 'hotelsdatatable_' . time();
    }
}
