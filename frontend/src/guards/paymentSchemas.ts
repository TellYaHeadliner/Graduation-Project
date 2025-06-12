import { z } from "zod"

export const paymentSchemas = z.object({
    fullname: z.string().nonempty(),
    email: z.string().nonempty(),
    phone: z.string().nonempty(),
    address: z.string().min(1, "Vui lòng nhập địa chỉ"),
    request: z.string().nullable(),
    checkIn: z.string().nonempty("Vui lòng chọn thời gian check-in")
})

export type PaymentSchema = z.infer<typeof paymentSchemas>;