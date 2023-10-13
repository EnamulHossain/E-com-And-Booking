@extends('layouts.app')
@section('content')
  @include('admintemplate::admin.messages.error')
  @include('admintemplate::admin.messages.success')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
		        	<div class="row">
			        	<div class="col-md-12">
							Form Title Here
			        	</div>
			        </div>
				</div>
				<div class="card-body">
		        	<div class="row">
			        	<div class="col-md-12">
							form Content Here
			        	</div>
			        </div>
				</div>
			</div>
		</div>
	</div>
@endsection