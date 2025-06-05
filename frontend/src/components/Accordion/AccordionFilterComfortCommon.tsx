import { Accordion } from "radix-ui";
import { ChevronDownIcon } from "@radix-ui/react-icons";

const popularAmenities = [
    "Wi-Fi miễn phí",
    "Điều hòa không khí / Máy sưởi",
    "TV màn hình phẳng",
    "Tủ lạnh mini",
    "Máy sấy tóc",
    "Bàn làm việc",
    "Két an toàn",
    "Ấm đun nước / Dụng cụ pha trà cà phê",
    "Lễ tân 24/7",
    "Dọn phòng hàng ngày",
    "Bữa sáng miễn phí",
    "Dịch vụ giặt ủi",
    "Dịch vụ đưa đón sân bay",
    "Chỗ đậu xe (miễn phí hoặc có tính phí)",
    "Hồ bơi",
    "Phòng gym / thể hình",
    "Spa / Massage",
    "Nhà hàng / Quầy bar",
    "Phòng họp / hội nghị"
];

interface AFCCProps{
    title: string;
}

export default function AccordiionFilterComfortCommon({ title }: AFCCProps){
    return (
        <div className="p-4 rounded-lg border text-black">
        <Accordion.Root type="single" defaultValue="item-1" collapsible>
            <Accordion.Item value="item-1">
                <Accordion.Header>
                    <Accordion.Trigger className="group flex justify-between items-center font-medium gap-2">
                        {title }
                        <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                    </Accordion.Trigger>
                </Accordion.Header>
                <Accordion.Content className="pt-2">
                    <div className="space-y-2">
                        { popularAmenities.map((popular, index) => (
                            <label key={index} htmlFor={popular} className="flex-items center block">
                                <input type="checkbox" name={popular} id={popular} className="mr-2" /> {popular}
                            </label>
                        ))}
                    </div>
                </Accordion.Content>
            </Accordion.Item>
        </Accordion.Root>
    </div>
    )
}