import { DetailHotel } from "../../types/DetailHotelTypes"

interface CardHotelProps{
    dataHotel: DetailHotel | undefined;
}

export default function CardHotel({ dataHotel }: CardHotelProps){
    return (
        <div className="w-full rounded-lg shadow border bg-white">
            <div className="bg-gray-200 flex items-center justify-center">
                <img src={import.meta.env.VITE_URL + dataHotel?.avatar} className="w-full" />
            </div>
            <div className="p-4">
                <h3 className="text-base font-semibold text-gray-900">
                    {dataHotel?.name}
                </h3>
                <p className="text-sm text-gray-500">
                    Địa chỉ {dataHotel?.address}
                </p>
            </div>
        </div>
    )
}