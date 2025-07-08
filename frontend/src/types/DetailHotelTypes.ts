export interface DetailHotel{
    id: number;
    name: string;
    address: string;
    description: string;
    star_rating: number;
    phone: string;
    email: number;
    avatar: string;
    gallery: string;
    rules: Rule;
    amenities: Amenity[];
    services: Service[];
    combos: Combo[];
    vouchers: Voucher[];
    reviews: Review[];
}

export interface Rule{
    check_in_time: string;
    check_out_time: string;
    pet_policy: boolean;
    child_policy: boolean;
    child_age_limit: number;
    extra_bed_fee: number;
}

interface Amenity{
    name: string;
}

export interface Service{
    id: number;
    name: string;
    quantity: number;
    default_unit: string;
    short_description: string | null;
    base_price: number;
    promo_price: number | null;
}

export interface Combo{
    id: number;
    name: string;
    short_description: string | null;
    combo_price: number;
    original_price: number;
    services: Service[];
}

export interface Voucher{
    id: number;
    code: string;
    discount: {
        type: number;
        value: number;
        max: number;
    }
    min_order_value: number;
    start_date: string;
    end_date: string;
}

export interface Review{
    user_name: string;
    star: number;
    content: string;
    created_at: string;
    room_type: string;
}
  

export interface DetailHotelResponse{
    message: string;
    data: {
        hotel: DetailHotel;
    }
}