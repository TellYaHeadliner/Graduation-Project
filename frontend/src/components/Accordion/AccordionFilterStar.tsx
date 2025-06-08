import { Accordion } from "radix-ui";
import { ChevronDownIcon, StarFilledIcon } from "@radix-ui/react-icons";
import { useState } from "react";

interface AccordionFilterStarProps {
    onFilterChange?: (selectedStars: number[]) => void;
    defaultSelected?: number[];
}

const starOptions = [
    {
        value: 5,
        label: "5 sao",
    },
    {
        value: 4,
        label: "4 sao",
    },
    {
        value: 3,
        label: "3 sao",
    },
    {
        value: 2,
        label: "2 sao",
    },
    {
        value: 1,
        label: "1 sao",
    },
]

export default function AccordionFilterStar({onFilterChange, defaultSelected = []}: AccordionFilterStarProps){
    const [selectedStars, setSelectedStars] = useState<number[]>(defaultSelected)

    const handleStarToggle = (starValue: number) => {
        const newSelection = selectedStars.includes(starValue) ? selectedStars.filter(star => star !== starValue) : [...selectedStars, starValue]

        setSelectedStars(newSelection)
        onFilterChange?.(newSelection)
    }

    return (
        <div className="p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200 text-black">
            <Accordion.Root type="single" defaultValue="item-1" collapsible>
                <Accordion.Item value="item-1">
                    <Accordion.Header>
                        <Accordion.Trigger className="group flex justify-between items-center font-medium gap-1">
                            Theo số sao khách sạn
                            <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                        </Accordion.Trigger>
                    </Accordion.Header>
                    <Accordion.Content className="pt-3 pb-1 overflow-hidden data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down">
                            {starOptions.map(({ value }) => (
                                <label key={value} className="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-md transition-colors duration-150 group">
                                    <input 
                                        type="checkbox" 
                                        checked={selectedStars.includes(value)} 
                                        onChange={() => handleStarToggle(value)}
                                        className="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 mr-1"
                                        aria-labelledby={`star-${value}-label`}
                                    />
                                    <span className="flex items-center text-sm text-gray-700 group-hover:text-gray-900 font-medium">
                                        {value}
                                        <StarFilledIcon
                                            className="w-3 h-3 text-yellow-400 mr-1"
                                        />
                                    </span>
                                </label>
                            ))}
                    </Accordion.Content>
                </Accordion.Item>
            </Accordion.Root>
        </div>
    )
}