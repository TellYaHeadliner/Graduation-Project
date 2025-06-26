export interface RoomType{
  id: number;
  name: string;
  area: number;
  description: string;
  gallery: string | null;
  available_room_count: number;
  bed:{
    type_name: string;
    quantity: number;
  }
  amenities: Amenity[];
  variants: Variant[];
}

interface Amenity{
  name: string;
}

interface Variant{
  id: number;
  base_price: number;
  discount_price: number | null;
  seasons: Season[];
  attributes:  Attribute[];
}

interface Season{
  id: number;
  name: string;
  discount_type: number;
  discount_value: number;
}

interface Attribute{
  name: string;
  value: number;
}

export interface RoomTypeResponse{
  message: string;
  data: {
    list: RoomType[];
  }
}