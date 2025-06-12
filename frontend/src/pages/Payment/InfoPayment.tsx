
import CardHotel from "../../components/Card/CardHotel";
import DataListRoomPayment from "../../components/DataList/DataListRoomPayment";
import DataListServiesPayment from "../../components/DataList/DataListServicesPayment";
import FormPayment from "../../components/Form/FormPayment";
import useTitle from "../../hooks/useTitle";
import PaymentLayout from "../../layouts/PaymentLayout";
import { Currency } from "../../utils/Currency";

export default function InfoPayment() {
    useTitle("Xem lại thông tin");

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
                   
                </div>
            </div>
        </PaymentLayout>
    )
}