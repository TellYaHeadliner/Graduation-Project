import { useQuery } from "@tanstack/react-query";
import favoriteApi from "../api/Favorite.api";

export const useFavoriteQuery = () => {
    return useQuery({
        queryKey: ["get-list-favorite"],
        queryFn: () => favoriteApi.favoriteLists(),
        staleTime: Infinity,
        gcTime: Infinity,
        retry: false,
        refetchOnWindowFocus: false
    });
};