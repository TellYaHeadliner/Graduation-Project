import { CardListStaticData, CardListWithPriceData } from '../../utils/CardListStaticData';
import { Currency } from '../../utils/Currency';

export default function MyCardHotel() {
  const data = CardListStaticData[0];
  const bookingStatus = 'Đã đặt'; // hoặc 'Chờ xử lý'

  const getStatusBadgeColor = (status: string) => {
    switch (status) {
      case 'Đã đặt':
        return 'bg-green-500';
      case 'Chờ xử lý':
        return 'bg-yellow-500';
      default:
        return 'bg-gray-500';
    }
  };

  return (
    <div className="flex border rounded-lg shadow-md overflow-hidden max-w-4xl">
      {/* Left section - Image */}
      <div className="w-1/3 relative">
        <img
          src="https://cf.bstatic.com/xdata/images/hotel/square600/665433940.webp?k=89858a85508ff5cc888a9ed0681fda9f8974c5395a383f58a436d266facc8707&o="
          alt="Hotel"
          className="w-full h-full object-cover"
        />
      </div>

      {/* Middle section - Info */}
      <div className="w-2/3 p-4 flex flex-col justify-between">
        <div>
          <h2 className="text-lg font-semibold">{data.title}</h2>
          <div className="text-sm text-gray-500 mt-1">📍 {data.address}</div>


          {/* Trạng thái đặt phòng */}
          <div className="mt-3">
            <span className={`inline-block text-xs text-white px-2 py-1 rounded ${getStatusBadgeColor(bookingStatus)}`}>
              {bookingStatus}
            </span>
          </div>
        </div>
      </div>

      {/* Right section - Price & Buttons */}
      <div className="w-1/4 p-4 flex flex-col items-end justify-between bg-white">
        <div className="flex flex-col gap-2 w-full mt-4">
          <button className="w-full bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
            Chọn phòng
          </button>
          <button className="w-full bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
            Hủy phòng
          </button>
        </div>
      </div>
    </div>
  );
}
