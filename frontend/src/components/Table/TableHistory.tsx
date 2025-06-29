// components/HotelTable.tsx
import { useState } from "react";

interface Hotel {
  id: number;
  name: string;
  address: string;
  status: "Hoạt động" | "Tạm dừng";
};

const sampleHotels: Hotel[] = [
  { id: 1, name: "Khách sạn Mặt Trời", address: "123 Đường Lê Lợi, Q1", status: "Hoạt động" },
  { id: 2, name: "Khách sạn Biển Xanh", address: "456 Trần Phú, Nha Trang", status: "Tạm dừng" },
];

export default function TableHistory() {
  const [selectedIds, setSelectedIds] = useState<number[]>([]);

  const toggleSelect = (id: number) => {
    setSelectedIds((prev) =>
      prev.includes(id) ? prev.filter((item) => item !== id) : [...prev, id]
    );
  };

  const handleDelete = (id: number) => {
    alert(`Hủy khách sạn ID ${id}`);
    
  };

  return (
    <div className="overflow-x-auto border rounded-xl mx-auto">
      <table typeof="1" className="w-6xl table-auto text-sm text-left border border-gray-300">
        <thead className="bg-blue-700 text-white">
          <tr>
            <th className="p-3">
              <input
                type="checkbox"
                checked={selectedIds.length === sampleHotels.length}
                onChange={(e) => {
                  setSelectedIds(e.target.checked ? sampleHotels.map(h => h.id) : []);
                }}
              />
            </th>
            <th className="p-3">Tên khách sạn</th>
            <th className="p-3">Địa chỉ</th>
            <th className="p-3">Trạng thái</th>
            <th className="p-3 text-center">Hủy</th>
          </tr>
        </thead>
        <tbody>
          {sampleHotels.map((hotel) => (
            <tr key={hotel.id} className="border-t hover:bg-gray-50">
              <td className="p-3">
                <input
                  type="checkbox"
                  checked={selectedIds.includes(hotel.id)}
                  onChange={() => toggleSelect(hotel.id)}
                />
              </td>
              <td className="p-3 font-medium text-gray-500">{hotel.name}</td>
              <td className="p-3 text-gray-500">{hotel.address}</td>
              <td className="p-3 text-gray-500">
                <span
                  className={`px-2 py-1 rounded text-xs font-semibold ${
                    hotel.status === "Hoạt động"
                      ? "bg-green-100 text-green-800"
                      : "bg-yellow-100 text-yellow-800"
                  }`}
                >
                  {hotel.status}
                </span>
              </td>
              <td className="p-3 text-center">
                <button
                  onClick={() => handleDelete(hotel.id)}
                  className="text-red-600 hover:underline"
                >
                  Hủy đặt phòng
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
