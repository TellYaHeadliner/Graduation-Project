import { useQuery } from "@tanstack/react-query";
import bookingApi from "../api/Booking.api";

export const useBookingDetailQuery = (id: number) => {
    return useQuery({
        queryKey: ["get-booking-detail"],
        queryFn: () => bookingApi.getDetailBooking(id),
        staleTime: Infinity,
        gcTime: Infinity,
        retry: false,
        refetchOnWindowFocus: false
    });
};