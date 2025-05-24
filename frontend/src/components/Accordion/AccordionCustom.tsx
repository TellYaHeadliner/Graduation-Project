import * as Accordion from '@radix-ui/react-accordion';
import { ChevronDownIcon } from '@radix-ui/react-icons';

export default function AccordionCustom() {
  return (
    <Accordion.Root type="single" collapsible className="w-full bg-background">
      <Accordion.Item value="item-1">
        <Accordion.Header>
          <Accordion.Trigger className="group flex justify-between w-full p-4 font-medium">
            Về chúng tôi
            <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
          </Accordion.Trigger>
        </Accordion.Header>
        <Accordion.Content className='p-4 bg-gray-50 text-justify'>
          Roomix là trang web đặt phòng khách sạn thông minh, giúp người dùng dễ dàng tìm kiếm, so sánh và đặt phòng tại hàng nghìn khách sạn uy tín trên khắp cả nước. Với giao diện thân thiện, Roomix cho phép bạn lọc theo vị trí, giá cả, tiện nghi và đánh giá từ khách hàng để lựa chọn nơi lưu trú phù hợp nhất. Ngoài ra, hệ thống tích hợp các phương thức thanh toán linh hoạt và chương trình tích điểm hấp dẫn, mang lại trải nghiệm tiện lợi và đáng tin cậy cho mọi chuyến đi.
          <br />
          <a href="#" className='underline unline-offset-1'>
            Xem thêm chi tiết
          </a>
        </Accordion.Content>
      </Accordion.Item>
      <Accordion.Item value="item-2">
        <Accordion.Header>
          <Accordion.Trigger className="group flex justify-between w-full p-4 font-medium">
            Chính sách hoàn tiền
            <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
          </Accordion.Trigger>
        </Accordion.Header>
        <Accordion.Content className='p-4 bg-gray-50 text-justify'>
          Chính sách hoàn tiền của Roomix được thiết kế để đảm bảo quyền lợi tối đa cho khách hàng. Nếu bạn hủy phòng theo đúng thời gian quy định của khách sạn, Roomix cam kết hoàn lại toàn bộ hoặc một phần số tiền đã thanh toán, tùy theo điều kiện cụ thể của từng phòng. Quá trình hoàn tiền minh bạch, nhanh chóng và hỗ trợ tận tình từ đội ngũ chăm sóc khách hàng giúp bạn an tâm khi đặt phòng qua Roomix.
          <br />
          <a href="#" className='underline unline-offset-1'>
            Xem thêm chi tiết
          </a>
        </Accordion.Content>
      </Accordion.Item>
      <Accordion.Item value="item-3">
        <Accordion.Header>
          <Accordion.Trigger className="group flex justify-between w-full p-4 font-medium">
            Hỗ trợ
            <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
          </Accordion.Trigger>
        </Accordion.Header>
        <Accordion.Content className='p-4 bg-gray-50 text-justify'>
          <a href="#" className='underline unline-offset-1'>
            Gửi ticket hỗ trợ
          </a>
          <br />
          <a href="#" className='underline unline-offset-1'>
            Chăm sóc khách hàng
          </a>
          <br/>
          <a href="#" className='underline unline-offset-1'>
            Giải quyết khiếu nại
          </a>
        </Accordion.Content>
      </Accordion.Item>
      <Accordion.Item value="item-4">
        <Accordion.Header>
          <Accordion.Trigger className="group flex justify-between w-full p-4 font-medium">
            FAQ (Câu hỏi thường xuyên)
            <ChevronDownIcon className="transition-transform duration-200 group-data-[state=open]:rotate-180" />
          </Accordion.Trigger>
        </Accordion.Header>
        <Accordion.Content className='p-4 bg-gray-50 text-justify'>
          Vui lòng xem chi tiết câu hỏi thường gặp ở phía dưới
          <br/>
          <a href="#" className='underline unline-offset-1'>
            Xem chi tiết
          </a>
        </Accordion.Content>
      </Accordion.Item>
    </Accordion.Root>
  );
}
