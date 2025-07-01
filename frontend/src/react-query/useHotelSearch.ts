import { useMutation, useQueryClient } from "@tanstack/react-query";
import searchApi from "../api/Search.api";
import { PayloadSearchParams } from "../types/SearchTypes";

export const useHotelSearch = () => {
    const queryClient = useQueryClient();

    return useMutation({
        mutationFn: (payload: PayloadSearchParams) => searchApi.search(payload),
        onSuccess: (data, variables) => {
            queryClient.setQueryData(['search-result', variables], data);
        },
    });
};