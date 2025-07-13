import { newFormattedForm } from '../components/Form/FormRegister';
import { ForgetPasswordResponse, LoginResponse, PayloadChangePassword, UserResponse } from '../types/UserTypes';
import api from "./axiosConfig"

const authApi = {
    login: (email: string, password: string): Promise<LoginResponse> => {
        return api.post('/auth', null, {
            params: {
                email,
                password,
            },
        });
    },
    userInfo: (): Promise<UserResponse> => {
        return api.get('/users/user-info')
    },
    logOut: (): Promise<LoginResponse> => {
        return api.post('/auth/logout')
    },
    signIn: (data: newFormattedForm): Promise<UserResponse> => {
        return api.post('/auth/register', data, {
            headers: {
                "Content-Type": "multipart/form-data"
            },
        });
    },

    forgetPassword: (email: string): Promise<ForgetPasswordResponse> => {
        return api.put('/users/forgot-password', null,{
            params: {
                email: { email }
            }
        })
    },

    resendVerification: (email: string): Promise<{ message: string }> => {
        return api.post('/auth/resend-email', { email });
    },

    changePassword: (data: PayloadChangePassword): Promise<{ message: string}> => {
        return api.post('/users/update', {
            ...data,
            _method: 'PUT'
        })
    }
};

export default authApi;