import { useMutation } from "@tanstack/react-query";
import hotelApi from "../api/Hotels.api"
import { RegisterHotelResponse } from "../types/RegisterHotelTypes";

export const useRegisterHotelMutation = () => {
    return useMutation<RegisterHotelResponse, Error, any>({
      mutationFn: (data) => hotelApi.registerHotel(data),
    });
};