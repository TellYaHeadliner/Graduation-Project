import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { ReviewFormData, reviewSchemas } from '../../schemas/reviewSchemas';
import { useUserInfoQuery } from "../../react-query/useUserInfoQuery";
import { useCheckReviewQuery, useReviewMutation } from "../../react-query/useReview";
import { toast } from "react-toastify";
import { ErrorUtils } from "../../utils/Error";
import LoadingSpinner from "../Loading/LoadingSpinner";

interface ReviewFormProps{
    hotel_id: number;
}

export const ReviewForm = ({ hotel_id }: ReviewFormProps) => {
    const {
        register,
        handleSubmit,
        formState: { errors },
        reset
    } = useForm<ReviewFormData>({
        resolver: zodResolver(reviewSchemas),
    });

    const getUserInfo = useUserInfoQuery();
    const reviewMutation = useReviewMutation(Number(hotel_id));

    const onSubmit = (data: any) => {
        const payloadData = {
            hotel_id: Number(hotel_id),
            user_id: Number(getUserInfo.data?.data.user.id),
            star: data.star,
            content: data.content
        }

        reviewMutation.mutate(payloadData, {
            onSuccess: () => {
                toast.success("Gửi đánh giá thành công");
                reset();
            },
            onError: (error) => {
                const errorUtils = new ErrorUtils();
                errorUtils.handleError(error)
            }
        })
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)} className="max-w-8xl bg-white  rounded-lg space-y-4 my-4">
            {
                reviewMutation.isPending ? (
                    <LoadingSpinner />
                ) : (
                    <>
                            <div>
                                <label htmlFor="star" className="block text-sm font-medium text-gray-700 mb-1">
                                    Đánh giá sao
                                </label>
                                <select
                                    {...register("star", { valueAsNumber: true })}
                                    className="w-full border border-gray-300 rounded-lg px-3 py-2"
                                    disabled={reviewMutation.isPending}
                                >
                                    <option value="">Chọn số sao</option>
                                    {[1, 2, 3, 4, 5].map((num) => (
                                        <option key={num} value={num}>
                                            {num} sao
                                        </option>
                                    ))}
                                </select>
                                {errors.star && <p className="text-red-600 text-sm">{errors.star.message}</p>}
                            </div>
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-1">
                                    Nội dung đánh giá
                                </label>
                                <textarea
                                    rows={4}
                                    {...register("content")}
                                    className="w-full border border-gray-300 rounded-lg px-3 py-2"
                                    placeholder="Viết cảm nhận của bạn..."
                                    disabled={reviewMutation.isPending}
                                />
                                {errors.content && <p className="text-red-600 text-sm">{errors.content.message}</p>}
                            </div>
                            <div className="text-right">
                                <button
                                    type="submit"
                                    className="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg"
                                >
                                    Gửi đánh giá
                                </button>
                            </div>
                    </>
                )
            }
        </form>
    )
}