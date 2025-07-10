import { useMutation } from "@tanstack/react-query";
import { toast } from "react-toastify"
import paymentHotelApi from "../api/Payment.api";
import { useNavigate } from "react-router-dom";
import { ErrorUtils } from "../utils/Error";

export const useCancelBooking = () => {
    const navigate = useNavigate();

    return useMutation({
        mutationFn: (bookingId: number) => paymentHotelApi.cancelBooking(bookingId),
        
        onMutate: () => {
            const toastId = toast.loading("Đang xử lý...", {
                autoClose: 2000
            })
            return { toastId };
        },
        
        onSuccess: () => {
            toast.success("Hủy phòng thành công, trang web sẽ chuyển hướng sang trang chủ");
            setTimeout(() => {
                navigate("/")
            }, 5000);
        },
        onError: (error) => {
            const errorUtils = new ErrorUtils();
            errorUtils.handleError(error);
        }
    })
}