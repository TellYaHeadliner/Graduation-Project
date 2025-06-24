import api from "./axiosConfig"
import { DetailHotelResponse, HotelResponse } from '../types/HotelsTypes';

const hotelApi = {
    getHotelSeasons: (): Promise<HotelResponse> => {
        return api.get('/hotels/hotel-seasons/')
    },

    getHotelSeasonsParam: (name: string): Promise<HotelResponse> => {
        return api.get('/hotels/hotel-seasons/', {
            params: name
        })
    },

    getHotelDetail: (id: number): Promise<DetailHotelResponse> => {
        return api.get('/hotels/detail-hotel', {
            params: { id }
        })
    },

    getRoomTypes: (hotel_id: number, check_in: string, check_out: string, guest: number, children: number, room_quantity: number): Promise<HotelResponse> => {
        return api.get('/room-types', {
            params: {
                hotel_id, check_in, check_out, guest, children, room_quantity
            }
        })
    }
}

export default hotelApi