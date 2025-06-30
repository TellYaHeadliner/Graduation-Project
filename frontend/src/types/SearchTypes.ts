export interface CardSearch{
    id: number;
    name: string;
    address: string;
    avarage_star: number;
    total_review: number;
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
}

export interface PayloadSearchParams{
    address: string;
    guest: number;
    children: number;
    checkin: string | null;
    checkout: string | null;
}

export interface SearchResponse{
    message: string;
    data: CardSearch[];
}
