import { Currency } from "../../utils/Currency";
import { Combo } from '../../types/DetailHotelTypes';
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { quantitySchemas } from "../../schemas/quantitySchemas";


interface TableComboProps {
  combos: Combo[];
}

export default function TableCombos({ combos }: TableComboProps) {
  const {
    register
  } = useForm<quantitySchemas>({
    resolver: zodResolver(quantitySchemas),
    defaultValues: {
      quantity: 0,
    },
  });

  return (
    <div className="overflow-x-auto">
      <table className="w-full table-auto border-collapse border border-black">
        <thead>
          <tr className="bg-blue-700 text-white">
            <th className="text-center px-6 py-2 border border-black w-20 ">Số lượng</th>
            <th className="text-left px-4 py-2 border border-black w-1/3">Tên combo</th>
            <th className="text-left px-4 py-2 border border-black w-1/2">Dịch vụ</th>
            <th className="text-right px-4 py-2 border border-black w-1/6">Giá</th>
          </tr>
        </thead>
        <tbody>
          {combos?.map((data, index) => (
            <tr key={index} className="hover:bg-gray-100 border border-black">
              <td className="px-4 py-3 border border-black">
                <div className="flex items-start justify-center h-full">
                  {data.services.map((service) => (
                    <input
                      key={`input-${data.id}-${service.id}`}
                      type="number"
                      id={String(data.id)}
                      value={service.quantity}
                      {...register("quantity")}
                      className="w-15"
                      min={1}
                      max={service.quantity}
                    />
                  ))}
                </div>
              </td>
              <td className="px-4 border border-black">
                <div className="font-semibold text-base">{data.name}</div>
                <div className="text-sm text-gray-600">{data.short_description}</div>
              </td>
              <td className="px-4 border border-black">
                <ul className="list-disc list-inside space-y-1">
                  {data.services.map((service) => (
                    <li key={`service-${data.id}-${service.id}`}>{service.name}</li>
                  ))}
                </ul>
              </td>
              <td className="px-4 py-3 border border-black text-right">
                <div className="text-sm text-gray-500 line-through">
                  {Currency.formatVND(data.original_price)}
                </div>
                <div className="text-red-600 font-bold text-base">
                  {Currency.formatVND(data.combo_price)}
                </div>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  )
}