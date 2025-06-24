import { useQuery } from "@tanstack/react-query";
import hotelApi from "../api/Hotels.api";

export const useHotelSeasonsQuery = () => {
    return useQuery({
        queryKey: ["get-Hotel-Seasons"],
        queryFn: () => hotelApi.getHotelSeasons(),
        staleTime: Infinity,
        gcTime: Infinity,
        retry: false,
        refetchOnWindowFocus: false
    });
};