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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{ isset($shippingRule) ? 'Edit Shipping Rule' : 'Create Shipping Rule' }}</div>
                
                                <div class="card-body">
                                    <form action="{{ isset($shippingRule) ? route('shippingrules.update', $shippingRule->id) : route('shippingrules.store') }}" method="POST">
                                        @csrf
                                        @if(isset($shippingRule))
                                            @method('PUT')
                                        @endif
                
                                        <div class="form-group">
                                            <label for="shipping_companies_id">Shipping Companies</label>
                                            <select name="shipping_companies_id[]" id="shipping_companies_id" class="form-control" multiple required>
                                                @foreach ($shippingCompanies as $company)
                                                    <option value="{{ $company->id }}" {{ (in_array($company->id, old('shipping_companies_id', isset($shippingRule) ? $shippingRule->shippingCompanies->pluck('id')->toArray() : []))) ? 'selected' : '' }}>{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address_id">Addresses</label>
                                            <select name="address_id[]" id="address_id" class="form-control" multiple="multiple">
                                                @foreach ($addresses as $address)
                                                    <option value="{{ $address->id }}" {{ (in_array($address->id, old('address_id', isset($shippingRule) ? $shippingRule->addresses->pluck('id')->toArray() : []))) ? 'selected' : '' }}>{{ $address->address }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="price_for_location">Price for Location</label>
                                            <input type="text" name="price_for_location" id="price_for_location" class="form-control" value="{{ old('price_for_location', isset($shippingRule) ? $shippingRule->price_for_location : '') }}" required>
                                        </div>
                                        
                                        {{-- <div class="form-group">
                                            <label for="price">weight</label>
                                            <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight', isset($shippingRule) ? $shippingRule->weight : '') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="price">price_for_weight</label>
                                            <input type="number" name="price_for_weight" id="price" class="form-control" value="{{ old('price_for_weight', isset($shippingRule) ? $shippingRule->price_for_weight : '') }}" required>
                                        </div> --}}

                                        <div id='form-group'>
                                            <!-- Input container -->
                                        </div>
                                        <button onclick='addInput()'>+ Add New Weight Range</button>
                                        
                                        <script>
                                            const container = document.getElementById('form-group');
                                            let inputCount = 1; // To track the number of input fields added
                                        
                                            function addInput() {
                                                // Create a div container for each group of inputs and labels
                                                let inputContainer = document.createElement('div');
                                        
                                                // Create a label for the Minimum Weight input
                                                let minWeightLabel = document.createElement('label');
                                                minWeightLabel.textContent = `Minimum Weight ${inputCount}: `;
                                                inputContainer.appendChild(minWeightLabel);
                                        
                                                // Create the Minimum Weight input field
                                                let minWeightInput = document.createElement('input');
                                                minWeightInput.placeholder = 'Minimum Weight';
                                                inputContainer.appendChild(minWeightInput);
                                        
                                                // Create a label for the Maximum Weight input
                                                let maxWeightLabel = document.createElement('label');
                                                maxWeightLabel.textContent = `Maximum Weight ${inputCount}: `;
                                                inputContainer.appendChild(maxWeightLabel);
                                        
                                                // Create the Maximum Weight input field
                                                let maxWeightInput = document.createElement('input');
                                                maxWeightInput.placeholder = 'Maximum Weight';
                                                inputContainer.appendChild(maxWeightInput);
                                        
                                                // Create a label for the Price for Weight input
                                                let priceForWeightLabel = document.createElement('label');
                                                priceForWeightLabel.textContent = `Price for Weight ${inputCount}: `;
                                                inputContainer.appendChild(priceForWeightLabel);
                                        
                                                // Create the Price for Weight input field
                                                let priceForWeightInput = document.createElement('input');
                                                priceForWeightInput.placeholder = 'Price for Weight';
                                                inputContainer.appendChild(priceForWeightInput);
                                        
                                                // Add the input container to the form group
                                                container.appendChild(inputContainer);
                                        
                                                inputCount++;
                                            }
                                        </script>
                
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">{{ isset($shippingRule) ? 'Update' : 'Create' }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
              
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    // Initialize Select2 for multiple select fields
    $('#shipping_companies_id, #address_id').select2({
        // Add additional options and configurations here if needed
    });
</script>
@endpush
