<div class="d-flex align-items-center justify-content-center">
    <x-button.modal-delete class="btn-icon"
        data-route="{{ route('hotel.combo_service.delete', ['hotel_id' => Auth()->user()->id,'combo_id'=> $combo['id'],'hotel_service_id'=>$hotel_service_id]) }}">
        <i class="ti ti-trash"></i>
    </x-button.modal-delete>
    <a href="{{ route('hotel.combo_service.edit', ['hotel_id' => Auth()->user()->id,'combo_id'=> $combo['id'],'hotel_service_id'=>$hotel_service_id]) }}"><x-button
            type="button" class="m-1 btn-info btn-icon">
            <i class="ti ti-pencil"></i>
        </x-button></a>
</div>
