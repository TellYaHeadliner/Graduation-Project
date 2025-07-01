import { z } from "zod"

export const paymentSchemas = z.object({
    check_in: z.string(),
    check_out: z.string(),
    note: z.string().nullable(),
    code: z.string().nullable()
})

export type PaymentSchema = z.infer<typeof paymentSchemas>;