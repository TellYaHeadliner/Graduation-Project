import { Button } from '@radix-ui/themes';
import { CardSearch } from '../../types/SearchTypes';
import { Currency } from '../../utils/Currency';

interface CardItemSearchProps {
  data: CardSearch;
}

const showPrice = (basePrice: number, discountPrice: number | null) => (
  <div className="text-right mt-2">
    { discountPrice ? (
      <>
        <span className="text-red-600 text-lg">{Currency.formatVND(discountPrice)}</span>
        <span className="text-sm text-gray-500 line-through ml-2">
          {Currency.formatVND(basePrice)}
        </span>
      </>
    ) : (
      <span className='text-red-600 font-bold text-lg'>
        {Currency.formatVND(basePrice)}
      </span>
    )}
  </div>
)

export default function CardItemSearch({ data }: CardItemSearchProps) {


  return (
    <div className="flex border mt-5 rounded-lg shadow-md overflow-hidden 2xl:max-w-6xl max-w-4xl bg-white">
      {/* Left section - Image and labels */}
      <div className="basis-2/6 relative bg-gray-100">
        <img
          src={import.meta.env.VITE_URL + data?.avatar}
          className="w-100 h-full object-cover"
        />
      </div>

      {/* Middle section - Details */}
      <div className="basis-2/4 p-4 flex flex-col justify-between">
        <div>
          <h2 className="text-lg font-semibold">{data.name}</h2>
          <div className="flex items-center text-sm text-blue-600 mt-1">
            <span className="mr-2 py-1 rounded px-2 bg-blue-600 text-white flex items-center gap-1">
              {data.average_star} 
            </span>
            <span>{data.total_reviews} đánh giá</span>
          </div>
          <div className="text-sm text-gray-500 mt-1">📍 {data.address}</div>
        </div>
        {/* Thêm các tag, tiện nghi tại đây nếu có */}
        <div className="flex flex-wrap mt-2 gap-1 text-xs text-white">
          {
            data.amenities.map((amentity, index) => (
              <span key={index} className="bg-blue-500 px-2 py-1 rounded">
                {amentity.name}
              </span>
            ))
          }
        </div>
        <div className="mt-3 text-sm text-gray-700 space-y-1">
          <div className="font-medium text-black">
            {data.room_type.name}
          </div>

          <div className="grid grid-cols-2 gap-y-1 mt-1">
            <div className="flex items-center">
              <span>
                🛏️ {data.room_type.bed_quantity} {data.room_type.bed_type}
              </span>
            </div>
            <div className="flex items-center gap-1">
              <span>
                👤 <span>{data.room_type.guest} người lớn</span>
              </span>
            </div>
            <div className="flex items-center gap-1">
              <span>
                🧒 <span>{data.room_type.children} trẻ em</span>
              </span>
            </div>
            <div className="flex items-center gap-1">
              <span>
                {
                  data.room_type.cancellation && (
                  <div>
                  ✅ <span>{data.room_type.cancellation}</span>

                  </div>
                  )
                }
              </span>
            </div>
            <div className="flex items-center gap-1">
              {showPrice(data.room_type.base_price, data.room_type.discount_price)}
            </div>
          </div>

          <div>
            <Button>
              Xem chi tiết phòng
            </Button>
          </div>

        </div>
      </div>
    </div>
  )
}