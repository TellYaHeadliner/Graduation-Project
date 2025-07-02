import { DataList } from "@radix-ui/themes";
import { Rule } from '../../types/DetailHotelTypes';

interface DataListRuleProps {
    hotelRule: Rule | undefined;
}

export default function DataListRule({ hotelRule }: DataListRuleProps) {
    return (
        <div className="rounded-lg border border-gray-300 p-4">
            <DataList.Root>
                <DataList.Item className="border-b border-gray-300 py-2">
                    <DataList.Label className="border-r border-gray-300">Check-in</DataList.Label>
                    <DataList.Value>
                        Từ {hotelRule?.check_in_time} <br />
                        Khách cần xuất trình giấy tờ tùy thân có ảnh và thẻ tín dụng khi nhận phòng.<br />
                        Vui lòng thông báo trước cho chỗ nghỉ thời gian đến của bạn.
                    </DataList.Value>
                </DataList.Item>

                <DataList.Item className="border-b border-gray-300 py-2">
                    <DataList.Label className="border-r border-gray-300">Check-out</DataList.Label>
                    <DataList.Value>Từ {hotelRule?.check_out_time}</DataList.Value>
                </DataList.Item>


                <DataList.Item className="border-b border-gray-300 py-2">
                    <DataList.Label className="border-r border-gray-300">Cho phép trẻ em</DataList.Label>
                    <DataList.Value className="border-r border-gray-300">
                        {hotelRule?.child_policy === true ? (
                            <span>
                                Cho phép trẻ em (Giới hạn độ tuổi: dưới {hotelRule.child_age_limit} tuổi)
                            </span>
                        ) : (
                            <span>Không cho phép trẻ em</span>
                        )}
                    </DataList.Value>
                </DataList.Item>

                <DataList.Item className="border-b border-gray-300 py-2">
                    <DataList.Label className="border-r border-gray-300">Thú cưng</DataList.Label>
                    <DataList.Value>{hotelRule?.pet_policy === true ? "Khách hàng có thể mang thú cưng" : "Khách hàng không được phép mang thú cưng"}</DataList.Value>
                </DataList.Item>

                <DataList.Item className="border-b border-gray-300 py-2">
                    <DataList.Label className="border-r border-gray-300">Phụ phí giường</DataList.Label>
                    <DataList.Value>
                        {hotelRule?.extra_bed_fee === 1 ? "Có phụ phí giường giá 100,000 VNĐ/giường" : "Không có phụ phí giường"}
                    </DataList.Value>
                </DataList.Item>
            </DataList.Root>
        </div>
    );
}
