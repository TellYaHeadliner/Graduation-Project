import { HistoryBooking } from "../../types/HistoryBookingTypes";
import { Currency } from "../../utils/Currency";

interface TableHistoryProps {
  datas: HistoryBooking[];
}

export default function TableHistory({ datas }: TableHistoryProps) {
  const getStatusConfig = (status: string) => {
    switch (status) {
      case "Chờ xác nhận":
        return {
          bg: "bg-yellow-50",
          text: "text-yellow-700",
          border: "border-yellow-200",
          dot: "bg-yellow-500"
        };

      case "Đã nhận phòng":
        return {
          bg: "bg-green-50",
          text: "text-green-700",
          border: "border-green-200",
          dot: "bg-green-600"
        };

      case "Đã hủy":
        return {
          bg: "bg-gray-50",
          text: "text-gray-600",
          border: "border-gray-200",
          dot: "bg-gray-400"
        };

      case "Đã trả phòng":
        return {
          bg: "bg-indigo-50",
          text: "text-indigo-700",
          border: "border-indigo-200",
          dot: "bg-indigo-500"
        };

      default:
        return {
          bg: "bg-red-50",
          text: "text-red-700",
          border: "border-red-200",
          dot: "bg-red-500"
        };
    }
  };

  return (
    <div className="w-full max-w-none">
      {/* Desktop Table */}
      <div className="hidden md:block overflow-hidden rounded-2xl bg-white shadow-lg border border-gray-100">
        <div className="overflow-x-auto">
          <table className="w-full min-w-[800px]">
            <thead>
              <tr className="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-gray-200">
                <th className="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-[25%] 2xl:w-[30%]">
                  Khách sạn
                </th>
                <th className="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-[30%] 2xl:w-[35%]">
                  Địa chỉ
                </th>
                <th className="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-[15%] 2xl:w-[12%]">
                  Tổng tiền
                </th>
                <th className="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-[12%] 2xl:w-[10%]">
                  Check In
                </th>
                <th className="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-[12%] 2xl:w-[10%]">
                  Check Out
                </th>
                <th className="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-[6%] 2xl:w-[3%]">
                  Trạng thái
                </th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-100">
              {datas.length === 0 ? (
                <tr>
                  <td colSpan={6} className="px-6 py-16 text-center">
                    <div className="flex flex-col items-center justify-center space-y-3">
                      <div className="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg className="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                      </div>
                      <div>
                        <p className="text-gray-500 font-medium">Chưa có lịch sử đặt phòng</p>
                        <p className="text-sm text-gray-400 mt-1">Các đặt phòng của bạn sẽ xuất hiện ở đây</p>
                      </div>
                    </div>
                  </td>
                </tr>
              ) : (
                datas.map((data, index) => (
                  <tr
                    key={data.id}
                    className={`hover:bg-gray-50 transition-all duration-200 ${index % 2 === 0 ? 'bg-white' : 'bg-gray-50/30'
                      }`}
                  >
                    <td className="px-6 py-4 2xl:px-8">
                      <a
                        href={`/chi-tiet-booking/${data.id}`}
                        className="text-blue-600 hover:text-blue-800 font-medium hover:underline transition-colors duration-200 text-sm 2xl:text-base"
                      >
                        {data.hotel_name}
                      </a>
                    </td>
                    <td className="px-6 py-4 2xl:px-8 text-gray-600 text-sm 2xl:text-base">
                      {data.address}
                    </td>
                    <td className="px-6 py-4 2xl:px-8 text-gray-900 font-semibold text-sm 2xl:text-base">
                      {Currency.formatVND(data.total_price)}
                    </td>
                    <td className="px-6 py-4 2xl:px-8 text-gray-600 text-sm 2xl:text-base">
                      {data.check_in}
                    </td>
                    <td className="px-6 py-4 2xl:px-8 text-gray-600 text-sm 2xl:text-base">
                      {data.check_out}
                    </td>
                    <td className="px-6 py-4 2xl:px-8">
                      {(() => {
                        const config = getStatusConfig(data.status);
                        return (
                          <span
                            className={`inline-flex items-center px-3 py-1 rounded-lg text-xs 2xl:text-sm font-medium border ${config.bg} ${config.text} ${config.border}`}
                          >
                            <span className={`w-2 h-2 2xl:w-3 2xl:h-3 rounded-full ${config.dot} mr-2`}></span>
                            {data.status}
                          </span>
                        );
                      })()}
                    </td>
                  </tr>
                ))
              )}
            </tbody>
          </table>
        </div>
      </div>

      {/* Mobile Cards */}
      <div className="md:hidden space-y-4">
        {datas.length === 0 ? (
          <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div className="flex flex-col items-center justify-center space-y-3">
              <div className="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                <svg className="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
              </div>
              <div className="text-center">
                <p className="text-gray-500 font-medium">Chưa có lịch sử đặt phòng</p>
                <p className="text-sm text-gray-400 mt-1">Các đặt phòng của bạn sẽ xuất hiện ở đây</p>
              </div>
            </div>
          </div>
        ) : (
          datas.map((data) => (
            <div
              key={data.id}
              className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200"
            >
              <div className="flex justify-between items-start mb-4">
                <div className="flex-1">
                  <a
                    href={`/chi-tiet-booking/${data.id}`}
                    className="text-lg font-semibold text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200"
                  >
                    {data.hotel_name}
                  </a>
                  <p className="text-gray-600 text-sm mt-1 leading-relaxed">
                    {data.address}
                  </p>
                </div>
                {(() => {
                  const config = getStatusConfig(data.status);
                  return (
                    <span
                      className={`inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border ${config.bg} ${config.text} ${config.border} ml-4`}
                    >
                      <span className={`w-2 h-2 rounded-full ${config.dot} mr-2`}></span>
                      {data.status}
                    </span>
                  );
                })()}
              </div>

              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                <div className="space-y-3">
                  <div>
                    <p className="text-xs text-gray-500 uppercase tracking-wide font-medium">Tổng tiền</p>
                    <p className="text-lg font-bold text-gray-900 mt-1">
                      {Currency.formatVND(data.total_price)}
                    </p>
                  </div>
                </div>

                <div className="space-y-3">
                  <div>
                    <p className="text-xs text-gray-500 uppercase tracking-wide font-medium">Thời gian</p>
                    <div className="mt-1 space-y-1">
                      <p className="text-sm text-gray-700">
                        <span className="font-medium">Check In:</span> {data.check_in}
                      </p>
                      <p className="text-sm text-gray-700">
                        <span className="font-medium">Check Out:</span> {data.check_out}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          ))
        )}
      </div>
    </div>
  );
}