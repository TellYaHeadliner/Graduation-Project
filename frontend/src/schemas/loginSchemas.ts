import { z } from "zod"

export const loginSchema = z.object({
    email: z.string().email("Email không hợp lệ").min(1, "Vui lòng nhập email"),
    password: z.string().min(1, "Vui lòng nhập mật khẩu")
});

export type LoginSchema = z.infer<typeof loginSchema>;