import React from "react";
import { Currency } from "../../utils/Currency";
import { TableRoomType } from "../../utils/TableRoomStaticData";
import DialogDetailHotel from "../Dialog/DialogDetailHotel";
import { Button, Select } from "@radix-ui/themes";
import DialogHotelServices from "../Dialog/DialogHotelServices";

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
                        <th className="text-left px-4 py-2 border-r border-black">
                            
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
                                <div className="font-medium cursor pointer">
                                    {room.soLuong} người
                                </div>
                            </td>
                            <td className="px-4 py-3 border-r">
                                <div className="font-medium cursor pointer">
                                    {Currency.formatVND(room.giaPhong)}
                                </div>
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
                                <ul className="list-disc list-inside">
                                    {room?.ghiChu.map((note, index) => (
                                        <React.Fragment key={index}>
                                           {note.note1 && <li>{note.note1}</li>}
                                           {note.note2 && <li>{note.note2}</li>}
                                           {note.note3 && <li>{note.note3}</li>}
                                        </React.Fragment>
                                    ))}
                                </ul>
                            </td>

                            <td className="px-4 py-3 text-left border-r">
                                <DialogHotelServices />
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    )
}