import { useQuery } from "@tanstack/react-query";
import authApi from "../api/Auth.api";

export const useUserInfoQuery = () => {
    return useQuery({
        queryKey: ["user-info"],
        queryFn: () => authApi.userInfo(),
        staleTime: Infinity,
        gcTime: Infinity,
        retry: false,
        refetchOnWindowFocus: false
    });
};