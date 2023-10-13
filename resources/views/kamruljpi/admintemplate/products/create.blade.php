@extends('layouts.app')
@push('css_lib')
<link rel="stylesheet" href="{{asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/dropzone/min/dropzone.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
@endpush
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-bold">@lang('lang.products') <small
						class="mx-3">|</small><small>@lang('lang.products_management')</small>
				</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb bg-white float-sm-right rounded-pill px-4 py-2 d-none d-md-flex">
					<li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fas fa-tachometer-alt"></i>
							{{trans('lang.dashboard')}}</a></li>
					<li class="breadcrumb-item">
						<a href="{!! route('product.index') !!}">@lang('lang.products')</a>
					</li>
					<li class="breadcrumb-item active">@lang('lang.create_product')</li>
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
				@can('product.index')
				<li class="nav-item">
					<a class="nav-link" href="{!! route('product.index') !!}"><i
							class="fa fa-list mr-2"></i>@lang('lang.products_list')</a>
				</li>
				@endcan
				<li class="nav-item">
					<a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>
						@if(isset($data->id) && !empty($data->id))
						@lang('lang.edit_product')
						@else
						@lang('lang.create_product')
						@endif
					</a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			@if(isset($data->id) && !empty($data->id))
			<form role="form" action="{{Route('product.editaction',$data->id)}}" method="post"
				enctype="multipart/form-data">
				<input type="hidden" name="id" value="{{ isset($data->id) ? $data->id : 0 }}" id="id">
				@else
				<form role="form" action="{{ Route('product.createaction') }}" method="post"
					enctype="multipart/form-data">
					@endif
					@csrf
					<div class="row">
						<div class="d-flex flex-column col-sm-12 col-md-6 px-4">
							<!-- Name Field -->
							<div
								class="form-group align-items-baseline d-flex flex-column flex-md-row {{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name"
									class="col-md-3 control-label text-md-right mx-1">@lang('lang.product_name')</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="name" id="name"
										placeholder="@lang('lang.product_name')"
										value="{{ (isset($data->name) && !empty($data->name)) ? $data->name : old('name') }}">

{{--									@if($errors->has('name'))--}}
{{--									<span class="help-block">--}}
{{--										<strong>--}}
{{--											{{ $errors->first('name') }}--}}
{{--										</strong>--}}
{{--									</span>--}}
{{--									@endif--}}
									<div class="form-text text-muted">
										@lang('lang.insert_product_name')
									</div>
								</div>
							</div>
							<!-- Slug Field -->
							<div
								class="form-group align-items-baseline d-flex flex-column flex-md-row {{ $errors->has('slug') ? ' has-error' : '' }}">
								<label for="slug"
									class="col-md-3 control-label text-md-right mx-1">@lang('lang.product_slug')</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="slug" id="slug"
										placeholder="@lang('lang.product_slug')"
										value="{{ (isset($data->slug) && !empty($data->slug)) ? $data->slug : old('slug') }}">
{{--									@if($errors->has('slug'))--}}
{{--									<span class="help-block">--}}
{{--										<strong>--}}
{{--											{{ $errors->first('slug') }}--}}
{{--										</strong>--}}
{{--									</span>--}}
{{--									@endif--}}
									<div class="form-text text-muted">
										@lang('lang.insert_product_slug')
									</div>
								</div>
							</div>
							<!-- Slug Field -->
							<div
								class="form-group align-items-baseline d-flex flex-column flex-md-row {{ $errors->has('tags') ? ' has-error' : '' }}">
								<label for="tags"
									class="col-md-3 control-label text-md-right mx-1">@lang('lang.product_tags')</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="tags" id="tags"
										placeholder="@lang('lang.product_tags')"
										value="{{ (isset($data->tags) && !empty($data->tags)) ? $data->tags : old('tags') }}">
{{--									@if($errors->has('tags'))--}}
{{--									<span class="help-block">--}}
{{--										<strong>--}}
{{--											{{ $errors->first('tags') }}--}}
{{--										</strong>--}}
{{--									</span>--}}
{{--									@endif--}}
									<div class="form-text text-muted">
										@lang('lang.insert_product_tags')
									</div>
								</div>
							</div>
							<!-- Product Details Field -->
							<div
								class="form-group align-items-baseline d-flex flex-column flex-md-row {{ $errors->has('details') ? ' has-error' : '' }}">
								<label for="details"
									class="col-md-3 control-label text-md-right mx-1">@lang('lang.product_details')</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="details" id="details"
										placeholder="@lang('lang.product_details')"
										value="{{ (isset($data->details) && !empty($data->details)) ? $data->details : old('details') }}">
{{--									@if($errors->has('details'))--}}
{{--									<span class="help-block">--}}
{{--										<strong>--}}
{{--											{{ $errors->first('details') }}--}}
{{--										</strong>--}}
{{--									</span>--}}
{{--									@endif--}}
									<div class="form-text text-muted">
										@lang('lang.insert_product_details')
									</div>
								</div>
							</div>
							<!-- Price Field -->
							<div
								class="form-group align-items-baseline d-flex flex-column flex-md-row {{ $errors->has('price') ? ' has-error' : '' }}">
								<label for="price"
									class="col-md-3 control-label text-md-right mx-1">@lang('lang.product_price')</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="number" class="form-control" step="any" min="0" name="price"
											id="price" placeholder="@lang('lang.product_price')"
											value="{{ (isset($data->price) && !empty($data->price)) ? $data->price : old('price') }}">

										<div class="input-group-append">
											<div class="input-group-text text-bold px-3">
												{{setting('default_currency','$')}}</div>
										</div>
									</div>
									<div class="form-text text-muted">
										@lang('lang.insert_product_price')
									</div>
								</div>
							</div>

							<!-- Color Field -->
							<div class="form-group align-items-baseline d-flex flex-column flex-md-row">
								<label for="colors" class="col-md-3 control-label text-md-right mx-1">Colors</label>
								<div class="col-md-9">
									<select class="form-control select2-multi" name="colors[]" id="colors" multiple>
										@foreach ($colors as $id => $color)
											<option value="{{ $color->color }}">{{ $color->color }}</option>
										@endforeach
									</select>
								</div>
							</div>
							
							

							<!-- Product Quantity Field -->
							<div
								class="form-group align-items-baseline d-flex flex-column flex-md-row {{ $errors->has('quantity') ? ' has-error' : '' }}">
								<label for="quantity"
									class="col-md-3 control-label text-md-right mx-1">@lang('lang.product_quantity')</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="number" class="form-control" step="any" min="0" name="quantity"
											id="quantity" placeholder="@lang('lang.product_quantity')"
											value="{{ (isset($data->quantity) && !empty($data->quantity)) ? $data->quantity : old('quantity') }}">
{{--										@if($errors->has('quantity'))--}}
{{--										<span class="help-block">--}}
{{--											<strong>--}}
{{--												{{ $errors->first('quantity') }}--}}
{{--											</strong>--}}
{{--										</span>--}}
{{--										@endif--}}
									</div>
									<div class="form-text text-muted">
										@lang('lang.insert_product_quantity')
									</div>
								</div>
							</div>
							<div
								class="form-group align-items-baseline d-flex flex-column flex-md-row {{ $errors->has('description') ? ' has-error' : '' }}">
								<label for="description"
									class="col-md-3 control-label text-md-right mx-1">@lang('lang.product_description')</label>
								<div class="col-md-9">
									<textarea type="text" class="form-control" name="description" id="description"
										placeholder="@lang('lang.product_description')">
								</textarea>
{{--									@if($errors->has('description'))--}}
{{--									<span class="help-block">--}}
{{--										<strong>--}}
{{--											{{ $errors->first('description') }}--}}
{{--										</strong>--}}
{{--									</span>--}}
{{--									@endif--}}
									<div class="form-text text-muted">{{ trans("lang.category_description_help") }}
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex flex-column col-sm-12 col-md-6">
							<!-- Image Field -->
							<div class="form-group align-items-start d-flex flex-column flex-md-row">
								<label for="image"
									class="col-md-3 control-label text-md-right mx-1">@lang('lang.image')</label>
								<div class="col-md-9">
									<div style="width: 100%" class="dropzone image" id="image" data-field="image">
										<input type="hidden" name="image">
									</div>
									<a href="#loadMediaModal" data-dropzone="image" data-toggle="modal"
										data-target="#mediaModal"
										class="media_select btn btn-outline-{{setting('theme_color','primary')}} btn-sm float-right mt-1">{{
										trans('lang.media_select')}}</a>
									<div class="form-text text-muted w-50">
										{{ trans("lang.category_image_help") }}
									</div>
								</div>
							</div>
							@prepend('scripts')
							<script type="text/javascript">
								var var16110650672130312723ble = '';
							@if(isset($data) && $data->hasMedia('image'))
								var16110650672130312723ble = {
								name: "{!! $data->getFirstMedia('image')->name !!}",
								size: "{!! $data->getFirstMedia('image')->size !!}",
								type: "{!! $data->getFirstMedia('image')->mime_type !!}",
								collection_name: "{!! $data->getFirstMedia('image')->collection_name !!}"
							};
							@endif
							var dz_var16110650672130312723ble = $(".dropzone.image").dropzone({
								url: "{!!url('uploads/store')!!}",
								addRemoveLinks: true,
								maxFiles: 1,
								init: function () {
									@if(isset($data) && $data->hasMedia('image'))
									dzInit(this, var16110650672130312723ble, '{!! url($data->getFirstMediaUrl('image')) !!}')
									@endif
								},
								accept: function (file, done) {
									dzAccept(file, done, this.element, "{!!config('medialibrary.icons_folder')!!}");
								},
								sending: function (file, xhr, formData) {
									dzSending(this, file, formData, '{!! csrf_token() !!}');
								},
								maxfilesexceeded: function (file) {
									dz_var16110650672130312723ble[0].mockFile = '';
									dzMaxfile(this, file);
								},
								complete: function (file) {
									dzComplete(this, file, var16110650672130312723ble, dz_var16110650672130312723ble[0].mockFile);
									dz_var16110650672130312723ble[0].mockFile = file;
								},
								removedfile: function (file) {
									dzRemoveFile(
										file, var16110650672130312723ble, '{!! url("product/remove-media") !!}',
										'image', '{!! isset($data) ? $data->id : 0 !!}', '{!! url("uplaods/clear") !!}', '{!! csrf_token() !!}'
									);
								}
							});
							dz_var16110650672130312723ble[0].mockFile = var16110650672130312723ble;
							dropzoneFields['image'] = dz_var16110650672130312723ble;
							</script>
							@endprepend
							<div
								class="form-group align-items-baseline d-flex flex-column flex-md-row {{ $errors->has('featured') ? ' has-error' : '' }}">
								<label for="featured"
									class="col-md-3 control-label text-md-right mx-1">@lang('lang.featured')</label>
								<div class="col-md-9">
									<div class="input-group">
										<select name="featured" class="form-control">
											<option value="1" {{ (isset($data->featured) && ($data->featured == 1)) ?
												'selected' : '' }}>@lang('lang.yes')</option>
											<option value="0" {{ (isset($data->featured) && ($data->featured == 0)) ?
												'selected' : '' }}>@lang('lang.no')</option>
										</select>
									</div>
								</div>
							</div>
							<div
								class="form-group align-items-baseline d-flex flex-column flex-md-row {{ $errors->has('category_id') ? ' has-error' : '' }}">
								<label for="category_id"
									class="col-md-3 control-label text-md-right mx-1">@lang('lang.product_category')</label>
								<div class="col-md-9">
									<select name="category_id" class="select2 form-control">
										<option value="0">@lang('lang.select_category')</option>
										@if(isset($product_categories))
										@foreach ($product_categories as $cat)
										<option value="{{ $cat->id }}" @if(isset($data->category_id) &&
											!empty($data->category_id) && ($data->category_id == $cat->id))
											selected="selected" @endif>{{ $cat->name }}</option>
										@endforeach
										@endif
									</select>
									<div class="form-text text-muted">@lang('lang.select_category_name')</div>
								</div>
							</div>
							<!-- Offer Price -->
							<div
								class="form-group align-items-baseline d-flex flex-column flex-md-row {{ $errors->has('offer_price') ? ' has-error' : '' }}">
								<label for="offer_price"
									class="col-md-3 control-label text-md-right mx-1">@lang('lang.product_offer_price')</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="number" class="form-control" step="any" min="0" name="offer_price"
											id="offer_price" placeholder="@lang('lang.product_offer_price')"
											value="{{ (isset($data->offer_price) && !empty($data->offer_price)) ? $data->offer_price : old('offer_price') }}">

										<div class="input-group-append">
											<div class="input-group-text text-bold px-3">
												{{setting('default_currency','$')}}</div>
										</div>
									</div>
{{--									@if($errors->has('offer_price'))--}}
{{--										<span class="help-block">--}}
{{--											<strong>--}}
{{--												{{ $errors->first('offer_price') }}--}}
{{--											</strong>--}}
{{--										</span>--}}
{{--									@endif--}}
									<div class="form-text text-muted">
										@lang('lang.insert_product_offer_price')
									</div>
								</div>
							</div>
							<!--Offer Start At Field -->
							<div class="form-group align-items-baseline d-flex flex-column flex-md-row">
								<label for="offer_start"
									class="col-md-3 control-label text-md-right mx-1">@lang('lang.product_offer_start')</label>
								<div class="col-md-9">
									<div class="input-group datepicker offer_start" data-target-input="nearest">
										<input type="text" class="form-control datetimepicker-input"
											data-target=".datepicker.offer_start" data-toggle="datetimepicker"
											name="offer_start" autocomplete="off" id="offer_start"
											placeholder="@lang('lang.product_offer_start')"
											value="{{ (isset($data->offer_start) && !empty($data->offer_start)) ? $data->offer_start : old('offer_start') }}">
										<div id="widgetParentId"></div>
										<div class="input-group-append" data-target=".datepicker.offer_start"
											data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fas fa-business-time"></i></div>
										</div>
									</div>
									<div class="form-text text-muted">
										@lang('lang.insert_product_offer_start_time')
									</div>
								</div>
							</div>
							<!--Offer End At Field -->
							<div class="form-group align-items-baseline d-flex flex-column flex-md-row">
								<label for="offer_end"
									class="col-md-3 control-label text-md-right mx-1">@lang('lang.product_offer_end')</label>
								<div class="col-md-9">
									<div class="input-group datepicker offer_end" data-target-input="nearest">
										<input type="text" class="form-control datetimepicker-input"
											data-target=".datepicker.offer_end" data-toggle="datetimepicker"
											name="offer_end" autocomplete="off" id="offer_end"
											placeholder="@lang('lang.product_offer_end')"
											value="{{ (isset($data->offer_end) && !empty($data->offer_end)) ? $data->offer_end : old('offer_end') }}">
										<div id="widgetParentId"></div>
										<div class="input-group-append" data-target=".datepicker.offer_end"
											data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fas fa-business-time"></i></div>
										</div>
									</div>
									<div class="form-text text-muted">
										@lang('lang.insert_product_offer_end_time')
									</div>
								</div>
							</div>
						</div>

						<div
							class="form-group col-12 d-flex flex-column flex-md-row justify-content-md-end justify-content-sm-center border-top pt-4">
							{{-- <div class="d-flex flex-row justify-content-between align-items-center">
								{!! Form::label('featured', trans("lang.category_featured_help"),['class' =>
								'control-label my-0 mx-3'],false) !!} {!! Form::hidden('featured', 0,
								['id'=>"hidden_featured"]) !!}
								<span class="icheck-{{setting('theme_color')}}">
									{!! Form::checkbox('featured', 1, null) !!} <label for="featured"></label> </span>
							</div> --}}
							<button type="submit"
								class="btn bg-{{setting('theme_color')}} mx-md-3 my-lg-0 my-xl-0 my-md-0 my-2">
								<i class="fa fa-save"></i> {{trans('lang.save')}} @lang('lang.product')
							</button>
							<a href="{!! route('product.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i>
								{{trans('lang.cancel')}}</a>
						</div>
					</div>
				</form>
				<div class="clearfix"></div>
		</div>
	</div>
</div>
@include('layouts.media_modal')
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$('#description').summernote('destroy');
		$("#description").summernote('editor.pasteHTML', '{!! (isset($data->description) && !empty($data->description)) ? $data->description : old('description') !!}');
	});
</script>
@endsection
@push('scripts_lib')
<script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('vendor/summernote/summernote.min.js')}}"></script>
<script src="{{asset('vendor/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{asset('vendor/moment/moment.min.js')}}"></script>
<script src="{{asset('vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script type="text/javascript">
	Dropzone.autoDiscover = false;
        var dropzoneFields = [];
</script>

<script>
    $(document).ready(function() {
        $('.select2-multi').select2({
            tags: true, // Allow user to add new tags
            tokenSeparators: [',', ' '], // Define how tags are separated (e.g., by comma or space)
            createTag: function (params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true
                };
            }
        });
    });
</script>
@endpush
