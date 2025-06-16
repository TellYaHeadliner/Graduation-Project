import { LoginResponse } from "../types/UserTypes"
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
};

export default authApi;