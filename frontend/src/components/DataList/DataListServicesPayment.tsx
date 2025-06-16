import { Currency } from "../../utils/Currency";
import { hotelServices } from "../../utils/HotelServicesStaticData";

export default function DataListServiesPayment() {
    const temp = hotelServices.slice(0, 10)
    return (
        <div className="bg-gray-100 rounded-xl p-4 w-[320px] text-sm font-medium space-y-1">
            <div className="font-bold">
                Dịch vụ bạn chọn
            </div>

            <div className="space-y-1 max-h-40 overflow-y-auto pr-1">
                {temp.map((service, index) => (
                <div key={index} className="flex justify-between font-normal">
                    <span>{service.name}</span>
                    <span>{Currency.formatVND(service.price)}</span>
                </div>
                ))}
            </div>


            <a href="/" className="hover:underline font-semibold text-left mt-2">
                Thay đổi dịch vụ bạn mong muốn
            </a>
        </div>
    )
}