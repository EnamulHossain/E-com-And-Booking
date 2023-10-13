<div class='btn-group btn-group-sm'>
    @can('salonLevels.show')
        <a data-toggle="tooltip" data-placement="left" title="{{trans('lang.view_details')}}" href="{{ route('salonLevels.show', $id) }}" class='btn btn-link'>
            <i class="fas fa-eye"></i> </a>
    @endcan

    @can('salonLevels.edit')
        <a data-toggle="tooltip" data-placement="left" title="{{trans('lang.salon_level_edit')}}" href="{{ route('salonLevels.edit', $id) }}" class='btn btn-link'>
            <i class="fas fa-edit"></i> </a>
    @endcan

    @can('salonLevels.destroy')
        {!! Form::open(['route' => ['salonLevels.destroy', $id], 'method' => 'delete']) !!}
        {!! Form::button('<i class="fas fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-link text-danger',
        'onclick' => "return confirm('Are you sure?')"
        ]) !!}
        {!! Form::close() !!}
    @endcan
</div>
