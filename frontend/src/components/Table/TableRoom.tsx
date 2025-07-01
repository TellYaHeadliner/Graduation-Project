/* eslint-disable react-hooks/exhaustive-deps */
import { Currency } from "../../utils/Currency";
import DialogDetailHotel from "../Dialog/DialogDetailHotel";
import { FaChild, FaUser } from "react-icons/fa6";
import { RoomType } from "../../types/RoomTypes";
import { useEffect, useState } from "react";

interface TableRoomProps {
    datas: RoomType[];
    onChange: (bookingDetails: {
        room_type_id: number;
        room_type_variant_id: number;
        quantity: number;
        name: string;
    }[]) => void;
}

export default function TableRoom({ datas, onChange }: TableRoomProps) {
    const numberOfNights = JSON.parse(localStorage.getItem('numberOfNights') || '0');
    const [quantities, setQuantities] = useState<Record<string, number>>({});
    const handleQuantityChange = (roomTypeId: number, variantId: number, quantity: number) => {
        const key = `${roomTypeId}-${variantId}`;
        const updated = { ...quantities, [key]: quantity };
        setQuantities(updated);

        const details = Object.entries(updated).filter(([_, q]) => q > 0)
        .map(([key, quantity]) => {
            const [room_type_id, room_type_variant_id] = key.split("-").map(Number);
            const room = datas.find(d => d.id === room_type_id);
            return {
                room_type_id,
                room_type_variant_id,
                quantity,
                name: room?.name || ""
            };
        });
        localStorage.setItem('infoSelectedRoom', JSON.stringify(details));
        onChange(details);
    }

    function seasonsPrice(basePrice: number, discounType = 0, discountValue = 0): number {
        if (discounType === 0) {
            return (basePrice - discountValue) ;
        }
        if (discounType === 1) {
            return basePrice - (basePrice * (discountValue / 100)) ;
        }
        return basePrice;
    }

    const calculateTotalRooms = (): number => {
        let total = 0;

        Object.entries(quantities).forEach(([key, quantity]) => {
            if (quantity <= 0) return;

            const [roomTypeIdStr, variantIdStr] = key.split("-");
            const roomTypeId = Number(roomTypeIdStr);
            const variantId = Number(variantIdStr);

            const room = datas.find(d => d.id === roomTypeId);
            const variant = room?.variants.find(v => v.id === variantId);

            if (!variant) return;

            let price = variant.base_price;

            if (variant.seasons.length > 0) {
                const firstSeason = variant.seasons[0]; // hoặc chọn theo logic khác
                price = seasonsPrice(price, firstSeason.discount_type, firstSeason.discount_value);
            }

            total += price * quantity * Number(numberOfNights);
        });

        localStorage.setItem('totalRoom', JSON.stringify(total))
        return total;
    }

    useEffect(() => {
        calculateTotalRooms();
    }, [quantities])


    const timeToFreeCancel = () => {
        const getTime = localStorage.getItem('findRoom')
        const data = JSON.parse(getTime ?? "");
        const checkInDate = new Date(data.dateRange?.[0]);

        const vnTime = new Date(checkInDate.getTime() - 24 * 60 * 60 * 1000)
        const pad = (n: number) => n.toString().padStart(2, '0');

        const dd = pad(vnTime.getDate());
        const MM = pad(vnTime.getMonth() + 1);
        const yyyy = pad(vnTime.getFullYear() + 1);
        const hh = pad(vnTime.getHours());
        const mm = pad(vnTime.getMinutes());

        return `${dd}/${MM}/${yyyy} ${hh}:${mm}`
    }

    return (
        <div className="overflow-x-auto">
            <table typeof="1" className="min-w-full table-auto border border-gray-300">
                <thead>
                    <tr className="bg-blue-700 text-white">
                        <th className="text-left px-4 py-2 border-r border-gray-500">Loại phòng </th>
                        <th className="text-left px-4 py-2 border-r border-gray-500">Người</th>
                        <th className="px-4 py-2 border-r border-gray-500 text-end">
                            Giá/Phòng/Đêm
                        </th>
                        <th className="text-end px-4 py-2 border-r border-gray-500">
                            Số lượng
                        </th>
                        <th className="text-left px-2 py-2 border-r border-gray-500">
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
                        datas.map((data, dataIndex) => {
                            if (data.variants.length === 0) {

                                // ⚠️ Phòng không có biến thể
                                return (
                                    <tr key={`room-${dataIndex}`} className="border-t border-gray-300">
                                        <td className="px-4 py-3 border-r">
                                            <div className="font-medium text-blue-700">
                                                <DialogDetailHotel title={data.name} area={data.area} amenities={data.amenities} />
                                            </div>
                                            <div className="text-sm text-gray-600">Loại giường: {data.bed?.type_name}</div>
                                        </td>
                                        <td className="text-center text-sm text-gray-500 border-r" colSpan={4}>
                                            Hết phòng
                                        </td>
                                    </tr>
                                );
                            }

                            // ✅ Phòng có biến thể
                            return data.variants.map((variant, vIndex) => {
                                const adults = variant.attributes.find(attr => attr.name === "Người lớn");
                                const children = variant.attributes.find(attr => attr.name === "Trẻ em");
                                const notes = variant.attributes.slice(2, 5);
                                const cancel = variant.attributes.find(attr => attr.name === "Miễn phí huỷ trước 24h và thu phí sau đó");
                                const isEmptySeasons = variant.seasons.length === 0;
                                const seasons = variant.seasons


                                return (
                                    <tr key={`${dataIndex}-${vIndex}`} className="border-t border-gray-300">
                                        {vIndex === 0 && (
                                            <td rowSpan={data.variants.length} className="px-4 py-3 border-r align-top">
                                                <div className="font-medium text-blue-700">
                                                    <DialogDetailHotel title={data.name} area={data.area} amenities={data.amenities} />
                                                </div>
                                                <div className="text-sm text-gray-600">Loại giường: {data.bed?.type_name}</div>
                                            </td>
                                        )}

                                        {/* Số lượng người */}
                                        <td className="px-4 py-3 border-r">
                                            {adults &&
                                                Array.from({ length: adults.value }).map((_, i) => (
                                                    <FaUser key={`adult-${vIndex}-${i}`} className="inline-block w-5 h-5 text-blue-600 mr-1" />
                                                ))}
                                            {children &&
                                                Array.from({ length: children.value }).map((_, i) => (
                                                    <FaChild key={`child-${vIndex}-${i}`} className="inline-block w-5 h-5 text-pink-500 mr-1" />
                                                ))}
                                        </td>

                                        {/* Giá phòng */}
                                        <td className="px-4 py-3 border-r text-end">
                                            {isEmptySeasons && !variant.discount_price && (
                                                <p className="font-medium cursor-pointer">{Currency.formatVND(variant.base_price)}</p>
                                            )}
                                            {seasons.length > 0 && (
                                                <div>
                                                    <p className="font-thin text-xs line-through cursor-pointer">
                                                        {Currency.formatVND(variant.base_price)}
                                                    </p>
                                                    {variant.seasons.map((season, index) => (
                                                        <p className="text-red-500 font-medium cursor-pointer text-end" key={index}>
                                                            {season.name}: {Currency.formatVND(seasonsPrice(variant.base_price, season.discount_type, season.discount_value))}
                                                        </p>
                                                    ))}

                                                </div>
                                            )}
                                        </td>

                                        {/* Số lượng đặt */}
                                        <td className="px-4 py-3 border-r text-end">
                                            {data.available_room_count && (
                                                <input
                                                    type="number"
                                                    min={0}
                                                    max={data.available_room_count}
                                                    value={quantities[`${data.id}-${variant.id}`] || ""}
                                                    onChange={(e) => {
                                                        handleQuantityChange(data.id, variant.id, Number(e.target.value))
                                                    }}
                                                    className="w-14 border border-gray-300 rounded px-2 py-1 text-sm"

                                                />
                                            )}
                                        </td>

                                        {/* Ghi chú */}
                                        <td className="px-6 py-3 border-r text-sm text-gray-700">
                                            <ul className="list-disc pl-4">
                                                {notes.map((note, index) => (
                                                    <li key={index}>{note.name}</li>
                                                ))}
                                            </ul>
                                            {cancel && (
                                                <p className="text-xs font-thin text-gray-500 mt-1 italic">
                                                    Ghi chú: Phải huỷ đặt phòng trước {timeToFreeCancel()} sau thời gian đó giá hủy là {Currency.formatVND(cancel.value)}
                                                </p>
                                            )}
                                        </td>
                                    </tr>
                                );
                            });
                        })
                    )}
                </tbody>
            </table>
        </div>
    )
}
