/* eslint-disable @typescript-eslint/no-inferrable-types */
import { useQuery } from "@tanstack/react-query";
import searchApi from "../api/Search.api";
import { PayloadSearchParams, SearchResponse } from "../types/SearchTypes";

export const useHotelSearch = (payload: PayloadSearchParams, enabled: boolean = true) => {
    return useQuery<SearchResponse>({
        queryKey: ['search-result', payload],
        queryFn: () => searchApi.search(payload),
        enabled: enabled && !!payload.address, 
      });
};