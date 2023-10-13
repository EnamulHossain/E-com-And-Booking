<div class='btn-group btn-group-sm'>
    @can('hotelRooms.show')
        <a data-toggle="tooltip" data-placement="left" title="{{trans('lang.view_details')}}" href="{{ route('hotelRooms.show', $id) }}" class='btn btn-link'>
            <i class="fas fa-eye"></i> </a>
    @endcan

    @can('hotelRooms.edit')
        <a data-toggle="tooltip" data-placement="left" title="{{trans('lang.hotel_edit')}}" href="{{ route('hotelRooms.edit', $id) }}" class='btn btn-link'>
            <i class="fas fa-edit"></i> </a>
    @endcan

    @can('hotelRooms.destroy')
        {!! Form::open(['route' => ['hotelRooms.destroy', $id], 'method' => 'delete']) !!}
        {!! Form::button('<i class="fas fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-link text-danger',
        'onclick' => "return confirm('Are you sure?')"
        ]) !!}
        {!! Form::close() !!}
    @endcan
</div>
