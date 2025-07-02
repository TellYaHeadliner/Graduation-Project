import { ReviewPayload, ReviewResponse } from "../types/ReviewTypes"
import api from "./axiosConfig"

const reviewApi = {
    review: (data: ReviewPayload): Promise<ReviewResponse> => {
        return api.post('/reviews', data)
    },
    checkReview: (hotel_id: number): Promise<ReviewResponse> => {
        return api.get('/reviews/check', {
            params: { hotel_id }
        })
    }
}

export default reviewApi;