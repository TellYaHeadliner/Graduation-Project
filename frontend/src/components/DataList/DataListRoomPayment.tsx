const bookedRooms = [
    { name: "Loại phòng 1 giường lớn", quantity: 1 },
    { name: "Loại phòng 2 giường nhỏ", quantity: 1 },
];

export default function DataListRoomPayment() {
    return (
        <div className="bg-gray-100 rounded-xl p-4 w-[320px] text-sm font-medium space-y-1">
            <div className="font-bold">
                Loại phòng bạn đặt
            </div>

            {bookedRooms.map((room, index) => (
            <div key={index} className="flex justify-between font-normal">
                <span>{room.name}</span>
                <span>{room.quantity}</span>
            </div>
            ))}

            <a href="/" className="hover:underline font-semibold text-left">
                Thay đổi loại phòng bạn đặt
            </a>
        </div>
    )
}