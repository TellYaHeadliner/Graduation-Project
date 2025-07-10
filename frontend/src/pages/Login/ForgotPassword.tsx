import { ToastContainer } from "react-toastify";
import FormForgotPassword from "../../components/Form/FormForgotPassword";
import useTitle from "../../hooks/useTitle";
import LoginLayout from "../../layouts/LoginLayout";

export default function ForgotPassword() {
    useTitle("Quên mật khẩu");

    return (
        <LoginLayout>
            <p className="text-md font-medium text-gray-700 mb-0">
                Vui lòng nhập email để chúng tôi gửi email thay đổi mật khẩu 
            </p>
            <FormForgotPassword />
            <ToastContainer position="top-right" />
        </LoginLayout>
    )
}