import { Accordion } from "radix-ui";
import { ChevronDownIcon } from "@radix-ui/react-icons";
import { popularAmenities } from "../../utils/PopularAmenStaticData";

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