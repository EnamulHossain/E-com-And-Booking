@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    @if(session('success'))
        <div class="alert alert-light-success alert-dismissible show fade" id="alert">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-light-danger">{{session('success')}}</h6> <span data-bs-dismiss="alert">&times;</span>
            </div>
        </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-light-danger alert-dismissible show fade" id="alert">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-light-danger">{{$error}}</h6> <span data-bs-dismiss="alert">&times;</span>
                </div>
            </div>
        @endforeach
    @endif
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-bold">{{trans('lang.room_plural') }}<small class="mx-3">|</small><small>{{trans('lang.room_desc')}}</small>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb bg-white float-sm-right rounded-pill px-4 py-2 d-none d-md-flex">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fas fa-tachometer-alt"></i> {{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('rooms.index') !!}">{{trans('lang.room_plural')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{trans('lang.room_table')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="card shadow-sm">
            <div class="card-header">
                <ul class="nav nav-tabs d-flex flex-md-row flex-column-reverse align-items-start card-header-tabs">
                    <div class="d-flex flex-row">
                        <li class="nav-item">
                            <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.room_table')}}</a>
                        </li>
                        @can('rooms.create')
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('rooms.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.room_create')}}
                                </a>
                            </li>
                        @endcan
                    </div>
                   @include('layouts.right_toolbar', compact('dataTable'))
                </ul>
            </div>
            <div class="card-body">
                {{-- <table class='table' style="width: 100%"
                       id="laravel_datatable">
                    <thead>
                    <th>{{'SL'}}</th>
                    <th>{{'Room Number'}}</th>
                    <th>{{'Floor'}}</th>
                    <th>{{'Amount'}}</th>
                    <th>{{'Status'}}</th>
                    <th>{{'Action'}}</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="modal fade text-left" id="danger" tabindex="-1"
                     role="dialog" aria-labelledby="myModalLabel120"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                         role="document">
                        <form id="delForm" method="POST" style="width: 100%">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h5 class="modal-title white" id="myModalLabel120">
                                        Delete</h5>
                                    <button type="button" class="close"
                                            data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body text-center font-bold">
                                    Are you sure want to Delete? It will REVERSIBLY delete all Test Category records of that Lab.
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                            class="btn btn-light-secondary"
                                            data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Cancel</span>
                                    </button>
                                    <button type="submit" class="btn btn-danger ml-1">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Delete</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
                @include('hotels.room.table')
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection
{{-- @push('scripts')
    <script>
        $(document).ready(function () {
            $('#laravel_datatable').DataTable({
                "drawCallback": function (settings) {
                    // feather.replace();
                },
                processing: true,
                serverSide: true,
                "order": [[0, "desc"]],
                ajax: "{{route('rooms.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'room_number', name: 'room_number'},
                    {data: 'floor', name: 'floor'},
                    {data: 'amount', name: 'amount'},
                    {data: 'available', name: 'available'},

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: false,
                        className: 'text-center'
                    },
                ],
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ]

            });
        });

        function onDelete(e) {
            console.log(e.id)
            document.getElementById('delForm').setAttribute('action', e.id)

        }
    </script>
@endpush --}}
