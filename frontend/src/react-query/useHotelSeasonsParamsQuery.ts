import { useQuery } from '@tanstack/react-query';
import hotelApi from "../api/Hotels.api"

export const useHotelSeasonsParamsQuery = (name: string) => {
    return useQuery({
        queryKey: ['hotel-seasons', name],
        queryFn: () => hotelApi.getHotelSeasonsParam(name),
        enabled: !!name, 
    });
};
