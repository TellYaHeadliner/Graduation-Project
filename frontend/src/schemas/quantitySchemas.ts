import { z } from "zod";

export const quantitySchemas = z.object({
    quantity: z
        .number({ invalid_type_error: "Vui lòng nhập số"})
        .min(1, "Số lượng phải lớn hơn hoặc bằng 1")
})

export type quantitySchemas = z.infer<typeof quantitySchemas>;