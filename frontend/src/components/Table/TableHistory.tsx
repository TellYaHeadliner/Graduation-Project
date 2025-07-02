import { HistoryBooking } from "../../types/HistoryBookingTypes";
import { Currency } from "../../utils/Currency";

interface TableHistoryProps {
  datas: HistoryBooking[];
}

export default function TableHistory({ datas }: TableHistoryProps) {

  return (
    <div className="overflow-x-auto border rounded-xl shadow-sm">
      <table typeof="1" className="min-w-full table-auto text-sm border-collapse">
        <thead className="bg-blue-700 text-white">
          <tr>
            <th className="p-4 font-semibold whitespace-nowrap">Tên khách sạn</th>
            <th className="p-4 font-semibold whitespace-nowrap">Địa chỉ</th>
            <th className="p-4 font-semibold whitespace-nowrap">Tổng tiền</th>
            <th className="p-4 font-semibold whitespace-nowrap">Check In</th>
            <th className="p-4 font-semibold whitespace-nowrap">Checkout</th>
            <th className="p-4 font-semibold whitespace-nowrap">Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          {datas.length === 0 ? (
            <tr>
              <td colSpan={6} className="text-center p-6 text-gray-500 font-medium bg-gray-50">
                Chưa có thanh toán nào.
              </td>
            </tr>
          ) : (
            datas.map((data) => (
              <tr key={data.id} className="border-t border-gray-300">
                <td className="p-4 font-medium text-gray-500 hover:underline">
                  <a href={`/chi-tiet-booking/${data.id}`}>{data.hotel_name}</a>
                </td>
                <td className="p-4 font-medium text-gray-500">{data.address}</td>
                <td className="p-4 font-medium text-gray-500">
                  {Currency.formatVND(data.total_price)}
                </td>
                <td className="p-4 font-medium text-gray-500">{data.check_in}</td>
                <td className="p-4 font-medium text-gray-500">{data.check_out}</td>
                <td className="p-4 font-medium text-gray-500">{data.status}</td>
              </tr>
            ))
          )}
        </tbody>
      </table>
    </div>
  );
}
