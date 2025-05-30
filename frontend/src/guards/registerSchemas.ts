import { z } from "zod"

export const registerSchema = z.object({
    fullname: z.string().min(1, "Vui lòng nhập đầy đủ họ và tên"),
    email: z.string().email("Email không hợp lệ").min(1, "Vui lòng nhập email"),
    password: z
    .string()
    .min(1, "Vui lòng nhập mật khẩu")
    .regex(/[A-Z]/, "Mật khẩu phải có ít nhất 1 chữ cái viết hoa")
    .regex(/[0-9]/, "Mật khẩu phải có ít nhất 1 chữ số")
    .regex(/[^A-Za-z0-9]/, "Mật khẩu phải có ít nhất 1 ký tự đặc biệt")
    ,
    confirmPassword: z.string().min(1, "Vui lòng nhập mật khẩu xác nhận"),
    phone: z.string().max(10, "Số điện thoại không vượt quá 10 số").min(1, "Số điện thoại phải nhập 10 số"),
    gender: z.boolean({
        required_error: "Giới tính không được để trống"
    }),
    address: z.string().nullable(),
    birthDay: z.date().nullable(),
})
.refine((data) => data.password === data.confirmPassword, {
    message: "Mật khẩu xác nhận phải khớp",
    path: ["confirmPassword"]
});

export type RegisterSchema = z.infer<typeof registerSchema>;