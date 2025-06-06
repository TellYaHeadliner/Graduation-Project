import { TableRoomType } from "../../utils/TableRoomStaticData";

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
                        <th className="px-4 py-2 border-r border-black">
        
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {data.map((room, index) => (
                        <tr key={index} className="border-t border-gray-300">
                            <td className="px-4 py-3 border-r">
                                <div className="font-medium text-blue-700 hover:underline cursor-pointer">
                                    {room.tenPhong}
                                </div>
                                <div className="text-sm text-gray-600">
                                    {room.loaiGiuong}
                                </div>
                            </td>
                            <td className="px-4 py-3 border-r">
                                <div className="font-medium cursor pointer">
                                    {room.soLuong} người
                                </div>
                            </td>
                            <td className="px-4 py-3 text-left border-r">
                                <button className="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                                    Xem giá
                                </button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    )
}