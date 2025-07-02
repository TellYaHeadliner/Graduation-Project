import { useQuery } from "@tanstack/react-query";
import searchApi from "../api/Search.api";
import { PayloadSearchParams, SearchResponse } from "../types/SearchTypes";

export const useHotelSearch = (payload: PayloadSearchParams, enabled = false) => {
    const queryKey = ['search-result', payload];

    return useQuery<SearchResponse>({
        queryKey,
        queryFn: () => searchApi.search(payload),
        enabled
    })
};