import { z } from "zod"

export const registerOwnerSchema = z.object({
    email: z.string().min(1, "Vui lòng nhập địa chỉ email").max(255, "Số lượng kí tự vượt quá giới hạn").regex(/^\d+$/, "Số điện thoại chỉ được chứa số"),
    password: z.string().min(1, "Vui lòng nhập mật khẩu"),
    name: z.string().min(1, "Vui lòng nhập tên khách sạn").max(255, "Số lượng kí tự vượt quá giới hạn"),
    adresss: z.string().min(1, "Vui lòng nhập địa chỉ"),
    star_rating: z.string().nonempty("Vui lòng lựa chọn số sao khách sạn"),
    mst: z.string().min(1, "Vui lòng nhập mã số thuế").max(20, "Mã số thuế không vượt quá 20 kí tự"),
    phone: z.string().max(10, "Số điện thoại không vượt quá 10 số").min(1, "Số điện thoại phải nhập 10 số"),
    bank_name: z.string().min(1, "Vui lòng nhập tên ngân hàng"),
    bank_account_name: z.string().min(1, "Vui lòng nhập tên tài khoản"),
    bank_account_number: z.string().min(1, " Vui lòng nhập số tài khoản"),
    avatar: z
        .instanceof(File, { message: "Vui lòng chọn ảnh đại diện hợp lệ từ máy tính" }),

    gallery: z
        .array(z.instanceof(File, { message: "Tất cả ảnh trong thư viện phải hợp lệ" }))
        .min(1, "Thư viện ảnh phải có ít nhất 1 hình ảnh"),
});

export type registerOwnerSchema = z.infer<typeof registerOwnerSchema>;