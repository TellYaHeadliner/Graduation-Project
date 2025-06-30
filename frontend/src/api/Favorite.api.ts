import { MessageResponse, SCFResponse } from "../types/FavoritesTypes";
import api from "./axiosConfig"



const favoriteApi = {
    toggleFavorite: (hotel_id: number): Promise<MessageResponse> => {
        return api.post('/hotels/favorites', null,{
            params: {hotel_id}
        })
    }, 

    shortCheckFavorites: (): Promise<SCFResponse> => {
        return api.get('/hotels/list-favorites')
    }
}



export default favoriteApi;