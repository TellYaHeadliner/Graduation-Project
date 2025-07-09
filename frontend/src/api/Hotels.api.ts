import api from "./axiosConfig"
import { HotelResponse } from '../types/ListHotelsTypes';
import { DetailHotelResponse } from "../types/DetailHotelTypes";
import { RoomTypeResponse } from "../types/RoomTypes";
import { RegisterHotelResponse } from "../types/RegisterHotelTypes";

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

    getRoomTypes: (hotel_id: number, check_in: string, check_out: string, guest: number, children: number, room_quantity: number): Promise<RoomTypeResponse> => {
        return api.get('/room-types', {
            params: {
                hotel_id, check_in, check_out, guest, children, room_quantity
            }
        })
    },

    registerHotel: (data: any): Promise<RegisterHotelResponse> => {
        return api.post('/hotels/register-hotel', data)
    }
    
}

export default hotelApi