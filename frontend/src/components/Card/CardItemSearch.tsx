import { StarFilledIcon } from '@radix-ui/react-icons';
import { CardSearch } from '../../types/SearchTypes';
import { Currency } from '../../utils/Currency';

interface CardItemSearchProps{
  data: CardSearch;
}

export default function CardItemSearch({ data }: CardItemSearchProps) {
    return (
      <div className="flex border rounded-lg shadow-md overflow-hidden max-w-4xl bg-white">
        {/* Left section - Image and labels */}
        <div className="basis-1/4 relative bg-gray-100">
          <img
            src={import.meta.env.VITE_URL + data?.avatar}
            className="w-full h-full object-cover"
          />
        </div>

        {/* Middle section - Details */}
        <div className="basis-2/4 p-4 flex flex-col justify-between">
          <div>
            <h2 className="text-lg font-semibold">{data.name}</h2>
            <div className="flex items-center text-sm text-blue-600 mt-1">
              <span className="mr-2 px-2 py-1 rounded bg-blue-500 text-white flex items-center gap-1">
                <StarFilledIcon /> {data.avarage_star}
              </span>
              <span>{data.total_review} đánh giá</span>
            </div>
            <div className="text-sm text-gray-500 mt-1">📍 {data.address}</div>
          </div>
          {/* Thêm các tag, tiện nghi tại đây nếu có */}
        </div>

        {/* Right section - Price */}
        <div className="basis-1/4 p-4 flex flex-col items-end justify-between">
          <div className="text-right mt-2">
            <div className="line-through text-gray-400 text-sm">
              {Currency.formatVND(data.room_type.base_price)}
            </div>
            <div className="text-orange-600 text-lg font-bold">
              {Currency.formatVND(data.room_type.discount_price)}
            </div>
          </div>
        </div>
      </div>
    )
}