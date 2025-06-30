import { useQuery } from "@tanstack/react-query";
import favoriteApi from "../api/Favorite.api";

export const useShortCheckFavorites = () => {
    return useQuery({
        queryKey: ["shortCheckFavorites"],
        queryFn: favoriteApi.shortCheckFavorites,
        staleTime: 1000 * 60 * 5,
        refetchOnWindowFocus: false
    })
}