import * as Accordion from '@radix-ui/react-accordion';
import { ChevronDownIcon } from '@radix-ui/react-icons';


export default function AccordionFAQHotel() {
    return (
        <div className="rounded-lg border border-gray-700">
             <Accordion.Root type="single" collapsible className="w-full">
            <Accordion.Item value="item-1">
                <Accordion.Header>
                    <Accordion.Trigger className="group flex justify-between w-full p-4 font-medium border-b border-gray-700">
                        Những tiện ích của khách sạn có là gì ?
                        <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                    </Accordion.Trigger>
                </Accordion.Header>
                <Accordion.Content className='p-4 bg-gray-50 text-justify'>
                    Những tiện ích tại Khách sạn Melia Vinpearl Riverfront Đà Nẵng bao gồm Máy lạnh, Nhà hàng, Hồ bơi, Lễ tân 24h, Chỗ đậu xe, Thang máy, WiFi. (một số dịch vụ sẽ yêu cầu trả thêm phí):
                </Accordion.Content>
            </Accordion.Item>
            <Accordion.Item value="item-2">
                <Accordion.Header>
                    <Accordion.Trigger className="group flex justify-between w-full p-4 font-medium border-b border-gray-700">
                        Mức giá dao động của khách sạn
                        <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                    </Accordion.Trigger>
                </Accordion.Header>
                <Accordion.Content className='p-4 bg-gray-50 text-justify'>
                    Phòng tại Khách sạn Melia Vinpearl Riverfront Đà Nẵng có giá từ 2.375.209 VND. Hãy ghé thăm trang khuyến mãi khách sạn để có cơ hội nhận thêm nhiều ưu đãi
                </Accordion.Content>
            </Accordion.Item>
            <Accordion.Item value="item-3">
                <Accordion.Header>
                    <Accordion.Trigger className="group flex justify-between w-full p-4 font-medium border-b border-gray-700">
                        Thời gian nhận phòng và trả phòng
                        <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                    </Accordion.Trigger>
                </Accordion.Header>
                <Accordion.Content className='p-4 bg-gray-50 text-justify'>
                    Thời gian nhận phòng tại Khách sạn Melia Vinpearl Riverfront Đà Nẵng là từ Từ 14:00 và trả phòng trước Trước 12:00
                </Accordion.Content>
            </Accordion.Item>
            <Accordion.Item value="item-4">
                <Accordion.Header>
                    <Accordion.Trigger className="group flex justify-between w-full p-4 font-medium">
                        Khách sạn có phục vụ ăn sáng không ?
                        <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                    </Accordion.Trigger>
                </Accordion.Header>
                <Accordion.Content className='p-4 bg-gray-50 text-justify'>
                    Vui lòng xem chi tiết câu hỏi thường gặp ở phía dưới
                </Accordion.Content>
            </Accordion.Item>
        </Accordion.Root>
        </div>
    );
}