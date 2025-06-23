import React from "react";
import { Currency } from "../../utils/Currency";
import { TableRoomType } from "../../utils/TableRoomStaticData";
import DialogDetailHotel from "../Dialog/DialogDetailHotel";
import { Select } from "@radix-ui/themes";
import { FaUser } from "react-icons/fa6";

interface RoomTableProps{
    data: TableRoomType[];
}

export default function TableRoom({data}: RoomTableProps){
    return (
        <div className="overflow-x-auto">
            <table typeof="1" className="min-w-full table-auto border border-gray-300">
                <thead> 
                    <tr className="bg-blue-700 text-white">
                        <th className="text-left px-4 py-2 border-r border-black">Loại phòng </th>
                        <th className="text-left px-4 py-2 border-r border-black">Số lượng người</th>
                        <th className="text-left px-4 py-2 border-r border-black">
                            Giá phòng
                        </th>
                        <th className="text-left px-4 py-2 border-r border-black">
                            Lựa chọn số lượng
                        </th>
                        <th className="text-left px-4 py-2 border-r border-black">
                            Ghi chú
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {data.map((room, index) => (
                        <tr key={index} className="border-t border-gray-300">
                            <td className="px-4 py-3 border-r">
                                <div className="font-medium text-blue-700 hover:underline cursor-pointer">
                                    <DialogDetailHotel title={room.tenPhong} />
                                </div>
                                <div className="text-sm text-gray-600">
                                    {room.loaiPhong}
                                </div>
                            </td>
                            <td className="px-4 py-3 border-r">
                                <div className="flex space-x-1 font-medium cursor pointer">
                                    {Array.from({ length: room.soLuong }).map((_, index) => (
                                        <div key={index}>
                                            <FaUser />
                                        </div>
                                    ))}
                                </div>
                            </td>
                            <td className="px-4 py-5 border-r text-end">
                                <div className="font-thin line-through text-xs cursor pointer">
                                    {Currency.formatVND(room.giaPhong)}
                                </div>
                                {
                                    room.giaGiam && 
                                    (
                                        <div className="font-medium text-red-300 ">
                                        {Currency.formatVND(room.giaGiam)}
                                        </div>
                                    )
                                }

                            </td>
                            <td className="px-4 py-3 border-r">
                                <Select.Root defaultValue="0">
                                    <Select.Trigger />
                                    <Select.Content>
                                        <Select.Item value="0">0</Select.Item>
                                        <Select.Item value="1">1</Select.Item>
                                    </Select.Content>
                                </Select.Root>
                            </td>
                            <td className="px-4 py-3 border-r">
                                <ul className="list-disc list-inside text-md">
                                    {room?.ghiChu.map((note, index) => (
                                        <React.Fragment key={index}>
                                            <li>
                                                {`Người lớn: ${note.adults} người`} 
                                            </li>
                                            <li>
                                                {`Trẻ em: ${note.children} người`}
                                            </li>
                                            <li>
                                                {`Bao gồm bữa sáng: ${note.isHaveBreakfast ? "Có" : "Không"}`}
                                            </li>
                                            <li>
                                                {`Không hút thuốc: ${note.isSmoking ? "Có" : "Không"}`}
                                            </li>
                                            <li>
                                                
                                            </li>
                                        </React.Fragment>
                                    ))}
                                </ul>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    )
}