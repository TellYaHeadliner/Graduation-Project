import { useQuery } from "@tanstack/react-query";
import hotelApi from "../api/Hotels.api";

export const useHotelDetailQuery = (id: number) => {
    return useQuery({
        queryKey: ["get-detail-hotel" , id],
        queryFn: () => hotelApi.getHotelDetail(id),
        staleTime: Infinity,
        gcTime: Infinity,
        retry: false,
        refetchOnWindowFocus: false
    });
};