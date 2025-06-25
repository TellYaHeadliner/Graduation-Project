import { Currency } from "../../utils/Currency";
import DialogDetailHotel from "../Dialog/DialogDetailHotel";
import { FaUser } from "react-icons/fa6";
import { RoomType } from "../../types/HotelsTypes";
import { useForm } from "react-hook-form";
import { quantitySchemas } from "../../schemas/quantitySchemas";
import { zodResolver } from "@hookform/resolvers/zod";

interface RoomTableProps {
    datas: RoomType[];
}

export default function TableRoom({ datas }: RoomTableProps) {
    const showPrice = (basePrice: number, priceDiscount: number): number => {
        return basePrice - priceDiscount;
    }

    const timeToFreeCancel = () => {
        const getTime = localStorage.getItem('findRoom')
        const data = JSON.parse(getTime ?? "");
        const checkInDate = new Date(data.dateRange?.[0]);
        const hour = checkInDate.getHours();
        const minutes = checkInDate.getMinutes();
        const cancelDeadline = new Date(checkInDate.getTime() - 24 * 60 * 60 * 1000)
        return `${cancelDeadline.toLocaleDateString('vi-VN', { timeZone: 'Asia/Ho_Chi_Minh' })} + ${hour}:${minutes}`
    }

    const {
        register,
        handleSubmit,
        formState: { errors },
        setValue,
    } = useForm<quantitySchemas>({
        resolver: zodResolver(quantitySchemas),
        defaultValues: {
            quantity: 1,
        },
    });

    return (
        <div className="overflow-x-auto">
            <table typeof="1" className="min-w-full table-auto border border-gray-300">
                <thead>
                    <tr className="bg-blue-700 text-white">
                        <th className="text-left px-4 py-2 border-r border-gray-500">Loại phòng </th>
                        <th className="text-left px-4 py-2 border-r border-gray-500">Số lượng người</th>
                        <th className="text-left px-4 py-2 border-r border-gray-500">
                            Giá phòng
                        </th>
                        <th className="text-left px-4 py-2 border-r border-gray-500">
                            Lựa chọn số lượng
                        </th>
                        <th className="text-left px-4 py-2 border-r border-gray-500">
                            Các lựa chọn
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {datas.length === 0 ? (
                        <tr>
                            <td colSpan={5} className="text-center py-4 text-gray-500">
                                Không có dữ liệu
                            </td>
                        </tr>
                    ) : (
                        datas?.map((data) => (
                            <tr className="border-t border-gray-300" key={data.id}>
                                <td className="px-4 py-3 border-r border-gray-500">
                                    <div className="font-medium text-blue-700 hover:underline cursor-pointer ">
                                        <DialogDetailHotel title={data.name} />
                                    </div>
                                    <div className="text-sm text-gray-600">
                                        Loại phòng: {data.room_code}
                                    </div>
                                    <div className="text-xs font-thin">
                                        Diện tích: {data.area} m <sup>2</sup>
                                    </div>
                                    <div className="text-sm font-normal">
                                        {data.description === null ? "" : data.description}
                                    </div>
                                </td>
                                <td className="px-4 py-3 border-r border-gray-500">
                                    <div className="flex">
                                        {Array.from({ length: data.bed_quantity }).map((_, index) => (
                                            <FaUser key={index} className="w-7 h-7 font-bold" />
                                        ))}
                                    </div>
                                </td>
                                <td className="px-4 py-3 border-r border-gray-500 text-end">
                                    {
                                        data.variants.length > 0 && (
                                            <div>
                                                <p className="font-medium text-xs cursor pointer line-through">
                                                    {Currency.formatVND(data.variants[0]?.base_price)}
                                                </p>
                                                <p className="font-bold text-lg text-red-500 cursor pointer">
                                                    {Currency.formatVND(showPrice(data.variants[0].base_price, data.variants[0].seasons[0].pivot.discount_value))}
                                                </p>
                                            </div>
                                        )
                                    }
                                </td>

                                <td className="px-4 py-3 border-r border-gray-500 text-end">
                                    {data.variants[0]?.available_room_count > 0 && (
                                        <input type="number"
                                            {...register("quantity", { valueAsNumber: true })}
                                            className="w-10 px-2 py-1 border border-gray-300 rounded text-sm"
                                            min={1}
                                            max={data.variants[0].available_room_count}
                                        />
                                    )}
                                    {
                                        data.variants.length === 0 && (
                                            <p className="text-red-500 text-lg">
                                                Hết phòng
                                            </p>
                                        )
                                    }
                                </td>
                                <td className="px-4 py-3 border-r border-gray-500 text end">
                                    {data.variants[0]?.attributes[0]?.pivot && (
                                        <ul className="list-disc list-inside">
                                            <li>
                                                {data.variants[0]?.attributes[0]?.pivot.attribute_value && (
                                                    <>Người lớn: {data.variants[0].attributes[0].pivot.attribute_value} người</>
                                                )}
                                            </li>
                                            <li>
                                                {data.variants[0]?.attributes[1]?.pivot.attribute_value && (
                                                    <>Trẻ em: {data.variants[0].attributes[0].pivot.attribute_value} người</>
                                                )}
                                            </li>
                                            <li>
                                                {data.variants[0]?.attributes[2]?.pivot.attribute_value && (
                                                    <>{data.variants[0]?.attributes[2]?.pivot.attribute_value == 1 ? "Có bứa ăn sáng" : "Không có bữa ăn sáng"}</>
                                                )}
                                            </li>
                                            <li>
                                                {data.variants[0]?.attributes[3]?.pivot.attribute_value && (
                                                    <>{data.variants[0]?.attributes[3]?.pivot.attribute_value == 1 ? "Không được hút thuốc" : "Được hút thuốc"}</>
                                                )}
                                            </li>
                                            <li>
                                                {data.variants[0]?.attributes[4].type === "free_before and fee_after" && (
                                                    <>
                                                    <span>
                                                        {data.variants[0]?.attributes[4]?.name}
                                                    </span>
                                                    <div className="text-xs font-thin">
                                                        Ghi chú: Trước {timeToFreeCancel()}
                                                    </div>
                                                    </>
                                                )}
                                            </li>
                                        </ul>
                                    )}
                                </td>
                            </tr>
                        ))
                    )}
                </tbody>
            </table>
        </div>
    )
}
