/* eslint-disable react-hooks/exhaustive-deps */
import { Tabs } from "@radix-ui/themes";
import TableCombos from "../Table/TableCombos";
import TableServices from "../Table/TableServices";
import { Combo, Service } from "../../types/DetailHotelTypes";
import { useNavigate, useParams } from "react-router-dom";
import { Currency } from "../../utils/Currency";
import { useEffect, useState } from "react";


interface TabServiceProps {
    combos: Combo[];
    services: Service[];
    onComboChange: (data: { combo_id: number; quantity: number }[]) => void;
    onServiceChange: (data: { hotel_service_id: number; quantity: number }[]) => void;
}

export default function TabService({ combos, services, onComboChange, onServiceChange, }: TabServiceProps) {
    const navigate = useNavigate();
    const { id } = useParams();

    const calculateTotalAll = () => {
        const totalRoom = localStorage.getItem('totalRoom');
        const selectedCombos = JSON.parse(localStorage.getItem('infoSelectedCombos') || '[]');
        const selectedServices = JSON.parse(localStorage.getItem('infoSelectedService') || '[]');

        const comboMap: Record<number, number> = {};
        const serviceMap: Record<number, number> = {};

        selectedCombos.forEach((item: { combo_id: number; quantity: number }) => {
            comboMap[item.combo_id] = item.quantity;
        });
        
        selectedServices.forEach((item: { hotel_service_id: number; quantity: number }) => {
            serviceMap[item.hotel_service_id] = item.quantity;
        });

        const comboTotal = combos.reduce((sum, combo) => {
            const qty = comboMap[combo.id] || 0;
            const price = combo.combo_price ? combo.combo_price : combo.original_price;
            return sum + price * qty;
        }, 0);

        localStorage.setItem('comboTotal', JSON.stringify(comboTotal))
        
        const serviceTotal = services.reduce((sum, service) => {
          const qty = serviceMap[service.id] || 0;
          const price = service.promo_price ? service.promo_price : service.base_price
          return sum + price * qty;
        }, 0);

        localStorage.setItem('serviceTotal', JSON.stringify(serviceTotal))

        const total = Number(totalRoom) + comboTotal + serviceTotal

        return total;
    }

    const [total, setTotal] = useState(0);

    useEffect(() => {
        setTotal(calculateTotalAll())
    }, [calculateTotalAll, combos, services])

    return (
        <Tabs.Root defaultValue="comboDichVu" orientation="horizontal" className="w-full space-y-4">
            <Tabs.List className="flex flex-wrap gap-2 border-b pb-2">
                <Tabs.Trigger
                    value="comboDichVu"
                    className="px-4 py-2 rounded-md font-medium transition-colors 
                 data-[state=active]:bg-blue-500 data-[state=active]:text-white 
                 data-[state=inactive]:bg-gray-100 data-[state=inactive]:text-gray-700 
                 hover:bg-blue-100"
                >
                    Combo dịch vụ
                </Tabs.Trigger>
                <Tabs.Trigger
                    value="dichVuRiengLe"
                    className="px-4 py-2 rounded-md font-medium transition-colors 
                 data-[state=active]:bg-blue-500 data-[state=active]:text-white 
                 data-[state=inactive]:bg-gray-100 data-[state=inactive]:text-gray-700 
                 hover:bg-blue-100"
                >
                    Dịch vụ riêng lẻ
                </Tabs.Trigger>
            </Tabs.List>

            <Tabs.Content value="comboDichVu">
                <div className="overflow-x-auto">
                    <TableCombos combos={combos ?? []} onChange={onComboChange} />
                </div>
                <div className="mt-4 flex">
                    <button
                        className="bg-blue-500 text-white px-2 rounded-sm text-lg"
                        onClick={() => navigate(`/thanh-toan/${id}`)}
                    >
                        Thanh toán
                    </button>
                    {
                        total && (
                            <p className="text-red-500 text-md ml-4">
                                Tổng tiền thanh toán: {Currency.formatVND(total)}
                            </p>
                        )
                    }
                </div>
            </Tabs.Content>

            <Tabs.Content value="dichVuRiengLe" className="mt-4 block">
                <div className="overflow-x-auto">
                    <TableServices data={services} onChange={onServiceChange} />
                </div>
                <div className="mt-4 flex">
                    <button
                        className="bg-blue-500 text-white px-2 rounded-sm text-lg"
                        onClick={() => navigate(`/thanh-toan/${id}`)}
                    >
                        Thanh toán
                    </button>
                    {
                        total && (
                            <p className="text-red-500 text-md ml-4">
                                Tổng tiền thanh toán: {Currency.formatVND(total)}
                            </p>
                        )
                    }
                </div>
            </Tabs.Content>
        </Tabs.Root>
    )
}