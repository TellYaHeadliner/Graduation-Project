import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { ReviewFormData, reviewSchemas } from '../../schemas/reviewSchemas';
import { useUserInfoQuery } from "../../react-query/useUserInfoQuery";

interface ReviewFormProps{
    hotel_id: number;
}

export const ReviewForm = ({ hotel_id }: ReviewFormProps) => {
    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm<ReviewFormData>({
        resolver: zodResolver(reviewSchemas),
    });

    const getUserInfo = useUserInfoQuery();

    const onSubmit = (data: any) => {
        const payloadData = {
            hotel_id: hotel_id,
            user_id: getUserInfo.data?.data.user.id,
            star: data.star,
            content: data.content
        }
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)} className="max-w-8xl bg-white  rounded-lg space-y-4 my-4">
            <div>
                <label htmlFor="star" className="block text-sm font-medium text-gray-700 mb-1">
                    Đánh giá sao
                </label>
                <select
                    {...register("star", { valueAsNumber: true })}
                    className="w-full border border-gray-300 rounded-lg px-3 py-2"
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
        </form>
    )
}