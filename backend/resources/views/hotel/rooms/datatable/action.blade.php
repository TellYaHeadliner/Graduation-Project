<div class="d-flex align-items-center justify-content-center">
    <x-button.modal-delete class="btn-icon"
        data-route="{{ route('hotel.room.delete', ['hotel_id' => Auth()->user()->id, 'id' => $id ,'room_type_variant_id' => $variant_id]) }}">
        <i class="ti ti-trash"></i>
    </x-button.modal-delete>
    <a href="{{ route('hotel.room.edit', ['hotel_id' => Auth()->user()->id, 'id' => $id , 'room_type_variant_id' => $variant_id]) }}"><x-button
            type="button" class="m-1 btn-info btn-icon">
            <i class="ti ti-pencil"></i>
        </x-button></a>
</div>