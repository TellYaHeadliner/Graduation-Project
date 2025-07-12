import { useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { PATH } from "../../constants/Paths";
import { FaCheckCircle } from "react-icons/fa";

export default function EmailVerified() {
    const navigate = useNavigate();

    useEffect(() => {
        localStorage.removeItem("email_verification_pending");

        const timer = setTimeout(() => {
            navigate(PATH.DANGNHAP);
        }, 5000);

        return () => clearTimeout(timer);
    }, [navigate]);

    return (
        <div className="min-h-screen flex items-center justify-center bg-green-50 px-4">
            <div className="bg-white p-8 rounded-lg shadow-lg max-w-md w-full text-center">
                <FaCheckCircle className="text-green-500 text-5xl mx-auto mb-4" />
                <h2 className="text-2xl font-semibold text-gray-800 mb-2">Xác minh email thành công!</h2>
                <p className="text-gray-600 mb-4">
                    Tài khoản của bạn đã được kích hoạt. Bạn có thể đăng nhập để sử dụng hệ thống Roomix.
                </p>
                <button
                    onClick={() => navigate(PATH.DANGNHAP)}
                    className="mt-4 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded"
                >
                    Đăng nhập ngay
                </button>
                <p className="text-sm text-gray-400 mt-4">Bạn sẽ được chuyển hướng sau vài giây...</p>
            </div>
        </div>
    );
}
