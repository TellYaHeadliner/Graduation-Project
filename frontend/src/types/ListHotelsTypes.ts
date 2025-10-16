export interface Hotel {
  id: number;
  name: string;
  address: string;
  avatar: string;
  star_rating: number;
  avg_star: number;
  total_reviews: number;
  base_price: number;
  discount_price: number | null;
}


export interface HotelResponse {
  message: string;
  data: {
    hotels: Hotel[];
  }
}


