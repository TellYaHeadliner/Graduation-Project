import { useQuery } from "@tanstack/react-query";
import hotelApi from "../api/Hotels.api";

export const useHotelRoomTypesQuery = (
    id: number,
    checkIn: string | null,
    checkOut: string | null,
    guest: number,
    children: number,
    roomQuantity: number,
    enabled: boolean // thêm tham số enabled
  ) => {
    return useQuery({
      queryKey: ["get-room-type", id, checkIn, checkOut, guest, children, roomQuantity],
      queryFn: () => hotelApi.getRoomTypes(id, checkIn, checkOut, guest, children, roomQuantity),
      staleTime: Infinity,
      gcTime: Infinity,
      retry: false,
      refetchOnWindowFocus: false,
      enabled: enabled, 
    });
  };