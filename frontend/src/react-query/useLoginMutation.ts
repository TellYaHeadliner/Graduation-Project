import { useMutation } from "@tanstack/react-query";
import { useNavigate } from "react-router-dom";
import authApi from "../api/Auth.api";
import { ErrorUtils } from '../utils/Error';

export const useLoginMutation = () => {
    const navigate = useNavigate();

    return useMutation({
        mutationFn: ({ email, password}: { email: string; password: string }) =>
            authApi.login(email, password),

        onSuccess: () => {
            setTimeout(() => {
                navigate("/")
            }, 5000);
        },

        onError: (error) => {
            const errorUtils = new ErrorUtils()
            errorUtils.handleError(error);
        }
    })
};