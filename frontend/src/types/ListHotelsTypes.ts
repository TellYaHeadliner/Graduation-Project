export interface Hotel {
  id: number;
  name: string;
  address: string;
  description: string;
  star_rating: number;
  phone: string;
  email: string;
  avatar: string;
  gallery: string;
  status: number;
  reputation_score: number;
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
  variants: RoomTypeVariant[];
}

export interface RoomTypeVariant {
  id: number;
  room_type_id: number;
  base_price: number;
  discount_price: number | null;
  fee_type: number;
  status: number;
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
  pivot: Pivot;
}

export interface Pivot {
  room_type_variant_id: number;
  season_id: number;
  discount_type: number;
  discount_value: number;
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
}

export interface SeasonPivot {
  room_type_variant_id: number;
  season_id: number;
  discount_type: number;
  discount_value: number;
}

export interface HotelResponse {
  message: string;
  data: {
    hotels: Hotel[];
  }
}


