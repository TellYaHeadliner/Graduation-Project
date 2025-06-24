<x-link :href="route('hotel.room_type_variant.index', ['hotel_id' => Auth()->user()->id, 'room_type_id' => $id])"
    :title="__('Các biến thể của loại phòng')" />