import { useMutation } from '@tanstack/react-query';
import authApi from '../api/Auth.api';
import { PayloadChangePassword } from '../types/UserTypes';

export const useChangePassword = () => {
    return useMutation({
        mutationFn: (data: PayloadChangePassword) => authApi.changePassword(data)
    })
}