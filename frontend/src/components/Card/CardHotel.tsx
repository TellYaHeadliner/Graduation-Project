import hotelImg from "../../assets/stephen-house.jpg"

export default function CardHotel(){
    return (
        <div className="w-80 rounded-lg shadow border bg-white">
            <div className="w-full h-50 bg-gray-200 flex items-center justify-center">
                <img src={hotelImg} alt={hotelImg} className="w-full h-50" />
            </div>
            <div className="p-4">
                <h3 className="text-base font-semibold text-gray-900">
                    Khách sạn ABC
                </h3>
                <p className="text-sm text-gray-500">
                    Địa chỉ: 431 ABC, phường 21, quận Bình Tân, TP.HCM
                </p>
            </div>
        </div>
    )
}