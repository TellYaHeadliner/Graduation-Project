import { BookingPayload, CancelBookingResponse, TransactionsResponse } from "../types/TransactionTypes"
import api from "./axiosConfig"

const paymentHotelApi = {
    transactions: (data: BookingPayload): Promise<TransactionsResponse> => {
        return api.post('/transactions/create-booking', data);
    },

    cancelBooking: (booking_id: number): Promise<CancelBookingResponse> => {
        const formData = new FormData();
        formData.append("booking_id", booking_id.toString())
        return api.post('/transactions/cancel-booking', formData);
    }
}

export default paymentHotelApi;