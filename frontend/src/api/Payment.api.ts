import { BookingPayload, TransactionsResponse } from "../types/TransactionTypes"
import api from "./axiosConfig"

const paymentHotelApi = {
    transactions: (data: BookingPayload): Promise<TransactionsResponse> => {
        return api.post('/transactions/create-booking', data);
    }
}

export default paymentHotelApi;