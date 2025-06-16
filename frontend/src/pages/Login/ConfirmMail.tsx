import { useEffect } from "react";
import useTitle from "../../hooks/useTitle";
import LoginLayout from "../../layouts/LoginLayout";
import { useNavigate } from 'react-router-dom';

export default function ConfirmMail() {
    useTitle("Mail của bạn đã gửi");

    const navigate = useNavigate();

    useEffect(() => {
        const timeoutId = setTimeout(() => {
            navigate("/");
        }, 5000);

        return () => clearTimeout(timeoutId)
    },[navigate])
    return (
        <LoginLayout>
            <p className="text-md font-medium text-gray-700 mb-0">
                Mail về việc thay đổi mật khẩu của bạn đã gửi, vui lòng mở họp thư để thay đổi mật khẩu mới của bạn
            </p>
        </LoginLayout>
    )
}