export interface Hotel {
  RoomVariant: any;
  id: number;
  name: string;
  address: string;
  description: string;
  star_rating: number;
  phone: string;
  email: string;
  mst: string;
  bank_account_number: string;
  bank_account_name: string;
  bank_name: string;
  avatar: string;
  gallery: string;
  status: number;
  reputation_score: number;
  created_at: string | null;
  updated_at: string;
  room_types: RoomType[];
}

export interface RoomType {
  id: number;
  hotel_id: number;
  name: string;
  area: number;
  room_quantity: number;
  room_code: string;
  description: string | null;
  gallery: string | null;
  bed_type_id: number;
  bed_quantity: number;
  status: number;
  created_at: string;
  updated_at: string;
  variants: RoomTypeVariant[];
}

export interface RoomTypeVariant {
  attributes: ReactNode;
  id: number;
  room_type_id: number;
  base_price: number;
  discount_price: number | null;
  fee_type: number;
  status: number;
  created_at: string;
  updated_at: string;
  available_room_count: number;
  seasons: Season[];
}

export interface Season {
  id: number;
  name: string;
  start_date: string;
  end_date: string;
  description: string | null;
  status: number;
  created_at: string;
  updated_at: string;
  pivot: Pivot;
}

export interface Pivot {
  room_type_variant_id: number;
  season_id: number;
  discount_type: number;
  discount_value: number;
  created_at: string | null;
  updated_at: string | null;
}

export interface HotelRule {
  id: number;
  check_in_time: string;
  check_out_time: string;
  pet_policy: number;
  child_policy: number;
  child_age_limit: number;
  extra_bed_fee: number;
  created_at: string;
  updated_at: string;
}

export interface RoomVariant {
  id: number;
  room_type_id: number;
  base_price: number;
  discount_price: number | null;
  fee_type: number;
  status: number;
  created_at: string;
  updated_at: string;
  seasons: Season[];
}

export interface Season {
  id: number;
  name: string;
  start_date: string;
  end_date: string;
  description: string | null;
  status: number;
  created_at: string;
  updated_at: string;
  pivot: SeasonPivot;
}

export interface DetailHotel {
  id: number;
  name: string;
  address: string;
  description: string;
  star_rating: number;
  phone: string;
  email: string;
  mst: string;
  bank_account_number: string;
  bank_account_name: string;
  bank_name: string;
  avatar: string;
  gallery: string;
  status: number;
  reputation_score: number;
  created_at: string | null;
  updated_at: string;
  hotel_rule: HotelRule;
  amenities: Amenity[];
  services: HotelService[];
  combos: Combo[];
  vouchers: Voucher[];
}

export interface Combo {
  id: number;
  hotel_id: number;
  name: string;
  short_description: string | null;
  combo_price: number;
  original_price: number;
  status: number;
  created_at: string;
  updated_at: string;
  combo_services: ComboService[];
}

export interface ComboService {
  combo_id: number;
  hotel_service_id: number;
  quantity: number;
  created_at: string;
  updated_at: string;
}
export interface HotelRule {
  id: number;
  check_in_time: string;
  check_out_time: string;
  pet_policy: number;
  child_policy: number;
  child_age_limit: number;
  extra_bed_fee: number;
  created_at: string;
  updated_at: string;
}

export interface SeasonPivot {
  room_type_variant_id: number;
  season_id: number;
  discount_type: number;
  discount_value: number;
  created_at: string | null;
  updated_at: string | null;
}

export interface Amenity {
  id: number;
  name: string;
  parent_id: number;
  created_at: string;
  updated_at: string;
  pivot: {
    hotel_id: number;
    amenity_id: number;
    created_at: string;
    updated_at: string;
  };
}

export interface HotelService {
  id: number;
  name: string;
  default_unit: string;
  status: number;
  created_at: string;
  updated_at: string;
  pivot: {
    hotel_id: number;
    service_id: number;
    short_description: string | null;
    base_price: number;
    promo_price: number | null;
    status: number;
    created_at: string;
    updated_at: string;
  };
}

export interface Voucher {
  id: number;
  code: string;
  discount_type: number;
  discount_value: number;
  max_discount_value: number;
  min_order_value: number;
  is_active: number;
  start_date: string;
  end_date: string;
  hotel_scope: number;
  customer_scope: number;
  created_at: string;
  updated_at: string;
  pivot: {
    hotel_id: number;
    voucher_id: number;
    created_at: string;
    updated_at: string;
  };
}


export interface HotelResponse {
  message: string;
  data: {
    hotels: Hotel[];
  }
}

export interface DetailHotelResponse {
  message: string;
  data: {
    hotel: DetailHotel
  }
}


