export interface MessageResponse{
    message: string;
}

export interface ShortCheckFavorites{
    id: number;
    is_favorite: boolean;
}

export interface SCFResponse{
    data: ShortCheckFavorites[];
}