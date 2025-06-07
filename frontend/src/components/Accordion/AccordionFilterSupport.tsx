import { Accordion } from "radix-ui";
import { ChevronDownIcon} from "@radix-ui/react-icons";
import { useState } from "react";

interface FilterState{
    fullRefund: boolean;
    payAtHotel: boolean;
}

interface AccordionFilterSupportProps{
    onFilterChange? : (filters: FilterState) => void;
    defaultOpen?: boolean
}

export default function AccordionFilterSupport({ onFilterChange, defaultOpen = true}: AccordionFilterSupportProps){
    const [isOpen, setIsOpen] = useState<boolean>(defaultOpen)
    const [filters, setFilters] = useState<FilterState>({
        fullRefund: false,
        payAtHotel: false,
    })

    const handleFilterChange = (filterKey: string | number) => {
        const newFilters = {
            ...filters,
            [filterKey]: !filters[filterKey]
        };

        setFilters(newFilters);

        if (onFilterChange){
            onFilterChange(newFilters)
        }
    }

    const toggleAccordion = () => {
        setIsOpen(!isOpen)
    }

    return (
        <div className="p-4 rounded-lg border border-gray-200 hover:shadow-md transition-shadow duration-200 shadow-sm text-black">
            <Accordion.Root type="single" defaultValue="item-1" collapsible>
                <Accordion.Item value="item-1">
                    <Accordion.Header>
                        <Accordion.Trigger className="group flex justify-between items-center font-medium gap-2">
                            Hỗ trợ linh hoạt
                            <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                        </Accordion.Trigger>
                    </Accordion.Header>
                    <Accordion.Content className="pt-2">
                        <div className="space-y-2">
                            <label className="flex items-center">
                                <input type="checkbox" className="mr-2" checked={filters.fullRefund} onChange={() => handleFilterChange('fullRefund')} /> Hỗ trợ hoàn tiền 100%
                            </label>
                            <label className="flex items-center">
                                <input type="checkbox" className="mr-2" /> Thanh toán tại khách sạn
                            </label>
                        </div>
                    </Accordion.Content>
                </Accordion.Item>
            </Accordion.Root>
        </div>
    )
}