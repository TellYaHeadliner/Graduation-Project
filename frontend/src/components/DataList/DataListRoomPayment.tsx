interface RoomSelection {
    name: string;
    quantity: number;
    room_type_id: number;
    room_type_variant_id: number;
}
export interface DataListRoomPaymentProps {
    infoSelectedRoom: RoomSelection[];
}
export default function DataListRoomPayment({ infoSelectedRoom }: DataListRoomPaymentProps) {
    const mergedRooms = Object.values(
        infoSelectedRoom.reduce<Record<number, RoomSelection>>((acc, room) => {
            if (acc[room.room_type_id]) {
                acc[room.room_type_id].quantity += room.quantity;
            } else {
                acc[room.room_type_id] = { ...room }; // clone để không mutate input
            }
            return acc;
        }, {})
    );


    return (
        <div className="bg-gray-100 rounded-xl p-4 w-[320px] text-sm font-medium space-y-1 mb-4">
            <div className="flex justify-between">
                <span>
                    Loại phòng bạn đặt
                </span>
                <span>
                    Số lượng
                </span>
            </div>

            {
                mergedRooms.length > 0 && mergedRooms.map((infoData) => (
                    <div
                        key={infoData.room_type_id}
                        className="flex justify-between font-normal"
                    >
                        <span>{infoData.name}</span>
                        <span>{infoData.quantity}</span>
                    </div>
                ))
            }



        </div>
    )
}