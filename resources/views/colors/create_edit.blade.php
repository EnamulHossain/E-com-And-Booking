@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-bold">Color<small class="mx-3">|</small><small>Color</small>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb bg-white float-sm-right rounded-pill px-4 py-2 d-none d-md-flex">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fas fa-tachometer-alt"></i>
                                {{ trans('lang.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('colors.index') !!}"></a>
                        </li>
                        <li class="breadcrumb-item active">Color</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div class="m-4">

    <div class="container">
        @if(isset($color->id))
            <h1>Edit Color</h1>
            <form action="{{ route('colors.update', $color->id) }}" method="POST">
                @method('PUT')
        @else
            <h1>Create Color</h1>
            <form action="{{ route('colors.store') }}" method="POST">
        @endif
    
        @csrf
    
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $color->color ?? '') }}">
        </div>
        <div class="form-group">
            <label for="plate">Color Plate:</label>
            <input type="color" class="form-control" id="plate" value="{{ old('plate', $color->plate ?? '') }}">
        </div>
    
        <button type="submit" class="btn btn-primary">
            @if(isset($color->id))
                Update
            @else
                Create
            @endif
        </button>
    </form>
    </div>
    
    
@endsection
