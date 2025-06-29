export interface HistoryBooking{
    id: number;
    hotel_name: string;
    address: string;
    total_price: number;
    check_in: string;
    check_out: string;
    status: string;
}

export interface HistoryBookingResponse{
    message: string;
    data: HistoryBooking[];
}

interface DetailBooking{
    id: number;
    booking_code: string;
    total_amount: number;
    check_in: string;
    check_out: string;
    status: string;
    note: string;
    created_at: string;
    cancellation_fee: number;
    customer: {
        name: string;
        email: string;
        phone: string;
    }
    hotel: {
        name: string;
        address: string;
        avatar: string;
    }
    voucher: Voucher[];
    booking_details: BookingDetails[];
    booking_services: BookingService[];
    booking_combos: BookingCombo[];
}

interface BookingDetails{
    room_code: string;
    room_type: string;
    price: number;
    refund_policy: {
        name: string;
        value: string;
    }
}

interface Voucher{
    id: number;
    code: string;
    discount: Discount[];
    min_order_value: number;
    start_date: string;
    end_date: string;
}

interface Discount{
    type: number;
    value: number;
    max: number;
}

interface BookingService{
    name: string;
    default_unit: string;
    quantity: number;
    price: number;
    total_price: number;
}

interface BookingCombo{
    combo_name: string;
    quantity: number;
    price: number;
    total_price: number;
    services: Service[];
}

interface Service{
    name: string;
    quantity: number;
}

export interface DetailBookingResponse{
    message: string;
    data: DetailBooking;
}