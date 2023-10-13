@extends('layouts.app')
@push('css_lib')
    <link rel="stylesheet" href="{{asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/dropzone/min/dropzone.min.css')}}">
@endpush
@section('content')
    <!-- Content Header (Page header) -->
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
                        <li class="breadcrumb-item active">{{trans('lang.room_create')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>
        <div class="card shadow-sm">
            <div class="card-header">
                <ul class="nav nav-tabs d-flex flex-row align-items-start card-header-tabs">
                    @can('rooms.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{!! route('rooms.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.room_table')}}</a>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.room_create')}}</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form id="createForm" class="form form-vertical" action="{{route('rooms.store')}}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="room_number" class="mb-2"><span class="required">*</span>Room Number</label>
                                    <input type="text" class="form-control" id="room_number" name="room_number" value="{{ old('room_number') }}"
                                           placeholder="Room Number" required>
                                </div>
                                <span class="text-danger">@error('room_number'){{ $message }}@enderror</span>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="hotel_id" class="mb-2 d-flex align-items-center"><span class="required">*</span>Hotel Name</label>
                                    <select name="hotel_id" class="form-select select2"  style="width: 100%">
                                        <option hidden value=""></option>
                                        @foreach($hotels as $hotel)
                                            <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">@error('hotel_id'){{ $message }}@enderror</span>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="floor" class="mb-2">Floor</label>
                                    <input type="text" class="form-control" id="floor" name="floor" value="{{ old('floor') }}"
                                           placeholder="" >
                                </div>
                                <span class="text-danger">@error('floor'){{ $message }}@enderror</span>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="amount" class="mb-2"><span class="required">*</span>Price Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}"
                                           placeholder="" required>
                                </div>
                                <span class="text-danger">@error('room_number'){{ $message }}@enderror</span>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="address" class="mb-2">Description</label>
                                    <textarea class="form-control"
                                              name="description" id="description"
                                              rows="3"
                                    >{{ old("description")  }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="available"><span class="required">*</span>Availability Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="available" id="active"
                                               value="1" required>
                                        <label class="form-check-label" for="active">Available</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="available" id="inactive"
                                               value="0" required>
                                        <label class="form-check-label" for="inactive">Not Available</label>
                                    </div>
                                    <span class="text-danger">@error('available'){{ $message }}@enderror</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    @include('layouts.media_modal')
@endsection
@push('scripts_lib')
    <script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('vendor/summernote/summernote.min.js')}}"></script>
    <script src="{{asset('vendor/dropzone/min/dropzone.min.js')}}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var dropzoneFields = [];
    </script>
@endpush
