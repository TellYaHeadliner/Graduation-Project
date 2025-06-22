import FormLogin from "../../components/Form/FormLogin";
import useTitle from "../../hooks/useTitle";
import LoginLayout from "../../layouts/LoginLayout";

export default function Login() {
    useTitle("Đăng nhập");
    
    return (
        <LoginLayout>
            <FormLogin />        
        </LoginLayout>
    )
}