@extends('layouts.app')
@push('css_lib')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}">
    {{-- dropzone --}}
    <link rel="stylesheet" href="{{ asset('vendor/dropzone/min/dropzone.min.css') }}">
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-bold">Order<small class="mx-3">|</small><small>Order Management</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb bg-white float-sm-right rounded-pill px-4 py-2 d-none d-md-flex">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fas fa-tachometer-alt"></i>
                                {{ trans('lang.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('orderedproduct.index') !!}">{{ trans('lang.booking_plural') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('lang.booking_edit') }}</li>
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
                    @can('bookings.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{!! route('orderedproduct.index') !!}"><i class="fas fa-list mr-2"></i>Order List</a>
                        </li>
                    @endcan

                    <li class="nav-item">
                        <a class="nav-link active" href="{!! url()->current() !!}"><i class="fas fa-pencil mr-2"></i>Edit</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{route('orderedproduct.update',$orderedProduct->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="user_id">User ID:</label>
                        <input type="text" class="form-control" name="user_id" id="user_id" value="{{ $orderedProduct->user_id }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="billing_email">Billing Email:</label>
                        <input type="email" class="form-control" name="billing_email" id="billing_email" value="{{ $orderedProduct->billing_email }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="billing_name">Billing Name:</label>
                        <input type="text" class="form-control" name="billing_name" id="billing_name" value="{{ $orderedProduct->billing_name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="billing_address">Billing Address:</label>
                        <input type="text" class="form-control" name="billing_address" id="billing_address" value="{{ $orderedProduct->billing_address }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="billing_city">Billing City:</label>
                        <input type="text" class="form-control" name="billing_city" id="billing_city" value="{{ $orderedProduct->billing_city }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="billing_province">Billing Province:</label>
                        <input type="text" class="form-control" name="billing_province" id="billing_province" value="{{ $orderedProduct->billing_province }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="billing_postalcode">Billing Postal Code:</label>
                        <input type="text" class="form-control" name="billing_postalcode" id="billing_postalcode" value="{{ $orderedProduct->billing_postalcode }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="billing_phone">Billing Phone:</label>
                        <input type="text" class="form-control" name="billing_phone" id="billing_phone" value="{{ $orderedProduct->billing_phone }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="billing_name_on_card">Billing Name on Card:</label>
                        <input type="text" class="form-control" name="billing_name_on_card" id="billing_name_on_card" value="{{ $orderedProduct->billing_name_on_card }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="billing_discount">Billing Discount:</label>
                        <input type="number" class="form-control" name="billing_discount" id="billing_discount" value="{{ $orderedProduct->billing_discount }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="billing_discount_code">Billing Discount Code:</label>
                        <input type="text" class="form-control" name="billing_discount_code" id="billing_discount_code" value="{{ $orderedProduct->billing_discount_code }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="billing_subtotal">Billing Subtotal:</label>
                        <input type="number" class="form-control" name="billing_subtotal" id="billing_subtotal" value="{{ $orderedProduct->billing_subtotal }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="billing_tax">Billing Tax:</label>
                        <input type="number" class="form-control" name="billing_tax" id="billing_tax" value="{{ $orderedProduct->billing_tax }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="billing_total">Billing Total:</label>
                        <input type="number" class="form-control" name="billing_total" id="billing_total" value="{{ $orderedProduct->billing_total }}" readonly>
                    </div>

                    <div>
                        <label for="billing_total">Status:</label>
                        <input type="text" class="form-control" name="status" id="status" value="{{ $orderedProduct->status }}">
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>

                </form>
                
            </div>
        </div>
    </div>
    {{-- @include('layouts.media_modal') --}}
@endsection
@push('scripts_lib')
    <!-- iCheck -->

    <!-- select2 -->orderedproductvendor/dropzone/min/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var dropzoneFields = [];
    </script>
@endpush
