<x-link :href="route('hotel.room_type.edit', ['hotel_id' => Auth()->user()->id, 'id' => $model->roomType->id])"
    :title="$model->roomType->name" />