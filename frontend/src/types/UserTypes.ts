export interface User {
    id: string;
    fullname: string;
    email: string;
    phone: string;
    birthDay?: Date;
    gender?: number;
    address?: string;
    avatar?: string;
    role: number;
    status: number;
}

export interface LoginResponse {
    message: string;
}