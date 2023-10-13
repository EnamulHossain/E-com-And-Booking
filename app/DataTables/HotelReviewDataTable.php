<?php
/*
 * File name: HotelReviewDataTable.php
 * Last modified: 2022.02.12 at 02:17:42
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\HotelReview;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class HotelReviewDataTable extends DataTable
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
            ->editColumn('updated_at', function ($hotelReview) {
                return getDateColumn($hotelReview, 'updated_at');
            })
            ->editColumn('booking.user.name', function ($hotelReview) {
                return getLinksColumnByRouteName([$hotelReview->booking->user], 'users.edit', 'id', 'name');
            })
            ->editColumn('booking.hotel.name', function ($hotelReview) {
                return getLinksColumnByRouteName([$hotelReview->booking->hotel], 'hotels.edit', 'id', 'name');
            })
            ->addColumn('action', 'hotel_reviews.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        $columns = [
            [
                'data' => 'review',
                'title' => trans('lang.hotel_review_review'),

            ],
            [
                'data' => 'rate',
                'title' => trans('lang.hotel_review_rate'),

            ],
            [
                'data' => 'booking.user.name',
                'title' => trans('lang.hotel_review_user_id'),

            ],
            [
                'data' => 'booking.hotel.name',
                'title' => trans('lang.hotel_review_hotel_id'),
            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.hotel_review_updated_at'),
                'searchable' => false,
            ]
        ];

        $hasCustomField = in_array(HotelReview::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', HotelReview::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.hotel_review_' . $field->name),
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
     * @param HotelReview $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(HotelReview $model): \Illuminate\Database\Eloquent\Builder
    {
        if (auth()->user()->hasRole('admin')) {
            return $model->newQuery()->with("booking")->select("hotel_reviews.*");
        } else if (auth()->user()->hasRole('hotel owner')) {
            return $model->newQuery()->with("booking")->join("bookings", "bookings.id", "=", "hotel_reviews.booking_id")
                ->join("hotel_users", "hotel_users.hotel_id", "=", "bookings.hotel->id")
                ->where('hotel_users.user_id', auth()->id())
                ->groupBy('hotel_reviews.id')
                ->select('hotel_reviews.*');
        } else if (auth()->user()->hasRole('customer')) {
            return $model->newQuery()->join("bookings", "bookings.id", "=", "hotel_reviews.booking_id")
                ->where('bookings.user_id', auth()->id())
                ->groupBy('hotel_reviews.id')
                ->select('hotel_reviews.*');
        } else {
            return $model->newQuery()->with("user")->with("hotel")->select("$model->table.*");
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
        return 'hotel_reviewsdatatable_' . time();
    }
}
