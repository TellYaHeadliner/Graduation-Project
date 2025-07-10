import { useParams } from "react-router-dom";
import useTitle from "../../hooks/useTitle";
import PersonalLayout from "../../layouts/PersonalLayout";
import { useBookingDetailQuery } from "../../react-query/useBookingDetailQuery";
import { Callout } from "@radix-ui/themes";
import { Currency } from '../../utils/Currency';
import { InfoCircledIcon } from "@radix-ui/react-icons";
import DialogCancelBooking from "../../components/Dialog/DialogCancelBooking";
import { ToastContainer } from "react-toastify";

export default function DetailBooking() {
    const { id } = useParams();
    const getDetailBooking = useBookingDetailQuery(Number(id));
    useTitle(`Chi tiết booking số ${getDetailBooking.data?.data.id}`)

    return (
        <PersonalLayout>
            <div className="max-w-4xl mx-auto p-6 rounded-xl shadow-md space-y-6 my-6">
                <h1 className="text-2xl font-bold text-blue-700">
                    Chi tiết đơn đặt phòng
                </h1>

                <div className="space-y-6">
                    <div className="border p-4 rounded-md bg-white">
                        <h2 className="font-semibold text-xl mb-4 text-gray-800">
                            Thông tin đơn đặt phòng
                        </h2>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p><span className="font-semibold">Mã đơn: </span>{getDetailBooking.data?.data.booking_code}</p>
                                <p><span className="font-semibold">Ngày tạo: </span>{getDetailBooking.data?.data.created_at}</p>
                                <p><span className="font-semibold">Trình trạng: </span>{getDetailBooking.data?.data.status}</p>
                            </div>
                            <div>
                                <p><span className="font-semibold">Nhận phòng: </span> {getDetailBooking.data?.data.check_in}</p>
                                <p><span className="font-semibold">Trả phòng: </span> {getDetailBooking.data?.data.check_out}</p>
                                <p><span className="font-semibold">Tổng tiền: </span> {Currency.formatVND(getDetailBooking.data?.data.total_amount || null)}</p>
                            </div>
                        </div>
                    </div>

                    {/* Thông tin khách sạn */}
                    <div className="border p-4 rounded-md bg-white">
                        <h2 className="font-semibold text-xl mb-4 text-gray-800">
                            Thông tin khách sạn
                        </h2>
                        <div className="flex items-center gap-4">
                            <img src={import.meta.env.VITE_URL + getDetailBooking.data?.data.hotel.avatar} alt="" className="w-24 h-24 object-cover rounded-md" />
                            <div>
                                <p className="font-semibold text-lg">
                                    {getDetailBooking.data?.data.hotel.name}
                                </p>
                                <p className="text-gray-600 text-sm">
                                    {getDetailBooking.data?.data.hotel.address}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="border p-4 rounded-md bg-white">
                        <h2 className="font-semibold text-xl mb-4 text-gray-800">
                            Thông tin khách hàng
                        </h2>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <p>
                                <span className="font-semibold">Họ tên: </span>
                                {getDetailBooking.data?.data.customer.name}
                            </p>
                            <p>
                                <span className="font-semibold">Email: </span> {getDetailBooking.data?.data.customer.email}
                            </p>
                            <p><span className="font-semibold">Số điện thoại: </span> {getDetailBooking.data?.data.customer.phone}</p>
                        </div>
                    </div>

                    <div className="border p-4 rounded-md bg-white">
                        <h2 className="font-semibold text-xl mb-4 text-gray-800">
                            Phòng đã đặt
                        </h2>
                        <div className="space-y-4">
                            {
                                getDetailBooking.data?.data.booking_details.map((room) => (
                                    <div key={room.room_code} className="border p-4 rounded-md bg-gray-50">
                                        <p><span className="font-semibold">Tên phòng: </span> {room.room_code}</p>
                                        <p><span className="font-semibold">Loại phòng: </span> {room.room_type}</p>
                                        <p><span className="font-semibold">Giá: </span> {Currency.formatVND(room.price)}</p>
                                    </div>
                                ))
                            }
                        </div>
                    </div>

                    <div className="border p-4 rounded-md bg-white">
                        <h2 className="font-semibold text-xl mb-4 text-gray-800">
                            Thông tin dịch vụ
                        </h2>
                        {
                            getDetailBooking.data?.data.booking_services.length === 0 ? (
                                <span className="font-semibold text-gray-600">
                                    Bạn không chọn dịch vụ nào
                                </span>
                            ) : (
                                <div className="space-y-4">
                                    {
                                        getDetailBooking.data?.data.booking_services.map((service) => (
                                            <div key={service.name} className="border p-4 rounded-md bg-gray-50">
                                                <p><span className="font-semibold">Tên dịch vụ: </span> {service.name}</p>
                                                <p><span className="font-semibold">Đơn vị tính: </span> {service.default_unit}</p>
                                                <p><span className="font-semibold">Số lượng: </span> {service.quantity}</p>
                                                <p><span className="font-semibold">Giá: </span> {Currency.formatVND(service.price)}</p>
                                                <p><span className="font-semibold">Tổng: </span> {Currency.formatVND(service.total_price)}</p>
                                            </div>
                                        ))
                                    }
                                </div>
                            )
                        }
                    </div>

                    <div className="border p-4 rounded-md bg-white">
                        <h2 className="font-semibold text-xl mb-4 text-gray-800">
                            Combo đã chọn
                        </h2>
                        {
                            getDetailBooking.data?.data.booking_combos?.length === 0 ? (
                                <span className="font-semibold text-gray-600">
                                    Bạn không chọn combo nào cả
                                </span>
                            ) : (
                                <div className="space-y-4">
                                    {
                                        getDetailBooking.data?.data.booking_combos?.map((combo) => (
                                            <div key={combo.combo_name} className="border p-4 rounded-md bg-gray-50">
                                                <p><span className="font-semibold">Tên combo: </span> {combo.combo_name}</p>
                                                <p><span className="font-semibold">Số lượng: </span> {combo.quantity}</p>
                                                <p><span className="font-semibold">Giá: </span> {Currency.formatVND(combo.price)}</p>
                                                <p><span className="font-semibold">Tổng: </span> {Currency.formatVND(combo.total_price)}</p>
                                                <p><span className="font-semibold">Loại dịch vụ bao gồm: </span></p>
                                                <ul className="list-disc ml-5">
                                                    {
                                                        combo.services.map((service, index) => (
                                                            <li key={index}>
                                                                {service.name} - SL: {service.quantity}
                                                            </li>
                                                        ))
                                                    }
                                                </ul>
                                            </div>
                                        ))
                                    }
                                </div>
                            )
                        }
                    </div>

                    <div className="border p-4 rounded-md bg-white">
                        <h2 className="font-semibold text-xl mb-4 text-gray-800">
                            Có thể hủy phòng
                        </h2>
                        {
                            typeof getDetailBooking.data?.data?.cancellation_fee === 'number' &&
                            getDetailBooking.data.data.cancellation_fee > 0 && (
                                <div>
                                    <Callout.Root className="my-2" color="red">
                                        <Callout.Icon>
                                            <InfoCircledIcon />
                                        </Callout.Icon>
                                        <Callout.Text>
                                            Lưu ý:phí hủy sau ... phòng với giá {Currency.formatVND(getDetailBooking.data.data.cancellation_fee)}
                                        </Callout.Text>
                                    </Callout.Root>
                                    <DialogCancelBooking bookingId={Number(id)}/>
                                </div>
                            )
                        }
                    </div>

                </div>
            </div>
            <ToastContainer position="top-right" />
        </PersonalLayout>
    )
}