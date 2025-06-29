import { z } from "zod"

export const forgotPasswordSchema = z.object({
    email: z.string().email("Email không hợp lệ").min(1, "Vui lòng nhập email"),
})

export type ForgotPasswordSchema = z.infer<typeof forgotPasswordSchema>;