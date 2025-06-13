
import { useDispatch } from "react-redux";
import CardHotel from "../../components/Card/CardHotel";
import DataListRoomPayment from "../../components/DataList/DataListRoomPayment";
import DataListServiesPayment from "../../components/DataList/DataListServicesPayment";
import FormPayment from "../../components/Form/FormPayment";
import useTitle from "../../hooks/useTitle";
import PaymentLayout from "../../layouts/PaymentLayout";
import { Currency } from "../../utils/Currency";
import { setPageTitle } from "../../redux/slices/titlePaymentSlice";

export default function Payment() {
    const dispatch = useDispatch();
    const title = "Điền thông tin";
    useTitle(title);

    dispatch(setPageTitle(title));

    return (
        <PaymentLayout>
            <div className="lg:px-14">
                <h1 className="text-3xl font-bold">
                    Chi tiết thông tin đặt phòng
                </h1>
                <p className="font-lg font-thin text-gray-400">
                    Hãy chắc chắn rằng các thông tin bạn điền là chính xác để tiến hành thanh toán
                </p>
                <div className="flex w-full">
                    <div className="w-1/2">
                        <FormPayment />
                    </div>
                    <div className="w-1/2 flex flex-col justify-start items-end">
                        <CardHotel />
                        <div className="mt-2">
                            <DataListRoomPayment />
                        </div>
                        <div className="mt-2">
                            <DataListServiesPayment />
                        </div>
                        <div className="bg-gray-100 rounded-xl p-4 text-lg font-medium mt-2 w-[320px]">
                            Tổng tiền: {Currency.formatVND(20000000)} 
                        </div>
                        <div className="mt-2">
                        <button type="submit" className="text-lg py-2 px-4 text-left bg-secondary hover:bg-accent text-white font-semibold rounded-lg transition duration-200">
                            Xác nhận
                        </button>
                        </div>
                    </div>
                </div>
            </div>
        </PaymentLayout>
    )
}