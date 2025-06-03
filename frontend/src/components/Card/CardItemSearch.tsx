import { CardListStaticData, CardListWithPriceData } from '../../utils/CardListStaticData';
import { Currency } from '../../utils/Currency';

export default function CardItemSearch() {
    return (
        <div className="flex border rounded-lg shadow-md overflow-hidden max-w-4xl">
        {/* Left section - Image and labels */}
        <div className="w-1/3 relative">
          <img
            src="https://cdn1.ivivu.com/iVivu/2023/10/24/14/Muong-Thanh-Luxury-Da-Nang-Hotel-1-20231024143140.jpg"
            alt="Hotel"
            className="w-full h-full object-cover"
          />
        </div>
  
        {/* Middle section - Details */}
        <div className="w-2/3 p-4 flex flex-col justify-between">
          <div>
            <h2 className="text-lg font-semibold">
              {CardListStaticData[0].title}
            </h2>
            <div className="flex items-center text-sm text-blue-600">
              <span className="mr-2">8.5</span>
              <span>{CardListStaticData[0].reviewCount} đánh giá</span>
            </div>
            <div className="text-sm text-gray-500 mt-1">📍 {CardListStaticData[0].address}</div>
  
            <div className="flex flex-wrap mt-2 gap-1 text-xs text-gray-600">
              <span className="bg-gray-100 px-2 py-1 rounded">Bóng bàn</span>
              <span className="bg-gray-100 px-2 py-1 rounded">Khu vui chơi trẻ em</span>
              <span className="bg-gray-100 px-2 py-1 rounded">Quần vợt</span>
              <span className="bg-gray-100 px-2 py-1 rounded">Mát-xa</span>
              <span className="bg-gray-100 px-2 py-1 rounded">Trung tâm thể dục thể hình</span>
              <span className="bg-gray-100 px-2 py-1 rounded">1+</span>
            </div>
          </div>
  
        </div>
  
        {/* Right section - Price and button */}
        <div className="w-1/4 p-4 flex flex-col items-end justify-between bg-white">
          <div className="text-right mt-2">
            <div className="line-through text-gray-400 text-sm">{Currency.formatVND(CardListWithPriceData[0].discountPrice)}</div>
            <div className="text-orange-600 text-lg font-bold">{Currency.formatVND(CardListWithPriceData[0].price)}</div>
          </div>
          <button className="mt-4 bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
            Chọn phòng
          </button>
        </div>
      </div>
    )
}