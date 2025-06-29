import api from "./axiosConfig"

export interface MessageResponse{
    message: string;
}

const favoriteApi = {
    getBookingHistory: (hotel_id: number): Promise<MessageResponse> => {
        return api.post('/hotels/favorites', {
            params: {hotel_id}
        })
    }, 
}

export default favoriteApi;