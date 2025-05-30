import { Tabs } from "@radix-ui/themes"


export default function LocationTab() {
    return (
        <div className="mx-auto lg:px-18">
            <h2 className="text-2xl font-bold mb-6">
                Các địa điểm du lịch phổ biến ở Việt Nam
            </h2>
            <Tabs.Root defaultValue="1" className="">
                <Tabs.List>
                    <Tabs.Trigger value="1">Các tỉnh thành phố</Tabs.Trigger>
                    <Tabs.Trigger value="2">Các khách sạn gần nơi bạn du lịch</Tabs.Trigger>
                    <Tabs.Trigger value="3">Những khách sạn bạn muốn</Tabs.Trigger>
                </Tabs.List>

                <Tabs.Content value="1" className="my-6 gap-x-6"> 
                    <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-y-4 gap-x-6 text-gray-800">
                        {[
                            "An Giang", "Bà Rịa - Vũng Tàu", "Bạc Liêu", "Bắc Giang", "Bắc Kạn",
                            "Bắc Ninh", "Bến Tre", "Bình Dương", "Bình Định", "Bình Phước",
                            "Bình Thuận", "Cà Mau", "Cao Bằng", "Cần Thơ", "Đà Nẵng",
                            "Đắk Lắk", "Đắk Nông", "Điện Biên", "Đồng Nai", "Đồng Tháp",
                            "Gia Lai", "Hà Giang", "Hà Nam", "Hà Nội", "Hà Tĩnh",
                            "Hải Dương", "Hải Phòng", "Hậu Giang", "Hòa Bình", "Hưng Yên",
                            "TP. Hồ Chí Minh", "Khánh Hòa", "Kiên Giang", "Kon Tum", "Lai Châu",
                            "Lạng Sơn", "Lào Cai", "Lâm Đồng", "Long An", "Nam Định",
                            "Nghệ An", "Ninh Bình", "Ninh Thuận", "Phú Thọ", "Phú Yên",
                            "Quảng Bình", "Quảng Nam", "Quảng Ngãi", "Quảng Ninh", "Quảng Trị",
                            "Sóc Trăng", "Sơn La", "Tây Ninh", "Thái Bình", "Thái Nguyên",
                            "Thanh Hóa", "Thừa Thiên Huế", "Tiền Giang", "Trà Vinh", "Tuyên Quang",
                            "Vĩnh Long", "Vĩnh Phúc", "Yên Bái"
                        ].map((province) => (
                            <a key={province} href="#" className="hover:underline text-sm">
                                {province}
                            </a>
                        ))}
                    </div>
                </Tabs.Content>

                <Tabs.Content value="2" className="my-6 gap-x-6">
                    <div className="grid grid-cols-3 text-gray-800">
                        <div className="grid gap-y-3">
                            <h3 className="text-md font-bold">
                                Miền Nam
                            </h3>
                            <a href="#" className="hover:underline">
                                TP Hồ Chí Minh
                            </a>
                            <a href="" className="hover:underline">
                                Lâm Đồng
                            </a>
                            <a href="" className="hover:underline">
                                Kiên Giang
                            </a>
                            <a href="" className="hover:underline">
                                Cần Thơ
                            </a>
                        </div>
                        <div className="grid gap-y-3">
                            <h3 className="text-md font-bold">
                                Miền Trung
                            </h3>
                            <a href="" className="hover:underline">
                                Huế
                            </a>
                            <a href="" className="hover:underline">
                                Đà Nẵng
                            </a>
                            <a href="" className="hover:underline">
                                Hội An (Quảng Nam)
                            </a>
                            <a href="" className="hover:underline">
                                Phú Yên - Bình Định
                            </a>
                        </div>
                        <div className="grid gap-y-3">
                            <h3 className="text-md font-bold">
                                Miền Bắc
                            </h3>
                            <a href="" className="hover:underline">
                                Hà Nội
                            </a>
                            <a href="" className="hover:underline">
                                Hạ Long (Quảng Ninh)
                            </a>
                            <a href="" className="hover:underline">
                                Sapa (Lào Cai)
                            </a>
                            <a href="" className="hover:underline">
                                Ninh Bình
                            </a>
                        </div>
                    </div>
                </Tabs.Content>

                <Tabs.Content value="3" className="my-6 gap-x-6">
                <div className="grid grid-cols-5 not-even:lg:grid-cols-5 xl:grid-cols-6 gap-y-4 gap-x-6 text-gray-800">
                        {[
                            "Phòng nghỉ tiện nghi", "Dịch vụ dọn phòng hàng ngày", "Dịch vụ giặt là", "Nhà hàng trong khách sạn", "Buffet sáng miễn phí", "Phục vụ đồ ăn tại phòng ", "Quán cà phê hoặc quầy bar", "Spa & massage", "Phòng xông hơi/ Phòng tắm hơi", "Hồ bơi", "Phòng gym", "Bãi đỗ xe miễn phí", "Dịch vụ đưa đón sân bay", "Cho thuê xe máy/ ô tô", "Hỗ trợ đặt taxi, vé máy bay, vé xe", "Phòng gia đình", "Giường phụ, cũi trẻ em", "Khu vui chơi trẻ em", "Cho phép mang thú cưng", "Dịch vụ trông trẻ"
                        ].map((province) => (
                            <a key={province} href="#" className="hover:underline text-sm">
                                {province}
                            </a>
                        ))}
                    </div>
                </Tabs.Content>
            </Tabs.Root>
        </div>
    )
}