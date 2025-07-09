import { Tabs } from "@radix-ui/themes"


export default function LocationTab() {
    return (
        <div className="mx-auto lg:px-18 2xl:px-20 my-10">
            <h2 className="text-2xl font-bold mb-6">
                Các địa điểm du lịch phổ biến ở Việt Nam
            </h2>
            <Tabs.Root defaultValue="1" className="">
                <Tabs.List>
                    <Tabs.Trigger value="1" className="px-4 py-2 text-sm font-medium text-gray-600 data-[state=active]:border-b-2 data-[state=active]:border-blue-500 data-[state=active]:text-blue-600 focus:outline-none hover:text-blue-500 transition-all duration-300">Các tỉnh thành phố</Tabs.Trigger>
                    <Tabs.Trigger value="2" className="px-4 py-2 text-sm font-medium text-gray-600 data-[state=active]:border-b-2 data-[state=active]:border-blue-500 data-[state=active]:text-blue-600 focus:outline-none hover:text-blue-500 transition-all duration-300">Các khách sạn gần nơi bạn du lịch</Tabs.Trigger>
                </Tabs.List>

                <Tabs.Content value="1" className="my-6 gap-x-6 bg-white rounded-lg p-4 shadow-sm data-[state=inactive]:opacity-0 data-[state=inactive]:pointer-events-none"> 
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
                            <a key={province} href={province} className="hover:underline text-sm">
                                {province}
                            </a>
                        ))}
                    </div>
                </Tabs.Content>

                <Tabs.Content value="2" className="my-6 gap-x-6 bg-white rounded-lg p-4 shadow-sm transition-all duration-300">
                    <div className="grid grid-cols-3 text-gray-800">
                        <div className="grid gap-y-3">
                            <h3 className="text-md font-bold">
                                Miền Nam
                            </h3>
                            <a href="/Hồ Chí Minh" className="hover:underline">
                                TP Hồ Chí Minh
                            </a>
                            <a href="/Lâm Đồng" className="hover:underline">
                                Lâm Đồng
                            </a>
                            <a href="/Kiên Giang" className="hover:underline">
                                Kiên Giang
                            </a>
                            <a href="/Cần Thơ" className="hover:underline">
                                Cần Thơ
                            </a>
                        </div>
                        <div className="grid gap-y-3">
                            <h3 className="text-md font-bold">
                                Miền Trung
                            </h3>
                            <a href="/Huế" className="hover:underline">
                                Huế
                            </a>
                            <a href="/Đà Nẵng" className="hover:underline">
                                Đà Nẵng
                            </a>
                            <a href="/Quảng Nam" className="hover:underline">
                                Hội An (Quảng Nam)
                            </a>
                            <a href="/Bình Định" className="hover:underline">
                                Phú Yên - Bình Định
                            </a>
                        </div>
                        <div className="grid gap-y-3">
                            <h3 className="text-md font-bold">
                                Miền Bắc
                            </h3>
                            <a href="/Hà Nội" className="hover:underline">
                                Hà Nội
                            </a>
                            <a href="/Quảng Ninh" className="hover:underline">
                                Hạ Long (Quảng Ninh)
                            </a>
                            <a href="Lào Cai" className="hover:underline">
                                Sapa (Lào Cai)
                            </a>
                            <a href="Ninh Bình" className="hover:underline">
                                Ninh Bình
                            </a>
                        </div>
                    </div>
                </Tabs.Content>

            </Tabs.Root>
        </div>
    )
}