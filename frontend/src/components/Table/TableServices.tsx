import { Table } from "@radix-ui/themes";
import { Currency } from "../../utils/Currency";
import { useState } from "react";
import { hotelServiceType } from "../../utils/HotelServicesStaticData";

interface TableServicesProps{
    data: hotelServiceType[];
}

export default function TableServices({ data }: TableServicesProps) {

    const [selected, setSelected] = useState<string[]>([]);
    const handleToggle = (name: string) => {
        const updated = selected.includes(name) ? selected.filter((n) => n !== name) : [...selected, name];

        setSelected(updated);
    }

    const isChecked = (name: string) => selected.includes(name);

    return (
      <div className="overflow-x-auto">
        <Table.Root className="min-w-full">
          <Table.Header>
            <Table.Row>
              <Table.ColumnHeaderCell className="w-12 text-center" />
              <Table.ColumnHeaderCell className="text-left">
                Tên dịch vụ
              </Table.ColumnHeaderCell>
              <Table.ColumnHeaderCell>
                Đơn vị tính
              </Table.ColumnHeaderCell>
              <Table.ColumnHeaderCell>
                Mô tả
              </Table.ColumnHeaderCell>
              <Table.ColumnHeaderCell className="text-right">
                Giá
              </Table.ColumnHeaderCell>
            </Table.Row>
          </Table.Header>
          <Table.Body>
            {data.map((hotelService, index) => (
              <Table.Row
                key={index}
                className="hover:bg-gray-50 transition-colors duration-150"
              >
                <Table.Cell className="text-center">
                  <input
                    onChange={() => handleToggle(hotelService.name)}
                    checked={isChecked(hotelService.name)}
                    type="checkbox"
                    name={hotelService.name}
                    id={hotelService.name}
                    className="w-4 h-4 accent-indigo-600 cursor-pointer"
                  />
                </Table.Cell>
                <Table.Cell className="text-left">
                  <label htmlFor={hotelService.name} className="cursor-pointer">
                    {hotelService.name}
                  </label>
                </Table.Cell>
                <Table.Cell className="text-right text-gray-700">
                  {hotelService.price === 0
                    ? "Miễn phí"
                    : Currency.formatVND(hotelService.price)}
                </Table.Cell>
              </Table.Row>
            ))}
          </Table.Body>
        </Table.Root>
      </div>
    );
  }