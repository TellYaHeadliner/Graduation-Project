import { Accordion } from "radix-ui";
import { ChevronDownIcon } from "@radix-ui/react-icons";

export default function AccordionFilterRate() {
    return (
        <div className="p-4 rounded-lg border text-black">
            <Accordion.Root type="single" defaultValue="item-1" collapsible>
                <Accordion.Item value="item-1">
                    <Accordion.Header>
                        <Accordion.Trigger className="group flex justify-between items-center font-medium gap-2">
                            Lọc theo điểm đánh giá
                            <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                        </Accordion.Trigger>
                    </Accordion.Header>
                    <Accordion.Content className="pt-2">
                        <div className="space-y-2">
                            <label className="block">
                                <input type="checkbox" className="mr-2" /> Từ 8 điểm trở lên
                            </label>
                            <label className="block">
                                <input type="checkbox" className="mr-2" /> Từ 6 điểm trở lên
                            </label>
                            <label className="block">
                                <input type="checkbox" className="mr-2" /> Từ 4 sao trở lên
                            </label>
                        </div>
                    </Accordion.Content>
                </Accordion.Item>
            </Accordion.Root>
        </div>
    );
}