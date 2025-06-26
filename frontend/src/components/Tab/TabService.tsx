import { Tabs } from "@radix-ui/themes";
import { combos, hotelServices } from "../../utils/HotelServicesStaticData";
import { useState } from "react";
import TableCombos from "../Table/TableCombos";
import TableServices from "../Table/TableServices";
import { Combo } from "../../types/ListHotelsTypes";

interface TabServiceProps{
    combos: Combo[];
}

export default function TabService({ combos }: TabServiceProps) {

    const [selectedService, setSelectedServices] = useState<string[]>([]);

    const toggleService = (service: string) => {
        setSelectedServices((prev) => prev.includes(service) ? prev.filter((item) => item !== service) : [...prev, service])
    }

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
                    <TableCombos combos={combos ?? []} />
                </div>  
                <div className="mt-4">
                    <button className="bg-blue-500 text-white px-2 rounded-sm text-lg">
                        Thanh toán
                    </button>
                </div>
            </Tabs.Content>

            <Tabs.Content value="dichVuRiengLe" className="mt-4 block">
               <div className="overflow-x-auto">
                    <TableServices data={hotelServices}/>
               </div>
               <div className="mt-4">
                    <button className="bg-blue-500 text-white px-2 rounded-sm text-lg">
                        Thanh toán
                    </button>
               </div>
            </Tabs.Content>
        </Tabs.Root>
    )
}