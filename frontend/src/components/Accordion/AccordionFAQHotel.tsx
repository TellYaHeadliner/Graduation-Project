import * as Accordion from '@radix-ui/react-accordion';
import { ChevronDownIcon } from '@radix-ui/react-icons';

export default function AccordionFAQHotel() {
    return (
        <div className="rounded-lg border border-gray-700">
            <Accordion.Root type="single" collapsible className="w-full">
                <Accordion.Item value="item-1">
                    <Accordion.Header>
                        <Accordion.Trigger className="group flex justify-between w-full p-4 font-medium border-b border-gray-700">
                            Tôi có thể hủy phòng đã đặt như thế nào?
                            <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                        </Accordion.Trigger>
                    </Accordion.Header>
                    <Accordion.Content className="p-4 bg-gray-50 text-justify">
                        Roomix hỗ trợ hủy phòng tùy theo <strong>chính sách của khách sạn</strong>. Một số khách sạn cho phép hủy miễn phí trước 24h, trong khi số khác có thể tính phí. Vui lòng kiểm tra thông tin hủy phòng trước khi xác nhận đặt chỗ.
                    </Accordion.Content>
                </Accordion.Item>

                <Accordion.Item value="item-2">
                    <Accordion.Header>
                        <Accordion.Trigger className="group flex justify-between w-full p-4 font-medium border-b border-gray-700">
                            Tôi chưa xác minh email, có thể đặt phòng không?
                            <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                        </Accordion.Trigger>
                    </Accordion.Header>
                    <Accordion.Content className="p-4 bg-gray-50 text-justify">
                        Để đảm bảo an toàn và tránh giả mạo, Roomix yêu cầu người dùng xác minh email trước khi tiến hành đặt phòng. Bạn có thể kiểm tra email và nhấn vào liên kết xác minh, hoặc dùng chức năng <em>"Gửi lại email xác minh"</em> trong trang tài khoản.
                    </Accordion.Content>
                </Accordion.Item>

                <Accordion.Item value="item-3">
                    <Accordion.Header>
                        <Accordion.Trigger className="group flex justify-between w-full p-4 font-medium border-b border-gray-700">
                            Roomix hỗ trợ thanh toán qua hình thức nào?
                            <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                        </Accordion.Trigger>
                    </Accordion.Header>
                    <Accordion.Content className="p-4 bg-gray-50 text-justify">
                        Hiện tại, Roomix hỗ trợ thanh toán qua <strong>VNPAY QR</strong>, với khả năng quét mã từ các ứng dụng ngân hàng hoặc ví điện tử như Momo, ZaloPay. Trong tương lai sẽ mở rộng thêm nhiều cổng thanh toán khác.
                    </Accordion.Content>
                </Accordion.Item>

                <Accordion.Item value="item-5">
                    <Accordion.Header>
                        <Accordion.Trigger className="group flex justify-between w-full p-4 font-medium">
                            Tôi có thể liên hệ với khách sạn qua Roomix không?
                            <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
                        </Accordion.Trigger>
                    </Accordion.Header>
                    <Accordion.Content className="p-4 bg-gray-50 text-justify">
                        Có. Roomix tích hợp tính năng <strong>chat trực tiếp</strong> giữa khách hàng và chủ khách sạn sau khi đặt phòng thành công. Ngoài ra, bạn cũng có thể gửi tin nhắn từ trang đặt phòng nếu cần trao đổi sớm.
                    </Accordion.Content>
                </Accordion.Item>
            </Accordion.Root>
        </div>
    );
}
