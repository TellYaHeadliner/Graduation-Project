/* eslint-disable react-hooks/exhaustive-deps */
import { Currency } from "../../utils/Currency";
import DialogDetailHotel from "../Dialog/DialogDetailHotel";
import { FaChild, FaUser } from "react-icons/fa6";
import { RoomType } from "../../types/RoomTypes";
import { Rule } from "../../types/DetailHotelTypes";
import { useEffect, useState } from "react";
import LoadingSpinner from "../Loading/LoadingSpinner";
import { CheckIcon } from "@radix-ui/react-icons";
import { MdOutlineCancel } from "react-icons/md";
import { LuBedSingle } from "react-icons/lu";
import { MdBed } from "react-icons/md";



interface TableRoomProps {
    datas: RoomType[];
    onChange: (bookingDetails: {
        room_type_id: number;
        room_type_variant_id: number;
        quantity: number;
        name: string;
    }[]) => void;
    isLoading?: boolean;
    hotelRule?: Rule
}

export default function TableRoom({ datas, onChange, isLoading, hotelRule }: TableRoomProps) {
    const numberOfNights = JSON.parse(localStorage.getItem('numberOfNights') || '0');
    const [quantities, setQuantities] = useState<Record<string, number>>({});
    const Rule = hotelRule;
    const handleQuantityChange = (roomTypeId: number, variantId: number, quantity: number) => {
        const key = `${roomTypeId}-${variantId}`;
        const updated = { ...quantities, [key]: quantity };
        setQuantities(updated);


        const details = Object.entries(updated).filter(([_, q]) => q > 0)
            .map(([key, quantity]) => {
                const [room_type_id, room_type_variant_id] = key.split("-").map(Number);
                const room = datas.find(d => d.id === room_type_id);
                const variant = room?.variants.find(v => v.id === room_type_variant_id);

                let finalPrice = variant?.base_price ?? 0;

                if (variant?.discount_price && variant.discount_price > 0) {
                    finalPrice = variant.discount_price;
                }

                if (variant?.seasons.length) {
                    const firstSeason = variant.seasons[0]; 
                    finalPrice = seasonsPrice(finalPrice, firstSeason.discount_type, firstSeason.discount_value);
                }

                return {
                    room_type_id,
                    room_type_variant_id,
                    quantity,
                    name: room?.name || "",
                    price: finalPrice 
                };
            });
        localStorage.setItem('infoSelectedRoom', JSON.stringify(details));
        onChange(details);
    }

    function seasonsPrice(Price: number, discounType = 0, discountValue = 0): number {
        if (discounType === 0) {
            return (Price - discountValue);
        }
        if (discounType === 1) {
            return Price - (Price * (discountValue / 100));
        }
        return Price;
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

            let price = (variant.discount_price && variant.discount_price > 0) ? variant.discount_price : variant.base_price;

            if (variant.seasons.length > 0) {
                const firstSeason = variant.seasons[0];
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

        return `${dd}/${MM}/${yyyy} ${Rule?.check_in_time}`
    }

    return (
        <div className="overflow-x-auto ">
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
                    {isLoading ? (
                        <tr>
                            <td colSpan={5} className="text-center py-4 text-blue-600 font-semibold animate-pulse">
                                <div className="flex justify-center items-center">
                                    <LoadingSpinner />
                                </div>
                            </td>
                        </tr>
                    ) : datas.length === 0 ? (
                        <tr>
                            <td colSpan={5} className="text-center py-4 text-gray-500">
                                Không có dữ liệu
                            </td>
                        </tr>
                    ) : (
                        datas.map((data, dataIndex) => {
                            if (data.variants.length === 0) {
                                return (
                                    <tr key={`room-${dataIndex}`} className="border-t border-gray-300">
                                        <td className="px-4 py-3 border-r">
                                            <div className="font-medium text-blue-700">
                                                <DialogDetailHotel title={data.name} area={data.area} amenities={data.amenities} galleyList={ data.gallery?.split(",") ?? []}/>
                                            </div>
                                            <div className="text-sm text-gray-600">Loại giường: {data.bed?.type_name}</div>
                                        </td>
                                        <td className="text-center text-sm text-gray-500 border-r" colSpan={4}>
                                            Hết phòng
                                        </td>
                                    </tr>
                                );
                            }


                            return data.variants.map((variant, vIndex) => {
                                const adults = variant.attributes.find(attr => attr.name === "Người lớn");
                                const children = variant.attributes.find(attr => attr.name === "Trẻ em");
                                const notes = variant.attributes.slice(2, 5);
                                const cancel = variant.attributes.find(attr =>
                                    attr.name === "Miễn phí huỷ trước 24h và thu phí sau đó" ||
                                    attr.name === "Không hoàn tiền"
                                );
                                const isEmptySeasons = variant.seasons.length === 0;
                                const seasons = variant.seasons

                                const getSelectedCountByRoomType = (roomTypeId: number) => {
                                    return Object.entries(quantities).reduce((total, [key, value]) => {
                                        const [rId] = key.split("-").map(Number);
                                        return rId === roomTypeId ? total + value : total;
                                    }, 0);
                                };


                                return (
                                    <tr key={`${dataIndex}-${vIndex}`} className="border-t border-gray-300">
                                        {vIndex === 0 && (
                                            <td rowSpan={data.variants.length} className="px-4 py-3 border-r align-top">
                                                <div className="font-medium text-blue-700">
                                                    <DialogDetailHotel title={data.name} area={data.area} amenities={data.amenities} galleyList={ data.gallery?.split(",") ?? []}/>
                                                </div>
                                                <div className="text-sm text-gray-600 mt-2 flex items-center gap-1">
                                                    {data.bed?.quantity} {data.bed?.type_name}
                                                    {data.bed?.type_name === "Giường Đơn" ? (
                                                        <LuBedSingle className="w-4 h-4 text-gray-500" />
                                                    ) : (
                                                        <MdBed className="w-4 h-4 text-gray-500" />
                                                    )}
                                                </div>
                                                <div className="text-sm text-gray-600 flex flex-wrap gap-2 mt-2">
                                                    {data.amenities.map((a, index) => (
                                                        <div key={index} className="flex items-center gap-1">
                                                            <CheckIcon className="text-green-500 w-4 h-4" />
                                                            <span>{a.name}</span>
                                                            {index < data.amenities.length - 1 && <span>,</span>}
                                                        </div>
                                                    ))}
                                                </div>
                                            </td>
                                        )}

                                        {/* Số lượng người */}
                                        <td className="px-4 py-3 border-r">
                                            {adults &&
                                                Array.from({ length: adults.value }).map((_, i) => (
                                                    <FaUser key={`adult-${vIndex}-${i}`} className="inline-block w-5 h-5 text-blue-600 mr-1" />
                                                ))}
                                            {adults && children && <span className="mx-1 text-gray-500">+</span>}
                                            {children &&
                                                Array.from({ length: children.value }).map((_, i) => (
                                                    <FaChild key={`child-${vIndex}-${i}`} className="inline-block w-5 h-5 text-blue-500 mr-1" />
                                                ))}
                                        </td>

                                        {/* Giá phòng */}
                                        <td className="px-4 py-3 border-r text-end">
                                            {isEmptySeasons && !variant.discount_price && (
                                                <p className="font-medium cursor-pointer">{Currency.formatVND(variant.base_price)}</p>
                                            )}
                                            {isEmptySeasons && variant.discount_price && (
                                                <div>
                                                    <p className="font-thin text-xs line-through cursor-pointer">
                                                        {Currency.formatVND(variant.base_price)}
                                                    </p>
                                                    <div className="flex flex-col items-end gap-1 mt-1">
                                                        <p className="text-red-500 font-medium cursor-pointer text-end">
                                                            {Currency.formatVND(variant.discount_price)}
                                                        </p>
                                                        {variant.base_price > 0 && (
                                                            <span className="inline-block bg-[#008234] text-white text-xs font-medium rounded-[6px] px-2 py-[2px]">
                                                                Tiết kiệm {Math.round(((variant.base_price - variant.discount_price) / variant.base_price) * 100)}%
                                                            </span>
                                                        )}
                                                    </div>
                                                </div>
                                            )}
                                            {seasons.length > 0 && (
                                                <div>
                                                    {(variant.discount_price && variant.discount_price > 0)
                                                        ? (
                                                            <p className="font-thin text-xs line-through cursor-pointer">
                                                                {Currency.formatVND(variant.discount_price)}
                                                            </p>
                                                        ) : (
                                                            <p className="font-thin text-xs line-through cursor-pointer">
                                                                {Currency.formatVND(variant.base_price)}
                                                            </p>
                                                        )
                                                    }
                                                    {variant.seasons.map((season, index) => {
                                                        const price = (variant.discount_price && variant.discount_price > 0)
                                                            ? variant.discount_price
                                                            : (variant.base_price ?? 0);

                                                        const priceAfter = seasonsPrice(price, season.discount_type, season.discount_value);
                                                        const discountPercent = Math.round(((price - priceAfter) / price) * 100);

                                                        return (
                                                            <div className="flex flex-col items-end gap-1 mt-1" key={index}>
                                                                <p className="text-red-500 font-medium cursor-pointer text-end">
                                                                    {Currency.formatVND(seasonsPrice(price, season.discount_type, season.discount_value))}
                                                                </p>
                                                                <span className="inline-block bg-[#008234] text-white text-xs font-medium rounded-[6px] px-2 py-[2px]">
                                                                    {season.name}
                                                                </span>
                                                                {discountPercent > 0 && (
                                                                    <span className="inline-block bg-[#008234] text-white text-xs font-medium rounded-[6px] px-2 py-[2px]">
                                                                        Tiết kiệm {discountPercent}%
                                                                    </span>
                                                                )}
                                                            </div>
                                                        );
                                                    })}
                                                </div>
                                            )}
                                        </td>

                                        {/* Số lượng đặt */}
                                        <td className="px-4 py-3 border-r text-end">
                                            <select
                                                name="room_quantity"
                                                value={quantities[`${data.id}-${variant.id}`] || ""}
                                                onChange={(e) => {
                                                    handleQuantityChange(data.id, variant.id, Number(e.target.value));
                                                }}
                                            >
                                                <option value={0}>0 phòng</option>
                                                {
                                                    data.available_room_count &&
                                                    Array.from({ length: data.available_room_count }, (_, i) => {
                                                        const selectedCount = getSelectedCountByRoomType(data.id);
                                                        const currentValue = i + 1;
                                                        const currentSelected = quantities[`${data.id}-${variant.id}`] || 0;
                                                        const remaining = data.available_room_count - (selectedCount - currentSelected);

                                                        return (
                                                            <option
                                                                key={currentValue}
                                                                value={currentValue}
                                                                disabled={currentValue > remaining}
                                                            >
                                                                {currentValue} phòng
                                                            </option>
                                                        );
                                                    })
                                                }
                                            </select>
                                        </td>

                                        {/* Ghi chú */}
                                        <td className="px-6 py-3 border-r text-sm text-gray-700">
                                            <ul className="list-disc">
                                                {notes.map((note, index) => (
                                                    <li key={index} className="flex items-start gap-2 mb-1">
                                                        {note.name.toLowerCase().includes("không hoàn tiền") ? (
                                                            <MdOutlineCancel className="text-red-500 w-5 h-5 mt-1" />
                                                        ) : (
                                                            <CheckIcon className="text-green-500 w-5 h-5 mt-1" />
                                                        )}
                                                        <span className="font-medium">{note.name}</span>
                                                    </li>
                                                ))}
                                            </ul>
                                            {cancel?.name === "Miễn phí huỷ trước 24h và thu phí sau đó" && (
                                                <div>
                                                    <p className="text-xs font-medium text-green-500 mt-1 italic">
                                                        Miễn phí huỷ đặt phòng trước {timeToFreeCancel()}
                                                    </p>
                                                    <p className="text-xs font-medium text-red-500 mt-1 italic">
                                                        Phí huỷ đặt phòng sau {timeToFreeCancel()} là {Currency.formatVND(cancel.value)}
                                                    </p>
                                                </div>
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
