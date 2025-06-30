import { useMutation } from "@tanstack/react-query";
import favoriteApi from "../api/Favorite.api";
import { toast } from "react-toastify";
import { ErrorUtils } from '../utils/Error';

export const useFavorite = () => {
    return useMutation({
        mutationFn: (id: number) => favoriteApi.getBookingHistory(id),

        onSuccess: (data) => {
            toast.success(data.message);
        },

        onError: (error: any) => {
            const errorUtils = new ErrorUtils();
            errorUtils.handleError(error)
        }
    })
};