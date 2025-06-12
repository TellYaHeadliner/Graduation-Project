<div class="d-flex align-items-center justify-content-center">
    <x-button.modal-delete class="btn-icon" data-route="{{ route('admin.hotel.deleteHotelApproval', $id) }}">
        <i class="ti ti-ban"></i>
    </x-button.modal-delete> 
    <a href="{{ route('admin.hotel.editHotelApproval', $id) }}"><x-button type="button" class="m-1 btn-info btn-icon">
        <i class="ti ti-eye"></i>
    </x-button></a>
</div>