<div class="d-flex align-items-center justify-content-center">
    <a href="{{ route('hotel.booking.edit', ['hotel_id' => Auth()->user()->id,'id'=>$id]) }}"><x-button type="button" class="m-1 btn-info btn-icon">
        <i class="ti ti-pencil"></i>
    </x-button></a>
</div>