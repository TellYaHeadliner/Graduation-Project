import { useState } from "react"

export const tabs = [
    {
        id: "all", label: "Tất cả", description: "Tất cả lịch sử khách sạn bạn đã đặt"
    },
    {
        id: "confirmed", label: "Booking đã đặt", description: "Khách sạn bạn đã booking thành công"
    },
    {
        id: "pending", label: "Booking chờ xác nhận", description: "Khách sạn đang chờ xác nhận"
    },
    {
        id: "cancelled", label: "Booking đã hủy", description: "Khách sạn đã bị hủy"
    }
]

export default function TabBooking() {
    const [activeTab, setActiveTab] = useState('all')

    return (
        <div className="flex">
            <div className="w-full max-w-[300px] lg:ml-26 text-start border rounded-lg overflow-hidden shadow-sm">
                {tabs.map((tab) => (
                    <div
                        key={tab.id}
                        onClick={() => setActiveTab(tab.id)}
                        className={`flex-1 px-4 py-2 text-sm font-medium border-b border-gray-400
                            ${activeTab === tab.id
                                ? "bg-blue-100 text-blue-600"
                                : "bg-white text-gray-600 hover:bg-gray-50"
                            } transition`}
                    >
                        {tab.label}
                    </div>
                ))}
            </div>
        </div>
    )
}