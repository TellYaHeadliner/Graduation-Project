import { Button, DataList } from "@radix-ui/themes";
import { Currency } from "../../utils/Currency";


export default function DataListInfoPayment() {

    return (
        <div className="rounded-lg bg-gray-100 border p-4">
            <div className="flex items-start">
                <div className="mr-4">
                    <h2 className="text-lg font-semibold mb-2">Thông tin khách hàng</h2>
                    <DataList.Root>
                        <DataList.Item>
                            <DataList.Label>Họ và tên</DataList.Label>
                            <DataList.Value>Nguyễn Văn A</DataList.Value>
                        </DataList.Item>
                        <DataList.Item>
                            <DataList.Label>Địa chỉ Email</DataList.Label>
                            <DataList.Value>nguyenvana@email.com</DataList.Value>
                        </DataList.Item>
                        <DataList.Item>
                            <DataList.Label>Địa chỉ</DataList.Label>
                            <DataList.Value>65 Huỳnh Khúc Kháng, P.Bến Nghé, Q.1</DataList.Value>
                        </DataList.Item>
                        <DataList.Item>
                            <DataList.Label>Yêu cầu</DataList.Label>
                            <DataList.Value>Không hút thuốc</DataList.Value>
                        </DataList.Item>
                        <DataList.Item>
                            <DataList.Label>Check in</DataList.Label>
                            <DataList.Value>14:00</DataList.Value>
                        </DataList.Item>
                    </DataList.Root>
                    <div className="text-wrap mt-2">
                        <h2 className="text-lg font-semibold mb-2">Thông tin khách sạn</h2>
                        <DataList.Root>
                            <DataList.Item>
                                <DataList.Label>Tên khách sạn</DataList.Label>
                                <DataList.Value className="font-thin">Khách sạn Bình Minh</DataList.Value>
                            </DataList.Item>
                            <DataList.Item>
                                <DataList.Label>Địa chỉ</DataList.Label>
                                <DataList.Value className="font-thin">431 ABC, phường 21, quận Bình Tân, TP.HCM</DataList.Value>
                            </DataList.Item>
                        </DataList.Root>
                    </div>
                </div>

                <div>
                    <h2 className="text-lg font-semibold my-2 sticky top-0">Chi tiết đặt phòng</h2>
                    <div className="max-h-[200px] overflow-y-auto">
                    <table className="w-full text-sm border border-gray-300">
                        <thead className="bg-gray-200 text-left sticky top-0">
                            <tr>
                                <th className="p-2">Hạng mục</th>
                                <th className="p-2">Số lượng</th>
                                <th className="p-2">Đơn giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr className="border-t">
                                <td className="p-2">Loại phòng 1 giường lớn</td>
                                <td className="p-2">1 phòng</td>
                                <td className="p-2">{Currency.formatVND(1000000)}</td>
                            </tr>
                            <tr className="border-t">
                                <td className="p-2">Loại phòng 2 giường nhỏ</td>
                                <td className="p-2">1 phòng</td>
                                <td className="p-2">{Currency.formatVND(2000000)}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
        
                </div>
            </div>

            {/* Tổng tiền */}
            <div className="text-right">
                <h2 className="text-lg font-semibold">Tổng tiền:</h2>
                <div className="text-2xl font-bold text-blue-700">
                    
                </div>
                <Button>
                    Thanh toán
                </Button>
            </div>

        </div>
    );
}
