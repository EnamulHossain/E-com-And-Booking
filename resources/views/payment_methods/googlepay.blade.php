<h5 class="col-12 pb-4">{!! trans('lang.app_setting_google_credentials') !!}</h5>
<div class="d-flex flex-column col-sm-12 col-md-6">
    <!-- Route Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('googlepay_merchantId', trans("lang.app_setting_merchantId"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('googlepay_merchantId', setting('googlepay_merchantId'),  ['class' => 'form-control','placeholder'=>  trans("lang.app_setting_merchantId_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.app_setting_merchantId_help") }}
            </div>
        </div>
    </div>
    <!-- Route Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('googlepay_merchantName', trans("lang.app_setting_merchantName"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('googlepay_merchantName', setting('googlepay_merchantName'),  ['class' => 'form-control','placeholder'=>  trans("lang.app_setting_merchantName_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.app_setting_merchantName_help") }}
            </div>
        </div>
    </div>    
</div>
<div class="d-flex flex-column col-sm-12 col-md-6">
    <!-- Boolean Enabled Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('enable_googlepay_test', trans("lang.app_setting_enable_googlepay_test"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        {!! Form::hidden('enable_googlepay_test', 0, ['id'=>"hidden_enable_googlepay_test"]) !!}
        <div class="col-9 icheck-{{setting('theme_color')}}">
            {!! Form::checkbox('enable_googlepay_test', 1, setting('enable_googlepay_test')) !!}
            <label for="enable_googlepay_test"></label>
        </div>
    </div>
    <!-- Boolean Enabled Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('enable_googlepay', trans("lang.app_setting_enable_googlepay"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        {!! Form::hidden('enable_googlepay', 0, ['id'=>"hidden_enable_googlepay"]) !!}
        <div class="col-9 icheck-{{setting('theme_color')}}">
            {!! Form::checkbox('enable_googlepay', 1, setting('enable_googlepay')) !!}
            <label for="enable_googlepay"></label>
        </div>
    </div>
</div>