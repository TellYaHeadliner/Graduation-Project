/* eslint-disable @typescript-eslint/no-unused-vars */
import { useParams } from "react-router-dom";
import CardHotel from "../../components/Card/CardHotel";
import DataListRoomPayment from "../../components/DataList/DataListRoomPayment";
import DataListServicesPayment from "../../components/DataList/DataListServicesPayment";
import useTitle from "../../hooks/useTitle";
import PaymentLayout from "../../layouts/PaymentLayout";
import { useHotelDetailQuery } from "../../react-query/useHotelDetailQuery";
import { Currency } from "../../utils/Currency";
import { useForm } from "react-hook-form";
import { PaymentSchema, paymentSchemas } from "../../schemas/paymentSchemas";
import { zodResolver } from "@hookform/resolvers/zod";
import { BookingDetailPayload, BookingPayload, BookingServicePayload, ComboPayload } from "../../types/TransactionTypes";
import { usePaymentMutation } from "../../react-query/usePaymentMutation";
import { ErrorUtils } from "../../utils/Error";
import DialogLoading from "../../components/Dialog/DialogLoading";
import DiscountBar from "../../components/Discount/DiscountBar";
import { useUserInfoQuery } from "../../react-query/useUserInfoQuery";
import { Callout } from "@radix-ui/themes";
import { InfoCircledIcon } from "@radix-ui/react-icons";



export default function Payment() {
    const title = "Điền thông tin";
    const { id } = useParams();
    useTitle(title);

    const getHotelDetail = useHotelDetailQuery(Number(id)).data?.data.hotel
    const getInfoSelectedRoom = JSON.parse(localStorage.getItem('infoSelectedRoom') ?? '[]');
    const getInfoSelectedCombos = JSON.parse(localStorage.getItem('infoSelectedCombos') ?? '[]');
    const getInfoSelectedService = JSON.parse(localStorage.getItem('infoSelectedService') ?? '[]');
    const getComboTotal = Number(JSON.parse(localStorage.getItem('comboTotal') ?? '[]'));
    const getServiceToal = Number(JSON.parse(localStorage.getItem('serviceTotal') ?? '[]'));
    const getTotalRoom = Number(JSON.parse(localStorage.getItem('totalRoom') ?? '[]'));
    const numberOfNights = JSON.parse(localStorage.getItem('numberOfNights') || '0');
    const total = getComboTotal + getServiceToal + getTotalRoom;
    const findRoom = JSON.parse(localStorage.getItem('findRoom') ?? '{}');
    const [checkInDay, checkOutDay] = findRoom?.dateRange ?? [];

    const { register, handleSubmit } = useForm<PaymentSchema>({
        resolver: zodResolver(paymentSchemas)
    });

    const mutation = usePaymentMutation();
    type WithName<T> = T & { name: string };

    const onSubmit = (data: PaymentSchema) => {
        const getInfoSelectedRoomWithoutName = (getInfoSelectedRoom as WithName<BookingDetailPayload>[]).map(({ name, ...rest }) => rest);
        const getInfoSelectedComboWithoutName = (getInfoSelectedCombos as WithName<ComboPayload>[]).map(({ name, ...rest }) => rest);
        const getInfoSelectedServiceWithoutName = (getInfoSelectedService as WithName<BookingServicePayload>[]).map(({ name, ...rest }) => rest);
        const errorHandler = new ErrorUtils();

        const payloadData: BookingPayload = {
            hotel_id: Number(id),
            checkin_date: checkInDay,
            checkout_date: checkOutDay,
            note: data.note ?? undefined,
            booking_details: getInfoSelectedRoomWithoutName,
            booking_combos: getInfoSelectedComboWithoutName,
            booking_services: getInfoSelectedServiceWithoutName,
            voucher: data.code ?? undefined
        }
        mutation.mutate(payloadData, {
            onSuccess: (data) => {
                const message = data?.message;
                if (message == "Không thể đặt booking mới vì bạn đã có một booking trong thời gian này") {
                    errorHandler.handleError(message)
                }
                const url = data?.url;

                if (url) {
                    window.open(url, "_self");
                }
            },
            onError: (error) => {
                errorHandler.handleError(error);
            }
        })
    }

    const hotelDetail = useHotelDetailQuery(Number(id));
    const voucherList = hotelDetail.data?.data.hotel.vouchers;
    const userInfo = useUserInfoQuery();


    return (
        <PaymentLayout>
            <div className="max-w-7xl mx-auto px-4 lg:px-10 py-8">
                <div className="flex flex-col lg:flex-row gap-8">
                    {/* Left: Thông tin đã chọn */}
                    <div className="lg:w-1/2 space-y-2">
                        <div className="p-4">
                            <CardHotel dataHotel={getHotelDetail} />
                        </div>

                        <div className="p-4 rounded-lg space-y-2">
                            <h3 className="text-lg font-semibold">Chi tiết đặt phòng của bạn</h3>
                            <DataListRoomPayment infoSelectedRoom={getInfoSelectedRoom} />
                            <DataListServicesPayment
                                comboSelection={getInfoSelectedCombos}
                                serviceSelection={getInfoSelectedService}
                            />
                            <div className="text-sm text-gray-600 mt-2 text-end">
                                Tổng tiền ({numberOfNights} đêm):
                                <span className="text-lg text-red-500 font-semibold ml-1">
                                    {Currency.formatVND(total)}
                                </span>
                            </div>
                        </div>
                    </div>

                    {/* Right: Form người đặt */}
                    <div className="lg:w-1/2 space-y-6">
                        <form onSubmit={handleSubmit(onSubmit)} className="bg-white p-6 rounded-lg space-y-6">
                            <h2 className="text-xl font-bold">Nhập thông tin chi tiết của bạn</h2>
                            <Callout.Root>
                                <Callout.Icon>
                                    <InfoCircledIcon />
                                </Callout.Icon>
                                <Callout.Text>
                                    Hãy kiểm tra thông tin trước khi thanh toán
                                </Callout.Text>
                            </Callout.Root>

                            <div className="bg-gray-100 p-3 rounded">
                                <h2 className="text-xl font-bold">Thông tin người dùng</h2>
                                <div className="text-sm text-gray-700">
                                    <div className="flex justify-between">
                                        <span className="font-medium">
                                            Họ tên:
                                        </span>
                                        <span>
                                            {userInfo.data?.data.user.fullname}
                                        </span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span className="font-medium">Email:</span>
                                        <span>{userInfo.data?.data.user.email ?? "Chưa có"}</span>
                                    </div>
                                    <div className="flex justify-between">
                                        <span className="font-medium">Số điện thoại:</span>
                                        <span>{userInfo.data?.data.user.phone ?? "Chưa có"}</span>
                                    </div>
                                </div>
                            </div>

                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label className="block text-sm font-medium text-gray-700">Check-in</label>
                                    <select
                                        {...register("check_in")}
                                        defaultValue={checkInDay}
                                        className="mt-1 w-full border px-4 py-2 rounded-lg"
                                    >
                                        <option value={checkInDay}>
                                            {checkInDay} {hotelDetail.data?.data.hotel.rules.check_in_time}
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label className="block text-sm font-medium text-gray-700">Check-out</label>
                                    <select
                                        {...register("check_out")}
                                        defaultValue={checkOutDay}
                                        className="mt-1 w-full border px-4 py-2 rounded-lg"
                                    >
                                        <option value={checkOutDay}>
                                            {checkOutDay} {hotelDetail.data?.data.hotel.rules.check_out_time}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">Ghi chú</label>
                                <input
                                    type="text"
                                    {...register("note")}
                                    className="mt-1 w-full border px-4 py-2 rounded-lg"
                                    placeholder="Ghi chú cho khách sạn (nếu có)"
                                />
                            </div>

                            <div>
                                {
                                    (voucherList && voucherList.length > 0) && (
                                        <div>
                                            <label className="block text-sm font-medium text-gray-700">Mã giảm giá</label>
                                            <input
                                                {...register("code")}
                                                type="text"
                                                placeholder="Nhập mã voucher nếu có"
                                                className="mt-1 w-full border px-4 py-2 rounded-lg"
                                            />
                                            <div className="mt-2">
                                                <DiscountBar discountList={voucherList} />
                                            </div>
                                        </div>
                                    )
                                }
                            </div>

                            <button
                                type="submit"
                                className="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition"
                            >
                                Tiếp tục thanh toán
                            </button>
                        </form>
                    </div>
                </div>

                {mutation.isPending && <DialogLoading isOpen={true} />}
            </div>
        </PaymentLayout>
    )
}