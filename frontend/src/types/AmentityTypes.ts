export interface Amentity{
    id: number;
    name: string;
    children: Amentity[];
}

export interface AmentityResponse{
    message: string;
    data: Amentity[];
}