import api from "./axiosConfig";
import { DetailBookingResponse, HistoryBookingResponse } from '../types/HistoryBookingTypes';

const bookingApi = {
    getBookingHistory: (): Promise<HistoryBookingResponse> => {
        return api.get('/bookings/history')
    }, 

    getDetailBooking: (id: number): Promise<DetailBookingResponse> => {
        return api.get('/bookings/detail', {
            params: { id}
        })
    }
}

export default bookingApi;