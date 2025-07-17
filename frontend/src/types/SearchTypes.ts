import { Amentity } from "./AmentityTypes";

export interface CardSearch{
    id: number;
    name: string;
    address: string;
    average_star: number;
    total_reviews: number;
    avatar: string;
    room_type: {
        name: string;
        base_price: number;
        discount_price: number;
        bed_type: string;
        bed_quantity: number;
        guest: number;
        children: number;
        cancellation: string;
    }
    amenities: Amentity[];
    seasons: string;
}

    export interface PayloadSearchParams{
        address: string;
        guest: number;
        children: number;
        checkin: string | null;
        checkout: string | null;
        quantity: number;
        amenities?: number[];
        min_price?: number;
        max_price?: number;
        min_rating?: number;
    }

export interface SearchResponse{
    message: string;
    data: CardSearch[];
}
