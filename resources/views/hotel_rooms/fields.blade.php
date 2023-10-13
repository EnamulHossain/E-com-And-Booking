@if($customFields)
    <h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div class="d-flex flex-column col-sm-12 col-md-6">
    <!-- Image Field -->
{{--    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">--}}
{{--        {!! Form::label('image', trans("lang.hotel_image"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}--}}
{{--        <div class="col-md-9">--}}
{{--            <div style="width: 100%" class="dropzone image" id="image" data-field="image">--}}
{{--            </div>--}}
{{--            <a href="#loadMediaModal" data-dropzone="image" data-toggle="modal" data-target="#mediaModal" class="media_select btn btn-outline-{{setting('theme_color','primary')}} btn-sm float-right mt-1">{{ trans('lang.media_select')}}</a>--}}
{{--            <div class="form-text text-muted w-50">--}}
{{--                {{ trans("lang.hotel_image_help") }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    @prepend('scripts')--}}
{{--        <script type="text/javascript">--}}
{{--            var var16105363151854745906ble = [];--}}
{{--            @if(isset($hotel) && $hotel->hasMedia('image'))--}}
{{--            @forEach($hotel->getMedia('image') as $media)--}}
{{--            var16105363151854745906ble.push({--}}
{{--                name: "{!! $media->name !!}",--}}
{{--                size: "{!! $media->size !!}",--}}
{{--                type: "{!! $media->mime_type !!}",--}}
{{--                uuid: "{!! $media->getCustomProperty('uuid') !!}",--}}
{{--                thumb: "{!! $media->getUrl('thumb') !!}",--}}
{{--                collection_name: "{!! $media->collection_name !!}"--}}
{{--            });--}}
{{--            @endforeach--}}
{{--            @endif--}}
{{--            var dz_var16105363151854745906ble = $(".dropzone.image").dropzone({--}}
{{--                url: "{!!url('uploads/store')!!}",--}}
{{--                addRemoveLinks: true,--}}
{{--                maxFiles: 5 - var16105363151854745906ble.length,--}}
{{--                init: function () {--}}
{{--                    @if(isset($hotel) && $hotel->hasMedia('image'))--}}
{{--                    var16105363151854745906ble.forEach(media => {--}}
{{--                        dzInit(this, media, media.thumb);--}}
{{--                    });--}}
{{--                    @endif--}}
{{--                },--}}
{{--                accept: function (file, done) {--}}
{{--                    dzAccept(file, done, this.element, "{!!config('medialibrary.icons_folder')!!}");--}}
{{--                },--}}
{{--                sending: function (file, xhr, formData) {--}}
{{--                    dzSendingMultiple(this, file, formData, '{!! csrf_token() !!}');--}}
{{--                },--}}
{{--                complete: function (file) {--}}
{{--                    dzCompleteMultiple(this, file);--}}
{{--                    dz_var16105363151854745906ble[0].mockFile = file;--}}
{{--                },--}}
{{--                removedfile: function (file) {--}}
{{--                    dzRemoveFileMultiple(--}}
{{--                        file, var16105363151854745906ble, '{!! url("hotels/remove-media") !!}',--}}
{{--                        'image', '{!! isset($hotel) ? $hotel->id : 0 !!}', '{!! url("uploads/clear") !!}', '{!! csrf_token() !!}'--}}
{{--                    );--}}
{{--                }--}}
{{--            });--}}
{{--            dz_var16105363151854745906ble[0].mockFile = var16105363151854745906ble;--}}
{{--            dropzoneFields['image'] = dz_var16105363151854745906ble;--}}
{{--        </script>--}}
{{--@endprepend--}}

    <!-- E Provider Type Id Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('hotel_id', trans("lang.hotel"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::select('hotel_id', $hotels, null, ['class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">Insert Hotel</div>
        </div>
    </div>

    <!-- Name Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('name', "Room No", ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('room_no', null,  ['class' => 'form-control','placeholder'=>  "Room No"]) !!}
            <div class="form-text text-muted">
                Insert Room No
            </div>
        </div>
    </div>

    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('price', trans("lang.price"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::number('price', null,  ['class' => 'form-control','placeholder'=>  trans("lang.price"),'step'=>"any", 'min'=>"0"]) !!}
            <div class="form-text text-muted">
                {!! trans("lang.price")   !!}
            </div>
        </div>
    </div>


    <!-- Users Field -->
{{--    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">--}}
{{--        {!! Form::label('users[]', trans("lang.hotel_users"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!}--}}
{{--        <div class="col-md-9">--}}
{{--            {!! Form::select('users[]', $user, $usersSelected, ['class' => 'select2 form-control' , 'multiple'=>'multiple']) !!}--}}
{{--            <div class="form-text text-muted">{{ trans("lang.hotel_users_help") }}</div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- Notes Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('notes', 'Notes', ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::textarea('note', null, ['class' => 'form-control','placeholder'=>
             trans("lang.notes_placeholder")  ]) !!}
            <div class="form-text text-muted">Insert Note</div>
        </div>
    </div>

</div>
<div class="d-flex flex-column col-sm-12 col-md-6">

    <!-- Phone Number Field -->
{{--    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">--}}
{{--        {!! Form::label('phone_number', trans("lang.hotel_phone_number"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}--}}
{{--        <div class="col-md-9">--}}
{{--            {!! Form::text('phone_number', null,  ['class' => 'form-control','placeholder'=>  trans("lang.hotel_phone_number_placeholder")]) !!}--}}
{{--            <div class="form-text text-muted">--}}
{{--                {{ trans("lang.hotel_phone_number_help") }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- Mobile Number Field -->
{{--    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">--}}
{{--        {!! Form::label('mobile_number', trans("lang.hotel_mobile_number"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}--}}
{{--        <div class="col-md-9">--}}
{{--            {!! Form::text('mobile_number', null,  ['class' => 'form-control','placeholder'=>  trans("lang.hotel_mobile_number_placeholder")]) !!}--}}
{{--            <div class="form-text text-muted">--}}
{{--                {{ trans("lang.hotel_mobile_number_help") }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- Address Field -->
{{--    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">--}}
{{--        {!! Form::label('address_id', trans("lang.hotel_address"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!}--}}
{{--        <div class="col-md-9">--}}
{{--            {!! Form::select('address_id', $address, null, ['class' => 'select2 form-control']) !!}--}}
{{--            <div class="form-text text-muted">{{ trans("lang.hotel_address_help") }}</div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- Taxes Field -->
{{--    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">--}}
{{--        {!! Form::label('taxes[]', trans("lang.hotel_taxes"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!}--}}
{{--        <div class="col-md-9">--}}
{{--            {!! Form::select('taxes[]', $tax, $taxesSelected, ['class' => 'select2 form-control' , 'multiple'=>'multiple']) !!}--}}
{{--            <div class="form-text text-muted">{{ trans("lang.hotel_taxes_help") }}</div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- Availability Range Field -->
{{--    <div class="form-group align-items-baseline d-flex flex-column flex-md-row ">--}}
{{--        {!! Form::label('availability_range', trans("lang.hotel_availability_range"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}--}}
{{--        <div class="col-md-9">--}}
{{--            <div class="input-group">--}}
{{--                {!! Form::number('availability_range', null, ['class' => 'form-control','step'=>'any', 'min'=>'0', 'placeholder'=> trans("lang.hotel_availability_range_placeholder")]) !!}--}}
{{--                <div class="input-group-append">--}}
{{--                    <div class="input-group-text text-bold px-3">{{trans("lang.app_setting_".setting('distance_unit','mi'))}}</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="form-text text-muted">--}}
{{--                {{ trans("lang.hotel_availability_range_help") }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

</div>
@if($customFields)
    <div class="clearfix"></div>
    <div class="col-12 custom-field-container">
        <h5 class="col-12 pb-4">{!! trans('lang.custom_field_plural') !!}</h5>
        {!! $customFields !!}
    </div>
@endif
<!-- Submit Field -->
<div class="form-group col-12 d-flex flex-column flex-md-row justify-content-md-end justify-content-sm-center border-top pt-4">
    @role('admin')
    <div class="d-flex flex-row justify-content-between align-items-center">
        {!! Form::label('accepted', trans("lang.hotel_accepted"),['class' => 'control-label my-0 mx-3']) !!} {!! Form::hidden('accepted', 0, ['id'=>"hidden_accepted"]) !!}
        <span class="icheck-{{setting('theme_color')}}">
            {!! Form::checkbox('accepted', 1, null) !!} <label for="accepted"></label> </span>
    </div>
    @endrole
    <div class="d-flex flex-row justify-content-between align-items-center">
        {!! Form::label('available', trans("lang.hotel_available"),['class' => 'control-label my-0 mx-3']) !!} {!! Form::hidden('available', 0, ['id'=>"hidden_available"]) !!}
        <span class="icheck-{{setting('theme_color')}}">
            {!! Form::checkbox('available', 1, null) !!} <label for="available"></label> </span>
    </div>
    <div class="d-flex flex-row justify-content-between align-items-center">
        {!! Form::label('featured', trans("lang.hotel_featured"),['class' => 'control-label my-0 mx-3']) !!} {!! Form::hidden('featured', 0, ['id'=>"hidden_featured"]) !!}
        <span class="icheck-{{setting('theme_color')}}">
            {!! Form::checkbox('featured', 1, null) !!} <label for="featured"></label> </span>
    </div>
    <button type="submit" class="btn bg-{{setting('theme_color')}} mx-md-3 my-lg-0 my-xl-0 my-md-0 my-2">
        <i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.hotel')}}</button>
    <a href="{!! route('hotels.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
