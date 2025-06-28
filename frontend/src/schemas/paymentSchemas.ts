import { z } from "zod"

export const paymentSchemas = z.object({
    hotel_id: z.number(),
    check_in: z.string(),
    check_out: z.string(),
    note: z.string().nullable(),
})

export type PaymentSchema = z.infer<typeof paymentSchemas>;