export interface BookingDetail {
    room_type_id: number;
    room_type_variant_id: number;
    quantity: number;
}

export interface BookingCombo {
    combo_id: number;
    quantity: number;
}
  
export interface BookingService {
    hotel_service_id: number;
    quantity: number;
}