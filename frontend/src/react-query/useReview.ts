import { useMutation, useQuery, useQueryClient } from '@tanstack/react-query'
import reviewApi from '../api/Review.api'
import { ReviewPayload, ReviewResponse } from '../types/ReviewTypes'

// Gửi đánh giá
export const useReviewMutation = (hotel_id: number) => {
  const queryClient = useQueryClient();

  return useMutation<ReviewResponse, Error, ReviewPayload>({
    mutationFn: (data) => reviewApi.review(data),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['check-review', hotel_id]})
    }
  })
}

export const useCheckReviewQuery = (hotel_id: number, enabled = true) => {
  return useQuery<ReviewResponse, Error>({
    queryKey: ['check-review', hotel_id],
    queryFn: () => reviewApi.checkReview(hotel_id),
    enabled: enabled && !!hotel_id, 
  })
}