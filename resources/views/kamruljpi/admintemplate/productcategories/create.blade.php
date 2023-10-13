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
                        <i class="fa fa-list mr-2"></i>@lang('lang.list') {{ $pageTitle }}
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" href="{{Route( $createRoute )}}">
                        <i class="fa fa-plus mr-2"></i>@lang('lang.create') {{ $pageTitle }}
                    </a>
                </li>
            </div>
            </ul>
        </div>
        <div class="card-body">
            <div id="dataTableBuilder_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="card card-primary">
                @if(isset($data->id) && !empty($data->id))
                    <form role="form" action="{{Route('productcategory.editaction',$data->id)}}" method="post">
                    <input type="hidden" name="id" value="{{ isset($data->id) ? $data->id : 0 }}" id="id">
                @else
                    <form role="form" action="{{ Route('productcategory.createaction') }}" method="post">
                @endif
                @csrf
                  <div class="card-body">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">@lang('lang.product_category')</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="@lang('lang.product_category')" value="{{ (isset($data->name) && !empty($data->name)) ? $data->name : old('name') }}">
                        @if($errors->has('name'))
                            <span class="help-block">
                                <strong>
                                    {{ $errors->first('name') }}
                                </strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label for="name">@lang('lang.product_category_slug')</label>
                        <input type="text" class="form-control" name="slug" id="slug" placeholder="@lang('lang.product_category_slug')" value="{{ (isset($data->slug) && !empty($data->slug)) ? $data->slug : old('slug') }}">
                        @if($errors->has('slug'))
                            <span class="help-block">
                                <strong>
                                    {{ $errors->first('slug') }}
                                </strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <label for="is_active">{{__('lang.status')}}</label>
                      <select name="is_active" class="form-control">
                        <option value="1" {{ (isset($data->is_active) && ($data->is_active == 1)) ? 'selected' : '' }}>{{__('lang.active')}}</option>
                        <option value="0" {{ (isset($data->is_active) && ($data->is_active == 0)) ? 'selected' : '' }}>{{__('lang.inactive')}}</option>
                      </select>
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