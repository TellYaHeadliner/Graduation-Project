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
    password: string;
}

export interface PayloadChangePassword{
    fullname: string;
    email: string;
    gender: number;
    password_new: string;
}

export interface UserResponse {
    fullname: string;
    message: string;
    redirect?: string;
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
