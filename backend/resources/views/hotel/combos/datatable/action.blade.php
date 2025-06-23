<div class="d-flex align-items-center justify-content-center">
    <x-button.modal-delete class="btn-icon"
        data-route="{{ route('hotel.combo.delete', ['hotel_id' => Auth()->user()->id, 'id' => $id]) }}">
        <i class="ti ti-trash"></i>
    </x-button.modal-delete>
    <a href="{{ route('hotel.combo.edit', ['hotel_id' => Auth()->user()->id, 'id' => $id]) }}"><x-button
            type="button" class="m-1 btn-info btn-icon">
            <i class="ti ti-pencil"></i>
        </x-button></a>
</div>