import { CombosType } from '../../utils/HotelServicesStaticData';
import { Radio } from '@radix-ui/themes';
import { Currency } from "../../utils/Currency";
import { useState } from 'react';

interface TableComboProps {
    datas: CombosType[];
}

export default function TableCombos({ datas }: TableComboProps) {

    const [selectedCombo, setSelectedCombo] = useState<CombosType | null>(null);

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
            {datas.map((data, index) => (
              <tr key={index} className="hover:bg-gray-100">
                <td className="text-center py-3 border border-black align-top">
                  <Radio
                    value="2"
                    checked={selectedCombo?.tenCombo === data.tenCombo}
                    onChange={(checked) => {
                      if (checked) setSelectedCombo(data);
                    }}
                  />
                </td>
                <td className="px-4 py-3 border border-black align-top">
                  <div className="font-semibold text-base">{data.tenCombo}</div>
                  <div className="text-sm text-gray-600">{data.moTa}</div>
                </td>
                <td className="px-4 py-3 border border-black align-top">
                  <ul className="list-disc list-inside space-y-1">
                    {data.dichVu.map((dataDichVu, i) => (
                      <li key={i}>
                        {dataDichVu.ten} / {dataDichVu.soLuong}
                      </li>
                    ))}
                  </ul>
                </td>
                <td className="px-4 py-3 border border-black text-right align-top">
                  <div className="text-sm text-gray-500 line-through">
                    {Currency.formatVND(data.giaGoc)}
                  </div>
                  <div className="text-red-600 font-bold text-base">
                    {Currency.formatVND(data.giaCombo)}
                  </div>
                  <div className="text-yellow-300 font-bold text-xl">
                    {data.uuDai}%
                  </div>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    )
}