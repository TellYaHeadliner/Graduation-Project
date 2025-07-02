import { useQueryClient, useMutation } from "@tanstack/react-query";
import favoriteApi from "../api/Favorite.api";
import { toast } from "react-toastify";
import { ErrorUtils } from '../utils/Error';

export const useFavorite = () => {
    const queryClient = useQueryClient();

    return useMutation({
        mutationFn: (id: number) => favoriteApi.toggleFavorite(id),

        onMutate: () => {
            const toastId = toast.loading("Đang xử lý...", {
                autoClose: 2000
            })
            return { toastId };
        },

        onSuccess: (data, hotel_id, context) => {
            const isRemove = data.message === "Đã xóa khỏi danh sách yêu thích";
            const isAdd = data.message === "Đã thêm vào danh sách yêu thích";
        
            queryClient.setQueryData(["shortCheckFavorites"], (oldData: any) => {
                if (!oldData) return oldData;
        
                const newData = oldData.data.map((item: any) =>
                  item.id === hotel_id
                    ? { ...item, is_favorite: !item.is_favorite } 
                    : item
                );
        
                return {
                  ...oldData,
                  data: newData,
                };
              });
              
            toast.update(context.toastId, {
              render: data.message,
              type: isRemove ? "error" : isAdd ? "success" : "info",
              isLoading: false,
              autoClose: 2000,
            });
        },

        onError: (error: any) => {
            const errorUtils = new ErrorUtils();
            errorUtils.handleError(error)
        }
    })
};