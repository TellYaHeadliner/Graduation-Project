import { z } from "zod"

export const findHotelSchemas = z.object({
    province: z.string().nonempty("Vui lòng chọn tỉnh"),
    dateRange: z.string().nonempty("Vui lòng chọn ngày đặt/ trả phòng"),
    adults: z.number().min(1, "Phải có ít nhất 1 người lớn"),
    children: z.number().min(0, "Số lượng trẻ em không được âm"),
    rooms: z.number().min(1, "Phải có ít nhất 1 phòng"),
})

export type findHotelSchemas = z.infer<typeof findHotelSchemas>;