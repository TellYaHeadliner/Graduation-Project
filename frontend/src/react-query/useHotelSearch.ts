import { useMutation } from "@tanstack/react-query";
import searchApi from "../api/Search.api";
import { PayloadSearchParams, SearchResponse } from "../types/SearchTypes";

export const useHotelSearch = () => {
    return useMutation<SearchResponse, Error, PayloadSearchParams>({
        mutationFn: async (payload) => {
            const response  = await searchApi.search(payload);
            return response;
        }
    })
}