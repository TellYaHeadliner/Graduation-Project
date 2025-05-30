import { useState } from "react";
import { toast } from "react-toastify"

interface UseAuthCheckInterface {
    isDialogOpen: boolean;
    openDialog: () => void;
    closeDialog: () => void;
    checkAuth: () => void;
}

export function useAuthCheck(): UseAuthCheckInterface {
    const [isDialogOpen, setIsDialogOpen] = useState(false);

    const openDialog = () => setIsDialogOpen(true);
    const closeDialog = () => setIsDialogOpen(false);

    const checkAuth = () => {
        const token = sessionStorage.getItem("token");

        if (!token){
            openDialog();
        }
        else {
            toast.success("Khách sạn của bạn đã được lưu vào danh sách yêu thích")
        }
    };

    return {
    openDialog,
    closeDialog,
    checkAuth,
    isDialogOpen,
}

}