import { z } from "zod"

export const registerSchema = z.object({
    fullname: z.string().min(1, "Vui lòng nhập đầy đủ họ và tên"),
    email: z.string().email("Email không hợp lệ").min(1, "Vui lòng nhập email"),
    password: z
    .string()
    .min(1, "Vui lòng nhập mật khẩu")
    ,
    confirmPassword: z.string().min(1, "Vui lòng nhập mật khẩu xác nhận"),
    phone: z.string().max(10, "Số điện thoại không vượt quá 10 số").min(1, "Số điện thoại phải nhập 10 số"),
    gender: z.boolean({
        required_error: "Giới tính không được để trống"
    }),
})
.refine((data) => data.password === data.confirmPassword, {
    message: "Mật khẩu xác nhận phải khớp",
    path: ["confirmPassword"]
});

export type RegisterSchema = z.infer<typeof registerSchema>;