import { DataList } from "@radix-ui/themes";

export default function DataListRule() {
    return (
        <div className="rounded-lg border border-gray-300 p-4">
            <DataList.Root>
                <DataList.Item className="border-b border-gray-300 py-2">
                    <DataList.Label className="border-r border-gray-300">Check-in</DataList.Label>
                    <DataList.Value>
                        Từ 15:00 đến 23:00<br />
                        Khách cần xuất trình giấy tờ tùy thân có ảnh và thẻ tín dụng khi nhận phòng.<br />
                        Vui lòng thông báo trước cho chỗ nghỉ thời gian đến của bạn.
                    </DataList.Value>
                </DataList.Item>

                <DataList.Item className="border-b border-gray-300 py-2">
                    <DataList.Label className="border-r border-gray-300">Check-out</DataList.Label>
                    <DataList.Value>Từ 00:00 đến 11:00</DataList.Value>
                </DataList.Item>

                <DataList.Item className="border-b border-gray-300 py-2">
                    <DataList.Label className="border-r border-gray-300">Huỷ/đặt cọc</DataList.Label>
                    <DataList.Value>
                        Chính sách huỷ và đặt cọc thay đổi theo loại chỗ nghỉ.
                    </DataList.Value>
                </DataList.Item>

                <DataList.Item className="border-b border-gray-300 py-2">
                    <DataList.Label className="border-r border-gray-300">Trẻ em và giường</DataList.Label>
                    <DataList.Value className="space-y-2">
                        <div className="flex flex-wrap">
                            <div>
                                <strong>Child policies</strong><br />
                                Children of any age are welcome.<br />
                                To see correct prices and occupancy info, please add the number of children in your group and their ages to your search.
                            </div>
                            <div>
                                <strong>Cot and extra bed policies</strong><br />
                                Cots and extra beds are not available at this property.
                            </div>
                        </div>
        
                    </DataList.Value>
                </DataList.Item>

                <DataList.Item className="border-b border-gray-300 py-2">
                    <DataList.Label className="border-r border-gray-300">Giới hạn độ tuổi</DataList.Label>
                    <DataList.Value>Không có giới hạn độ tuổi khi nhận phòng</DataList.Value>
                </DataList.Item>

                <DataList.Item className="border-b border-gray-300 py-2">
                    <DataList.Label className="border-r border-gray-300">Thú cưng</DataList.Label>
                    <DataList.Value>Không cho phép mang theo thú cưng</DataList.Value>
                </DataList.Item>

                <DataList.Item className="border-b border-gray-300 py-2">
                    <DataList.Label className="border-r border-gray-300">Đặt theo nhóm</DataList.Label>
                    <DataList.Value>
                        Khi đặt trên 10 phòng, có thể áp dụng các chính sách và phụ phí khác.
                    </DataList.Value>
                </DataList.Item>
            </DataList.Root>
        </div>
    );
}
