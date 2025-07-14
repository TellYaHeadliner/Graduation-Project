import { z } from "zod"

export const registerOwnerSchema = z.object({
    name: z.string().min(1, "Vui lòng nhập tên khách sạn").max(255, "Số lượng kí tự vượt quá giới hạn"),
    address: z.string().min(1, "Vui lòng nhập địa chỉ"),
    star_rating: z.string().nonempty("Vui lòng lựa chọn số sao khách sạn"),
    mst: z.string().min(1, "Vui lòng nhập mã số thuế").max(13, "Mã số thuế không vượt quá 13 kí tự"),
    phone: z.string().max(10, "Số điện thoại không vượt quá 10 số").min(1, "Số điện thoại phải nhập 10 số"),
    bank_name: z.string().min(1, "Vui lòng nhập tên ngân hàng"),
    bank_account_name: z.string().min(1, "Vui lòng nhập tên tài khoản"),
    bank_account_number: z.string().min(1, " Vui lòng nhập số tài khoản"),
    avatar: z
        .instanceof(File, { message: "Vui lòng chọn ảnh đại diện hợp lệ từ máy tính" }),
});

export type registerOwnerSchema = z.infer<typeof registerOwnerSchema>;