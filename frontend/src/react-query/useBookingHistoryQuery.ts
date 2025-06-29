import { useQuery } from "@tanstack/react-query";
import bookingApi from "../api/Booking.api";

export const useBookingHistoryQuery = () => {
    return useQuery({
        queryKey: ["get-booking-history"],
        queryFn: () => bookingApi.getBookingHistory(),
        staleTime: Infinity,
        gcTime: Infinity,
        retry: false,
        refetchOnWindowFocus: false
    });
};