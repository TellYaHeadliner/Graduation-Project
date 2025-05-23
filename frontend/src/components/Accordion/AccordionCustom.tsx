import * as Accordion from '@radix-ui/react-accordion';
import { ChevronDownIcon } from '@radix-ui/react-icons';

export default function AccordionCustom() {
  return (
    <Accordion.Root type="single" collapsible>
      <Accordion.Item value="item-1">
        <Accordion.Header>
          <Accordion.Trigger className="group flex justify-between w-full p-4 font-medium">
            Mục 1
            <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
          </Accordion.Trigger>
        </Accordion.Header>
        <Accordion.Content className="p-4 bg-gray-100">
          Đây là nội dung mục 1.
        </Accordion.Content>
      </Accordion.Item>
    </Accordion.Root>
  );
}
