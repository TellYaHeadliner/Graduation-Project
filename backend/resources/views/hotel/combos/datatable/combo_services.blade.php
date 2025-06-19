    <x-link 
        :href="route('hotel.combo_service.index', ['hotel_id' => Auth()->user()->id,'combo_id' => $id])" 
        :title="__('Các dich vụ của combo')" 
    />