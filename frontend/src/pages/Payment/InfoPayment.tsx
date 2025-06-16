
import { useDispatch } from "react-redux";
import useTitle from "../../hooks/useTitle";
import PaymentLayout from "../../layouts/PaymentLayout";
import { setPageTitle } from "../../redux/slices/titlePaymentSlice";
import DataListInfoPayment from "../../components/DataList/DataListInfoPayment";

export default function InfoPayment() {
    const dispatch = useDispatch();
    const title = "Xem lại thông tin";
    useTitle(title);

    dispatch(setPageTitle(title));

    return (
        <PaymentLayout>
            <div className="lg:px-14">
                <h1 className="text-3xl font-bold mt-2">
                    Chi tiết thông tin đặt phòng
                </h1>
                <p className="font-lg font-thin text-gray-400 mb-2">
                    Hãy chắc chắn rằng các thông tin bạn điền là chính xác để tiến hành thanh toán
                </p>
                <div className="flex not-even:w-full justify-center">
                    <DataListInfoPayment />
                </div>
            </div>
        </PaymentLayout>
    )
}