export interface TransactionsResponse {
    messsage: string;
    url?: string;
}

export interface BookingPayload {
    hotel_id: number;
    checkin_date: string;
    checkout_date: string;
    note?: string;
    booking_details: {
      room_type_id: number;
      room_type_variant_id: number;
      quantity: number;
    }[];
    booking_combos?: {
      combo_id: number;
      quantity: number;
    }[];
    booking_services?: {
      hotel_service_id: number;
      quantity: number;
    }[];
}