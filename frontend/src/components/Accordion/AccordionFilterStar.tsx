import { Accordion } from "radix-ui";
import { ChevronDownIcon, StarFilledIcon } from "@radix-ui/react-icons";

export default function AccordionFilterStar(){
    return (
        <div className="bg-secondary p-4 rounded">
        <Accordion.Root type="single" defaultValue="item-1" collapsible>
            <Accordion.Item value="item-1">
                <Accordion.Header>
                    <Accordion.Trigger className="group flex justify-between items-center font-medium gap-2">
                        Lọc theo số sao khách sạn
                        <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                    </Accordion.Trigger>
                </Accordion.Header>
                <Accordion.Content className="pt-2">
                    <div className="space-y-2">
                        <label className="flex items-center">
                            <input type="checkbox" className="mr-2" /> 5 <StarFilledIcon className="text-yellow-200" />
                        </label>
                        <label className="flex items-center">
                            <input type="checkbox" className="mr-2" /> 4 <StarFilledIcon className="text-yellow-200" />
                        </label>
                        <label className="flex items-center">
                            <input type="checkbox" className="mr-2" /> 3 <StarFilledIcon className="text-yellow-200" />
                        </label>
                        <label className="flex items-center">
                            <input type="checkbox" className="mr-2" /> 2 <StarFilledIcon className="text-yellow-200" />
                        </label>
                        <label className="flex items-center">
                            <input type="checkbox" className="mr-2" /> 1 <StarFilledIcon className="text-yellow-200" />
                        </label>
                    </div>
                </Accordion.Content>
            </Accordion.Item>
        </Accordion.Root>
    </div>
    )
}