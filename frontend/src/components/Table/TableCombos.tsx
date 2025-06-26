import { Currency } from "../../utils/Currency";
import { useState } from 'react';
import { Combo } from '../../types/ListHotelsTypes';

interface TableComboProps {
    combos: Combo[];
}

export default function TableCombos({ combos }: TableComboProps) {

    const [selectedCombo, setSelectedCombo] = useState<Combo | null>(null);

    return (
        <div className="overflow-x-auto">
        <table className="w-full table-auto border-collapse border border-black">
          <thead>
            <tr className="bg-blue-700 text-white">
              <th className="text-center px-4 py-2 border border-black w-12"></th>
              <th className="text-left px-4 py-2 border border-black w-1/3">Tên combo</th>
              <th className="text-left px-4 py-2 border border-black w-1/2">Dịch vụ</th>
              <th className="text-right px-4 py-2 border border-black w-1/6">Giá</th>
            </tr>
          </thead>
          <tbody>
            {combos?.map((data, index) => (
              <tr key={index} className="hover:bg-gray-100 border border-black">
                <td>
                  <div className="flex items-start justify-center h-full">
                    <input
                      type="radio"
                      id={String(data.id)}
                      value={data.name}
                      checked={selectedCombo?.name === data.name}
                      onClick={() => setSelectedCombo(data)}
                    />
                  </div>
                  
                </td>
                <td className="px-4 py-3 border border-black align-top">
                  <div className="font-semibold text-base">{data.name}</div>
                  <div className="text-sm text-gray-600">{data.short_description}</div>
                </td>
                <td className="px-4 py-3 border border-black align-top">
                  <ul className="list-disc list-inside space-y-1">
                      <li>
                        
                      </li>
                  </ul>
                </td>
                <td className="px-4 py-3 border border-black text-right align-top">
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