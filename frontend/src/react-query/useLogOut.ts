import { useMutation, useQueryClient } from "@tanstack/react-query";
import authApi from "../api/Auth.api";
import { ErrorUtils } from "../utils/Error";


export const useLogOut = () => {
    const queryClient = useQueryClient();

    return useMutation({
        mutationFn: async () => {
            queryClient.clear();
            
            try {
                await authApi.logOut();
                window.location.reload();
            } catch ( error ) {
                const errorUtils = new ErrorUtils();
                errorUtils.handleError(error);
            }
        }
    })
}