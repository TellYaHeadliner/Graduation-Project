export interface ReviewPayload{
    hotel_id: number;
    user_id: number;
    star: number;
    content: string
}

export interface ReviewResponse{
    message: string;
    data: ReviewPayload;
}