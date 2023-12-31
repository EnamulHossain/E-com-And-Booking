<div class='btn-group btn-group-sm'>
    @can('hotelLevels.show')
        <a data-toggle="tooltip" data-placement="left" title="{{trans('lang.view_details')}}" href="{{ route('hotelLevels.show', $id) }}" class='btn btn-link'>
            <i class="fas fa-eye"></i> </a>
    @endcan

    @can('hotelLevels.edit')
        <a data-toggle="tooltip" data-placement="left" title="{{trans('lang.hotel_level_edit')}}" href="{{ route('hotelLevels.edit', $id) }}" class='btn btn-link'>
            <i class="fas fa-edit"></i> </a>
    @endcan

    @can('hotelLevels.destroy')
        {!! Form::open(['route' => ['hotelLevels.destroy', $id], 'method' => 'delete']) !!}
        {!! Form::button('<i class="fas fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-link text-danger',
        'onclick' => "return confirm('Are you sure?')"
        ]) !!}
        {!! Form::close() !!}
    @endcan
</div>
