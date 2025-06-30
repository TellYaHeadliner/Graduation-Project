import { useState } from "react";
import { toast } from "react-toastify"
import { useFavorite } from "../react-query/useFavorite";

interface UseAuthCheckInterface {
    isDialogOpen: boolean;
    openDialog: () => void;
    closeDialog: () => void;
    checkAuth: () => void;
    id: number
}

export function useAuthCheck(id : number): UseAuthCheckInterface {
    const [isDialogOpen, setIsDialogOpen] = useState(false);

    const openDialog = () => setIsDialogOpen(true);
    const closeDialog = () => setIsDialogOpen(false);
    const favorite = useFavorite();


    const checkAuth = () => {
        favorite.mutate(id)
        if (favorite.isError) {
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
        id
    }

}