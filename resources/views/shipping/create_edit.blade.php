@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-bold">Shipping<small class="mx-3">|</small><small>Shipping Company</small>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb bg-white float-sm-right rounded-pill px-4 py-2 d-none d-md-flex">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fas fa-tachometer-alt"></i>
                                {{ trans('lang.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('shipping.index') !!}"></a>
                        </li>
                        <li class="breadcrumb-item active">Shipping</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div class="m-4">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($shippingCompany) ? 'Edit Shipping Company' : 'Create Shipping Company' }}</div>
    
                    <div class="card-body">
                        <form action="{{ isset($shippingCompany) ? route('shipping.update', $shippingCompany->id) : route('shipping.store') }}" method="POST">
                            @csrf
                            @if(isset($shippingCompany))
                                @method('PUT')
                            @endif
    
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($shippingCompany) ? $shippingCompany->name : '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', isset($shippingCompany) ? $shippingCompany->description : '') }}</textarea>
                            </div>
    
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', isset($shippingCompany) ? $shippingCompany->phone : '') }}" required>
                            </div>
    
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="1" {{ (old('status', isset($shippingCompany) ? $shippingCompany->status : '') == 1) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ (old('status', isset($shippingCompany) ? $shippingCompany->status : '') == 0) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
    
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">{{ isset($shippingCompany) ? 'Update' : 'ADD' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
