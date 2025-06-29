import { useMutation } from "@tanstack/react-query";
import paymentHotelApi from "../api/Payment.api";
import { BookingPayload, TransactionsResponse } from "../types/TransactionTypes";

export const usePaymentMutation = () => {
    return useMutation<TransactionsResponse, Error, BookingPayload>({
        mutationFn: (data: BookingPayload) => paymentHotelApi.transactions(data),
    });
}