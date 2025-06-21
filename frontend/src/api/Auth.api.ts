import { newFormattedForm } from '../components/Form/FormRegister';
import { LoginResponse, UserResponse } from '../types/UserTypes';
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
    signIn: (data: newFormattedForm): Promise<UserResponse>  => {
        return api.post('/auth/register', data, {
            headers: {
                "Content-Type": "multipart/form-data"
            },
        });
    }
};

export default authApi;