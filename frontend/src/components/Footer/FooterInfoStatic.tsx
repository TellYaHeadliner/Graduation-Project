export default function FooterInfoStatic() {
    return (
        <div className="w-full flex flex-row justify-around text-left p-4 text-sm bg-gray-50">
            <div className="col">
                <h3 className="font-medium mb-1">
                    Về chúng tôi
                </h3>
                <div className="sm:w-40 text-justify">
                    <span className="text-normal">
                        Roomix là trang web đặt phòng khách sạn thông minh, giúp người dùng dễ dàng tìm kiếm, so sánh và đặt phòng tại hàng nghìn khách sạn uy tín trên khắp cả nước. Với giao diện thân thiện, Roomix cho phép bạn lọc theo vị trí, giá cả, tiện nghi và đánh giá từ khách hàng để lựa chọn nơi lưu trú phù hợp nhất. Ngoài ra, hệ thống tích hợp các phương thức thanh toán linh hoạt và chương trình tích điểm hấp dẫn, mang lại trải nghiệm tiện lợi và đáng tin cậy cho mọi chuyến đi.
                    </span>
                    <br />
                    <a href="">
                        <span className="underline">
                            Xem thêm
                        </span>
                    </a>
                </div>
            </div>
            <div className="sm:w-40 text-justify ml-4">
                <h3 className="font-medium mb-1">
                    Chính sách hoàn tiền
                </h3>
                <span className="text-normal">
                    Roomix là trang web đặt phòng khách sạn thông minh, giúp người dùng dễ dàng tìm kiếm, so sánh và đặt phòng tại hàng nghìn khách sạn uy tín trên khắp cả nước. Với giao diện thân thiện, Roomix cho phép bạn lọc theo vị trí, giá cả, tiện nghi và đánh giá từ khách hàng để lựa chọn nơi lưu trú phù hợp nhất. Ngoài ra, hệ thống tích hợp các phương thức thanh toán linh hoạt và chương trình tích điểm hấp dẫn, mang lại trải nghiệm tiện lợi và đáng tin cậy cho mọi chuyến đi.
                </span>
                <br/>
                <a href="">
                    <span className="underline">
                        Xem thêm
                    </span>
                </a>
            </div>
            <div className="sm:w-40 ml-4">
                <h3 className="font-medium mb-1">
                    Hỗ trợ
                </h3>
                <ul>
                    <li className="mb-1">
                        <a href="/TicketHoTro">
                            <span className="underline">
                                Gửi ticket hỗ trợ
                            </span>
                        </a>
                    </li>
                    <li className="mb-1">
                        <a href="">
                            <span className="underline">
                                Chăm sóc khách hàng
                            </span>
                        </a>
                    </li>
                    <li className="mb-1">
                        <a href="">
                            <span className="underline">
                                Giải quyết khiếu nại
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div className="sm:w-40 ml-4">
                <h3 className="font-medium mb-1">
                    FAQ (Câu hỏi thường xuyên)
                </h3>
                <ul>
                    <li className="mb-1">
                        <a href="/FAQ">
                            <span className="underline">
                                Chi tiết câu hỏi
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    );
}