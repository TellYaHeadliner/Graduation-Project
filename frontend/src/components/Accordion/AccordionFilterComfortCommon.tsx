import { Accordion } from "radix-ui";
import { ChevronDownIcon } from "@radix-ui/react-icons";
import { Amentity } from "../../types/AmentityTypes";
import { useFilter } from "../../context/FilterContext";

interface AFCCProps{
    title: string;
    children: Amentity[];
}

export default function AccordiionFilterComfortCommon({ title, children }: AFCCProps){
    const { filter, updateAmentities } = useFilter();

    const handleToggle = (id: number) => {
        const isSelected = filter.amentityIds.includes(id);
        const newIds = isSelected ? filter.amentityIds.filter(item => item !== id) : [...filter.amentityIds, id];

        updateAmentities(newIds)
    }

    return (
        <div className="p-4 rounded-lg border border-gray-200 text-black">
        <Accordion.Root type="single" defaultValue="item-1" collapsible>
            <Accordion.Item value="item-1">
                <Accordion.Header>
                    <Accordion.Trigger className="group flex justify-between items-center font-medium gap-2">
                        { title }
                        <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                    </Accordion.Trigger>
                </Accordion.Header>
                <Accordion.Content className="pt-2">
                    <div className="space-y-2">
                        { children.map((amentity, index) => (
                            <label key={index} htmlFor={amentity.name} className="flex-items center block">
                                <input 
                                    type="checkbox" 
                                    name={amentity.name} 
                                    id={amentity.name} 
                                    className="mr-2" 
                                    checked={filter.amentityIds.includes(amentity.id)}
                                    onChange={() => handleToggle(amentity.id)}
                                    /> 
                                <span>{amentity.name}</span>
                            </label>
                        ))}
                    </div>
                </Accordion.Content>
            </Accordion.Item>
        </Accordion.Root>
    </div>
    )
}