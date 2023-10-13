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
        <nav class="navbar navbar-light bg-light justify-content-between">
            <a class="navbar-brand text-bold" href="{{route('shipping.create')}}">Add Company</a>
            <form class="form-inline">
              <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </nav>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shippingCompanies as $shippingCompany)
                    <tr>
                        <td>{{ $shippingCompany-> id }}</td>
                        <td>{{ $shippingCompany->name }}</td>
                        <td>{{ $shippingCompany->description }}</td>
                        <td>{{ $shippingCompany->phone }}</td>
                        <td>{{ $shippingCompany->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('shipping.edit', ['shipping' => $shippingCompany->id]) }}" class="ms-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="post" action="{{ route('shipping.destroy', ['shipping' => $shippingCompany->id]) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ms-3" onclick="return confirm('Are you sure you want to delete this Shipping Company?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
