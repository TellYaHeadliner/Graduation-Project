export interface TransactionsResponse {
    message: string;
    url: string;
}
export interface BookingPayload {
    hotel_id: number;
    checkin_date: string;
    checkout_date: string;
    note?: string;
    booking_details: BookingDetailPayload[];
    booking_combos?: ComboPayload[];
    booking_services?: BookingServicePayload[];
    voucher?: string;
}
export interface ComboPayload{
  combo_id: number;
  quantity: number;
}
export interface BookingDetailPayload{
  room_type_id: number;
  room_type_variant_id: number;
  quantity: number;
}
export interface BookingServicePayload{
  hotel_service_id: number;
  quantity: number;
}