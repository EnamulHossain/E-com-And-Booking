@extends('layouts.app')
@section('content')
	<div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-3"></div>
			<div class="col-md-6">
			  <div class="card card-primary">
		    	@if(isset($data->id) && !empty($data->id))
		    		<form role="form" action="{{Route('tag.editaction',$data->id)}}" method="post">
		    		<input type="hidden" name="id" value="{{ isset($data->id) ? $data->id : 0 }}" id="id">
		    	@else
		    		<form role="form" action="{{ Route('tag.createaction') }}" method="post">
				@endif
				@csrf
			      <div class="card-body">
			        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name">Tag Name</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Tag Name" value="{{ (isset($data->name) && !empty($data->name)) ? $data->name : old('name') }}">
						@if($errors->has('name'))
						  <span class="help-block">
								<strong>
									{{ $errors->first('name') }}
								</strong>
						  </span>
						@endif
				  </div>
				  <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
						<label for="name">Tag Slug</label>
						<input type="text" class="form-control" name="slug" id="slug" placeholder="Tag Slug" value="{{ (isset($data->slug) && !empty($data->slug)) ? $data->slug : old('slug') }}">
						@if($errors->has('slug'))
						  <span class="help-block">
								<strong>
									{{ $errors->first('slug') }}
								</strong>
						  </span>
						@endif
				  </div>
			      </div>
			      <div class="card-footer">
			        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
			      </div>
			    </form>
			  </div>
			</div>
		</div>
	</div>
@endsection
@section('script')	
@endsection