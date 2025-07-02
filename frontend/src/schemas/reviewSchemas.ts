import { z } from "zod"

export const reviewSchemas = z.object({
    star: z.number().min(1, "Chọn ít nhất 1 sao").max(5, "Tối đa 5 sao"),
    content: z.string().min(10, "Nội dung phải có ít nhất 10 kí tự")
})

export type ReviewFormData = z.infer<typeof reviewSchemas>;