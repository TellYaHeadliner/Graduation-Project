export interface MessageResponse{
    message: string;
}

export interface FavoriteHotels{
    id: number;
    name: string;
    address: string;
    avatar: string;
    star_rating: number;
    is_favorite: boolean;
}

export interface ShortCheckFavorites{
    id: number;
    is_favorite: boolean;
}

export interface SCFResponse{
    data: ShortCheckFavorites[];
}

export interface FHResponse{
    data: FavoriteHotels[];
}