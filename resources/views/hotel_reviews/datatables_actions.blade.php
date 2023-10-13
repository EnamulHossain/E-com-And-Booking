<div class='btn-group btn-group-sm'>
    @can('hotelReviews.show')
        <a data-toggle="tooltip" data-placement="left" title="{{trans('lang.view_details')}}" href="{{ route('hotelReviews.show', $id) }}" class='btn btn-link'>
            <i class="fas fa-eye"></i> </a> @endcan

    @can('hotelReviews.edit')
        <a data-toggle="tooltip" data-placement="left" title="{{trans('lang.hotel_review_edit')}}" href="{{ route('hotelReviews.edit', $id) }}" class='btn btn-link'>
            <i class="fas fa-edit"></i> </a> @endcan

    @can('hotelReviews.destroy') {!! Form::open(['route' => ['hotelReviews.destroy', $id], 'method' => 'delete']) !!} {!! Form::button('<i class="fas fa-trash"></i>', [ 'type' => 'submit', 'class' => 'btn btn-link text-danger', 'onclick' => "return confirm('Are you sure?')" ]) !!} {!! Form::close() !!} @endcan
</div>
