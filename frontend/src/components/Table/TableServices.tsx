import { Table } from "@radix-ui/themes";
import { Currency } from "../../utils/Currency";
import { Service } from "../../types/DetailHotelTypes"

interface TableServicesProps {
  data: Service[];
}

export default function TableServices({ data }: TableServicesProps) {
  return (
    <div className="overflow-x-auto">
      <table className="min-w-full table-auto border border-gray-200  rounded-md">
        <thead className="bg-blue-700 text-white">
          <tr>
            <th className="w-20 px-4 py-2 text-center">Số lượng</th>
            <th className="text-left px-4 py-2">Tên dịch vụ</th>
            <th className="text-left px-4 py-2">Đơn vị tính</th>
            <th className="text-left px-4 py-2">Mô tả</th>
            <th className="text-right px-4 py-2">Giá</th>
          </tr>
        </thead>
        <tbody>
          {data.map((service, index) => (
            <tr
              key={index}
              className="hover:bg-gray-50 transition-colors border-t border-gray-200"
            >
              <td className="text-center px-4 py-2">
                <input
                  type="number"
                  min={1}
                  className="w-16 text-center px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-indigo-500"
                />
              </td>
              <td className="px-4 py-2">
                <label htmlFor={service.name} className="cursor-pointer font-medium">
                  {service.name}
                </label>
              </td>
              <td className="px-4 py-2">{service.default_unit}</td>
              <td className="px-4 py-2 text-gray-600">{service.short_description}</td>
              <td className="px-4 py-2 text-right font-semibold ">
                {
                  service.promo_price && (
                    <>
                      <div className="line-through font-thin text-xs">
                        {Currency.formatVND(service.base_price)}
                      </div>
                      <div className="text-red-500 text-lg">
                        {Currency.formatVND(service.promo_price)}
                      </div>
                    </>
                  )
                }
                {
                  !service.promo_price && (
                    <div className="text-red-500 text-lg">
                      {Currency.formatVND(service.base_price)}
                    </div>
                  )
                }
              </td>


            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}