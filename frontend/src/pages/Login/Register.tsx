
import FormReigster from "../../components/Form/FormRegister";
import useTitle from "../../hooks/useTitle";
import LoginLayout from "../../layouts/LoginLayout";

export default function Register() {
    useTitle("Đăng kí");

    return (
        <LoginLayout>
            <FormReigster />
        </LoginLayout>
    )
}