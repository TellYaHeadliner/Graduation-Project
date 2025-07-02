import { useQuery } from "@tanstack/react-query";
import amentityApi from "../api/Amentity.api";

export const useAmentities = ( ) => {
    return useQuery({
        queryKey: ["get-booking-detail"],
        queryFn: () => amentityApi.getAmentites(),
        staleTime: Infinity,
        gcTime: Infinity,
        retry: false,
        refetchOnWindowFocus: false
    });
};