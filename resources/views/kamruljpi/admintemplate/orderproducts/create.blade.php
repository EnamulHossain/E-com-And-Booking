@extends('layouts.app')
@section('content')
<div class="content">
    <div class="clearfix"></div>
    <div class="card shadow-sm">
        <div class="card-header">
            <ul class="nav nav-tabs d-flex flex-md-row flex-column-reverse align-items-start card-header-tabs">
                <div class="d-flex flex-row">
                    <li class="nav-item">
                        <a class="nav-link " href="{{Route( $listRoute )}}">
                            <i class="fa fa-list mr-2"></i>@lang('lang.list') {{ __('lang.'.$pageTitle) }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{Route( $createRoute )}}">
                            <i class="fa fa-plus mr-2"></i>@lang('lang.create') {{ __('lang.'.$pageTitle) }}
                        </a>
                    </li>
                </div>
            </ul>
        </div>
        <div class="card-body">
            <div id="dataTableBuilder_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="card card-primary">
                    @if(isset($data->id) && !empty($data->id))
                    <form role="form" action="{{Route('orderproduct.editaction',$data->id)}}" method="post">
                        <input type="hidden" name="id" value="{{ isset($data->id) ? $data->id : 0 }}" id="id">
                        @else
                        <form role="form" action="{{ Route('orderproduct.createaction') }}" method="post">
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="form-group{{ $errors->has('product_id') ? ' has-error' : '' }}">
                                    <label for="product_id">@lang('lang.product_name')</label>
                                    <input type="text" class="form-control" name="product_id" id="product_id"
                                        placeholder="@lang('lang.product_name')"
                                        value="{{ (isset($data->product_id) && !empty($data->product_id))}}">
                                    @if($errors->has('product_id'))
                                    <span class="help-block">
                                        <strong>
                                            {{ $errors->first('product_id') }}
                                        </strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('order_id') ? ' has-error' : '' }}">
                                    <label for="name">@lang('lang.product_order')</label>
                                    <input type="text" class="form-control" name="order_id" id="order_id"
                                        placeholder="@lang('lang.product_order')"
                                        value="{{ (isset($data->order_id) && !empty($data->order_id))}}">
                                    @if($errors->has('order_id'))
                                    <span class="help-block">
                                        <strong>
                                            {{ $errors->first('order_id') }}
                                        </strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                    <label for="name">@lang('lang.product_quantity')</label>
                                    <input type="text" class="form-control" name="quantity" id="quantity"
                                        placeholder="@lang('lang.product_quantity')"
                                        value="{{ (isset($data->quantity) && !empty($data->quantity))}}">
                                    @if($errors->has('quantity'))
                                    <span class="help-block">
                                        <strong>
                                            {{ $errors->first('quantity') }}
                                        </strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{__('lang.submit')}}</button>
                            </div>
                        </form>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
