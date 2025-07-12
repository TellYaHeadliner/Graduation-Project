import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import { PATH } from "../../constants/Paths";
import authApi from "../../api/Auth.api";
import { toast } from "react-toastify";
import LoginLayout from "../../layouts/LoginLayout";
import { ErrorUtils } from "../../utils/Error";

export default function PleaseCheckEmail() {
    const navigate = useNavigate();
    const [email, setEmail] = useState<string | null>(null);
    const [isSending, setIsSending] = useState(false);

    useEffect(() => {
        const savedEmail = localStorage.getItem("email_verification_pending");
        if (!savedEmail) {
            toast.error("Không tìm thấy email cần xác minh.");
            navigate(PATH.DANGNHAP);
        } else {
            setEmail(savedEmail);
        }
    }, [navigate]);

    const handleResend = async () => {
        const errorHandler = new ErrorUtils();
        if (!email) return;

        setIsSending(true);
        try {
            await authApi.resendVerification(email);
            toast.success("Đã gửi lại email xác minh!");
        } catch (error) {
             errorHandler.handleError(error);
        } finally {
            setIsSending(false);
        }
    };

    return (
        <LoginLayout>
            <div className="text-center space-y-4 text-white">
                <h2 className="text-2xl font-bold">Vui lòng kiểm tra email</h2>
                <p>
                    Một liên kết xác minh đã được gửi đến <span className="font-semibold">{email}</span>.  
                    Vui lòng kiểm tra hộp thư đến để kích hoạt tài khoản.
                </p>
                <button
                    onClick={handleResend}
                    className="mt-4 px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white transition disabled:opacity-50"
                    disabled={isSending}
                >
                    {isSending ? "Đang gửi..." : "Gửi lại mã xác minh"}
                </button>

                <p className="text-sm mt-4">
                    Sau khi xác minh thành công, bạn sẽ được chuyển đến trang đăng nhập.
                </p>
            </div>
        </LoginLayout>
    );
}
