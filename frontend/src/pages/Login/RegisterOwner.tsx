import RegisterOwnerForm from "../../components/Form/FormRegisterOwner";
import useTitle from "../../hooks/useTitle";
import LoginLayout from "../../layouts/LoginLayout";

export default function RegisterOwner() {
    useTitle("Đăng kí tài khoản khách sạn");

    return (
        <LoginLayout>
            <h1 className="text-4xl font-bold text-center text-white">
                Đăng kí trở thành đối tác
            </h1>
            <p className="text-md text-white font-thin text-center">
                 Hợp tác với chúng tôi để quảng bá khách sạn và tiếp cận khách hàng tiềm năng
            </p>
            <RegisterOwnerForm />
        </LoginLayout>
    )
}