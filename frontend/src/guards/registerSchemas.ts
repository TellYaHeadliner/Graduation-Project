import { z } from "zod";

export const registerSchema = z
  .object({
    fullname: z.string().min(1, "Vui lòng nhập đầy đủ họ và tên"),
    email: z.string().email("Email không hợp lệ").min(1, "Vui lòng nhập email"),
    password: z.string().min(1, "Vui lòng nhập mật khẩu"),
    confirmPassword: z.string().min(1, "Vui lòng nhập mật khẩu xác nhận"),
    phone: z
      .string()
      .max(10, "Số điện thoại không vượt quá 10 số")
      .min(10, "Số điện thoại phải nhập 10 số")
      .regex(/^\d+$/, "Số điện thoại chỉ bao gồm chữ số"),
    gender: z
      .string({
        required_error: "Giới tính không được để trống",
      }),
    address: z.string().min(1, "Vui lòng nhập địa chỉ"),
    birthday: z
      .string()
      .min(1, "Vui lòng chọn ngày sinh")
      .refine((date) => !isNaN(Date.parse(date)), {
        message: "Ngày sinh không hợp lệ",
      }),

    avatar: z
      .instanceof(File, { message: "Ảnh đại diện không hợp lệ"})
      .refine((file) => file.size <= 5 * 1024 * 1024, {
        message: "Ảnh không được vượt quá 5MB",
      })
      .refine((file) => ["image/jpeg", "image/png", "image/jpg"].includes(file.type), {
        message: "Chỉ chấp nhận ảnh định dạng JPG, JPEG hoặc PNG",
      }),
    })
  .refine((data) => data.password === data.confirmPassword, {
    message: "Mật khẩu xác nhận phải khớp",
    path: ["confirmPassword"],
  });

export type RegisterSchema = z.infer<typeof registerSchema>;
