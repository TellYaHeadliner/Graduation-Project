import { useForm } from "react-hook-form"
import { zodResolver } from "@hookform/resolvers/zod"
import { loginSchema, LoginSchema } from "../../schemas/loginSchemas"
import { PATH } from "../../constants/Paths";
import { FaFacebook, FaGoogle } from "react-icons/fa6"
import { Button } from "@radix-ui/themes";
import DialogLoginComplete from "../Dialog/DialogLoginComplete";
import { useState } from "react";
import { useLoginMutation } from '../../react-query/useLoginMutation';
import DialogLoading from "../Dialog/DialogLoading";
import { ErrorUtils } from "../../utils/Error";
import { useNavigate } from "react-router-dom";
import { ApiError } from "../../types/api"; 


export default function FormLogin() {
    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm<LoginSchema>({
        resolver: zodResolver(loginSchema),
    });
    const [isOpenDialog, setIsOpenDialog] = useState(false);
    const loginMutation = useLoginMutation();
    const navigate = useNavigate();

    const onSubmit = async (data: LoginSchema) => {
        const errorHandler = new ErrorUtils();
        try {
            const responseLogin = await loginMutation.mutateAsync({ email: data.email, password: data.password })
            if (responseLogin) {
                setIsOpenDialog(true);
            }
        } catch (err) {
            const error = err as ApiError;

            if (error.redirect) {
                localStorage.setItem("email_verification_pending", data.email);
                navigate(error.redirect);
                return;
            }

            errorHandler.handleError(error);
        }
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)} method="POST" className="space-y-4">
            <div>
                <label htmlFor="email" className="block-text-sm font-medium text-white">Email</label>
                <input type="email" {...register("email")} className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:accent focus:outine-none" />
                {errors.email && <p className="text-red-500">{errors.email.message}</p>}
            </div>
            <div>
                <label htmlFor="password" className="block text-sm font-medium text-white">Mật khẩu</label>
                <input type="password" {...register("password")} name="password" id="password" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                {errors.password && (<p className="text-red-500">{errors.password.message}</p>)}
            </div>
            <div className="flex items-center justify-start">
                <a href={PATH.QUENMATKHAU} className="text-sm text-white hover:underline">
                    Quên mật khẩu
                </a>

            </div>
            <button type="submit" className="w-full py-2 px-4 bg-gray-800 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                Đăng nhập
            </button>
            <p className="text-center text-base text-white">
                Chưa có tài khoản? <a href={PATH.DANGKI} className="text-fifth font-semibold hover:underline">Đăng ký</a>
            </p>
            <p className="text-center text-lg text-white">
                Bạn có thể đăng nhập qua
            </p>
            <div className="flex items-center justify-center gap-4">
                <Button>
                    <FaFacebook className="w-5 h-5" />
                    Facebook
                </Button>
                <Button color="yellow">
                    <FaGoogle className="w-5 h-5 text-white" />
                    Google
                </Button>
            </div>
            <DialogLoginComplete title="Đăng nhập thành công" isOpen={isOpenDialog} />
            {
                loginMutation.isPending &&
                <DialogLoading isOpen={true} />
            }
        </form>
    )
}