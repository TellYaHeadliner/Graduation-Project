export interface User {
    id: string;
    fullname: string;
    email: string;
    phone: string;
    birthDay?: string;
    gender?: number;
    address?: string;
    avatar?: string;
    role: number;
    status: number;
    created_at: string;
}

export interface UserResponse {
    fullname: string;
    message: string;
    data: {
        user: User;
    }
}

export interface LoginResponse {
    message: string;
    status: number;
}

export interface ForgetPasswordResponse {
    message: string;
}
