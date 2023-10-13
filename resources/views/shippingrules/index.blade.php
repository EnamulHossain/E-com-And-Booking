@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-bold">Shipping<small class="mx-3">|</small><small>Shipping Rules</small>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb bg-white float-sm-right rounded-pill px-4 py-2 d-none d-md-flex">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fas fa-tachometer-alt"></i>
                                {{ trans('lang.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('shipping.index') !!}"></a>
                        </li>
                        <li class="breadcrumb-item active">Shipping Rules</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div class="m-4">

    <div class="container">
        <nav class="navbar navbar-light bg-light justify-content-between">
            <a class="navbar-brand text-bold" href="{{route('shippingrules.create')}}">Add Shipping Rules</a>
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
                    <th scope="col">Addresses</th>
                    <th scope="col">Price</th>
                    {{-- <th scope="col">Status</th> --}}
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shippingRules as $shippingRules)
                    <tr>
                        <td>{{ $shippingRules-> id }}</td>
                        <td>{{ $shippingRules->shipping_companies_id }}</td>
                        <td>{{ $shippingRules->address_id }}</td>
                        <td>{{ $shippingRules->price_for_location }}</td>
                        {{-- <td>{{ $shippingRules->status ? 'Active' : 'Inactive' }}</td> --}}
                        <td>
                            {{-- <a href="" class="ms-3"><i class="fas fa-edit "></i></a> --}}
                            <form method="post" action="{{route('shippingrules.destroy', ['shippingrule' => $shippingRules->id])}}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ms-3" onclick="return confirm('Are you sure you want to delete this Shipping Company?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
