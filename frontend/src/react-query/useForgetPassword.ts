import { useMutation } from "@tanstack/react-query";
import authApi from "../api/Auth.api";
import { ForgetPasswordResponse } from "../types/UserTypes";

export function useForgetPassword() {
    return useMutation<ForgetPasswordResponse, Error, string>({
        mutationFn: (email: string) => authApi.forgetPassword(email),
    });
}