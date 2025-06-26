export interface RoomTypeofDetail {
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
    variants: RoomVariant[];
    amenities: Amenity[];
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
    available_room_count: number;
    seasons: Season[];
    attributes: Attribute[];
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
    pivot: {
      room_type_variant_id: number;
      season_id: number;
      discount_type: number;
      discount_value: number;
      created_at: string | null;
      updated_at: string | null;
    };
  }

export interface SeasonPivot {
    room_type_variant_id: number;
    season_id: number;
    discount_type: number;
    discount_value: number;
    created_at: string | null;
    updated_at: string | null;
}

export interface Attribute {
    id: number;
    name: string;
    type: string;
    pivot: {
      variant_id: number;
      attribute_id: number;
      attribute_value: string;
      created_at: string;
      updated_at: string;
    };
  }

export interface AttributePivot {
    variant_id: number;
    attribute_id: number;
    attribute_value: string;
    created_at: string;
    updated_at: string;
}

export interface Amenity {
    id: number;
    name: string;
    pivot: {
      room_type_id: number;
      amenity_id: number;
    };
  }

export interface AmenityPivot {
    room_type_id: number;
    amenity_id: number;
}

export interface RoomTypeResponse{
    message: string;
    data: {
        list: RoomType[]
    }
}