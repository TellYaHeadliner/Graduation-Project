/* eslint-disable @typescript-eslint/consistent-indexed-object-style */
import { Currency } from "../../utils/Currency";
import { Combo } from '../../types/DetailHotelTypes';
import { useState } from "react";

interface TableComboProps {
  combos: Combo[];
  onChange: (data: { combo_id: number; quantity: number }[]) => void;
}

export default function TableCombos({ combos, onChange }: TableComboProps) {
  const [selectedCombos, setSelectedCombos] = useState<({ [key: number]: number })> ({});

  const handleQuantityChange = (comboId: number, quantity: number) => {
    const updated = { ...selectedCombos, [comboId]: quantity};
    setSelectedCombos(updated);
    
    const formatted = Object.entries(updated)
    .filter(([_, qty]) => qty > 0)
    .map(([id, qty]) => {
      const combo = combos.find(c => c.id === Number(id));
      return {
        combo_id: Number(id),
        quantity: qty,
        name: combo?.name || ""
      };
    });

    localStorage.setItem('infoSelectedCombos', JSON.stringify(formatted));
    onChange(formatted)
  }

  const getQuantity = () => {
    const stored = localStorage.getItem('infoSelectedCombos')
    if (stored){
      const quantities = JSON.parse(localStorage.getItem('infoSelectedCombos') || '[]')
            .map((item: { combo_id: number; quantity: number }) => item.quantity);
      return quantities;
    }
    return 0;
  }



  return (
    <div className="overflow-x-auto">
      <table className="w-full table-auto border-collapse border border-gray-300">
        <thead>
          <tr className="bg-blue-700 text-white">
            <th className="text-center px-6 py-2 border border-gray-300 w-20 ">Số lượng</th>
            <th className="text-left px-4 py-2 border border-gray-300 w-1/3">Tên combo</th>
            <th className="text-left px-4 py-2 border border-gray-300 w-1/2">Dịch vụ</th>
            <th className="text-right px-4 py-2 border border-gray-300 w-1/6">Giá</th>
          </tr>
        </thead>
        <tbody>
          {combos?.map((data, index) => (
            <tr key={index} className="hover:bg-gray-100 border border-gray-300">
              <td className="px-4 py-3 border border-gray-300">
                <div className="flex items-start justify-center h-full">
                  {data.services.map((service) => {  
                    return (
                      <input
                        key={`input-${data.id}-${service.id}`}
                        type="number"
                        min={0}
                        max={data.services[0].quantity ?? 0}
                        value={getQuantity()}
                        onChange={(e) => {
                          handleQuantityChange(data.id, Number(e.target.value)
                        )}}
                        className="w-16 text-center px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-indigo-500"
                      />
                    );
                  })}
                </div>
              </td>
              <td className="px-4 border border-gray-300">
                <div className="font-semibold text-base">{data.name}</div>
                <div className="text-sm text-gray-600">{data.short_description}</div>
              </td>
              <td className="px-4 border border-gray-300">
                <ul className="list-disc list-inside space-y-1">
                  {data.services.map((service) => (
                    <li key={`service-${data.id}-${service.id}`}>{service.name}</li>
                  ))}
                </ul>
              </td>
              <td className="px-4 py-3 border border-gray-300 text-right">
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