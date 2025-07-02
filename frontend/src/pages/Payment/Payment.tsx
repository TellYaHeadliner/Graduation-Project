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

    return (
        <PaymentLayout>
            <div className="lg:px-14">
                <div className="my-6">
                    <h1 className="text-3xl font-bold">
                        Chi tiết thông tin đặt phòng
                    </h1>
                    <p className="font-lg font-thin text-gray-400">
                        Hãy chắc chắn rằng các thông tin bạn điền là chính xác để tiến hành thanh toán
                    </p>
                </div>

                <div className="flex flex-col lg:flex-row w-full gap-6">
                    <div className="lg:w-1/2 w-full">
                        <form className="space-y-4" onSubmit={handleSubmit(onSubmit)}>
                            <div>
                                <label htmlFor="checkIn" className="block-text-sm font-medium text-gray-700">Check-in</label>
                                <select {...register("check_in")} defaultValue={checkInDay} className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:accent focus:outine-none">
                                    <option value={checkInDay}>
                                        {checkInDay}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label htmlFor="checkOut" className="block-text-sm font-medium text-gray-700">Check-out</label>
                                <select {...register("check_out")} defaultValue={checkOutDay} className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:accent focus:outine-none">
                                    <option value={checkOutDay}>
                                        {checkOutDay}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label htmlFor="note" className="block-text-sm font-medium text-gray-700">Ghi chú</label>
                                <input {...register("note")} type="text" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:accent focus:outine-none" />
                            </div>
                            <div>
                                <label htmlFor="code" className="block-text-sm font-medium text-gray-700">Voucher (Nếu có)</label>
                                <input {...register("code")} type="text" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:accent focus:outine-none" />
                            </div>
                            <button type="submit" className="py-2 px-4 bg-blue-500 hover:bg-accent text-white font-semibold rounded-lg transition duration-200">
                                Thanh toán
                            </button>
                        </form>
                        <div className="mt-2">
                            <DiscountBar discountList={voucherList ?? []} />
                        </div>
                    </div>

                    <div className="lg:w-1/2 w-full flex flex-col gap-3">

                        <CardHotel dataHotel={getHotelDetail} />
                        <div className="mt-2">
                            <DataListRoomPayment infoSelectedRoom={getInfoSelectedRoom} />
                        </div>
                        <div className="mt-2">
                            <DataListServicesPayment comboSelection={getInfoSelectedCombos} serviceSelection={getInfoSelectedService} />
                        </div>
                        <div className="bg-gray-100 rounded-xl p-4 text-lg font-medium mt-2 w-[320px]">
                            Tổng tiền {Number(numberOfNights)} đêm : {Currency.formatVND(total)}
                        </div>
                    </div>
                </div>
                {
                    mutation.isPending && (
                        <DialogLoading isOpen={true} />
                    )
                }
            </div>
        </PaymentLayout>
    )
}