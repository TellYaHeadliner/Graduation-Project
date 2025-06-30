import { useState } from "react";
import { useFavorite } from "../react-query/useFavorite";

interface UseAuthCheckInterface {
    isDialogOpen: boolean;
    openDialog: () => void;
    closeDialog: () => void;
    checkAuth: () => void;
    id: number
}

export function useAuthCheck(id : number): UseAuthCheckInterface & { isPending: boolean} {
    const [isDialogOpen, setIsDialogOpen] = useState(false);

    const openDialog = () => setIsDialogOpen(true);
    const closeDialog = () => setIsDialogOpen(false);
    const favorite = useFavorite();


    const checkAuth = () => {
        if (!id){
            console.warn("Không có id, không thể gọi mutate");
            return;
        }
        
        favorite.mutate(id)
        if (favorite.isError) {
            openDialog();
        }
    };

    return {
        openDialog,
        closeDialog,
        checkAuth,
        isDialogOpen,
        id,
        isPending: favorite.isPending,
    }

}