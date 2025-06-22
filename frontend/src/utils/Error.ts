import { isAxiosError } from "axios";
import { toast } from "react-toastify"

export class ErrorUtils{
    handleError = (error: any) => {
        console.error(error);
        if (isAxiosError(error) && error.status === 401){
            toast.error("Vui lòng đăng nhập");
            return;
        }

        if (isAxiosError(error) && error.status === 400){
            toast.error(error.message);
            return;
        }

        const message = error.message;
        if (message) {
            toast.error(message);
            return;
        }
    }
}