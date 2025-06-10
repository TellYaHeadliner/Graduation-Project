 import { Tabs, CheckboxGroup, Checkbox } from "@radix-ui/themes";
import { combos, hotelServices } from "../../utils/HotelServicesStaticData";
import { useState } from "react";
import TableCombos from "../Table/TableCombos";

export default function TabService(){

    const [, setSelectedServices] = useState<string[]>([]);

    const toggleService = (service: string) => {
        setSelectedServices((prev) => prev.includes(service) ? prev.filter((item) => item !== service) : [...prev, service])
    }

    return (
        <Tabs.Root defaultValue="Combo-dich-vu">
            <Tabs.List>
                <Tabs.Trigger value="Combo-dich-vu">
                    Combo dịch vụ
                </Tabs.Trigger>
                <Tabs.Trigger value="Dich-vu-rieng-le">
                    Dịch vụ riêng lẻ
                </Tabs.Trigger>
            </Tabs.List>

            <Tabs.Content value="Combo-dich-vu" className="mt-2">
                <TableCombos datas={combos}/>
            </Tabs.Content>

            <Tabs.Content value="Dich-vu-rieng-le" className="mt-2">
                <CheckboxGroup.Root size="3">
                    <div className="grid grid-cols-4">
                    {hotelServices.map((service) => (
                        <CheckboxGroup.Item 
                        value={service} 
                        key={service} 
                        onClick={() => toggleService(service)}
                        >
                            {service}
                        </CheckboxGroup.Item>
                    ))}
                    </div>
                </CheckboxGroup.Root>
                <div className="mt-2 flex items-center gap-2 font-semibold">
                    <Checkbox />
                    Tôi chấp thuận việc sử dụng dịch vụ riêng lẻ thay cho combo 
                </div>
            </Tabs.Content>


        </Tabs.Root>
    )
}