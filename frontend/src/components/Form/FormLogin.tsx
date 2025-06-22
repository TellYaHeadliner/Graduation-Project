import { useForm } from "react-hook-form"
import { zodResolver } from "@hookform/resolvers/zod"
import { loginSchema, LoginSchema } from "../../schemas/loginSchemas"
import { PATH } from "../../constants/Paths";
import { FaFacebook, FaGoogle } from "react-icons/fa6"
import { Button } from "@radix-ui/themes";
import { useNavigate } from "react-router-dom";
import DialogLoginComplete from "../Dialog/DialogLoginComplete";
import { useState } from "react";
import { useLoginMutation } from '../../react-query/useLoginMutation';
import LoadingPage from "../../pages/LoadingPage";
import DialogLoading from "../Dialog/DialogLoading";


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

    const onSubmit = async (data: LoginSchema) => {
        try {
            const responseLogin = await loginMutation.mutateAsync({ email: data.email, password: data.password })
            if (responseLogin) {
              setIsOpenDialog(true);
            }
          } catch (error) {
            console.error(error)
          }
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)} method="POST" className="space-y-4">
            <div>
                <label htmlFor="email" className="block-text-sm font-medium text-gray-700">Email</label>
                <input type="email" {...register("email")} className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:accent focus:outine-none" />
                {errors.email && <p className="text-red-500">{errors.email.message}</p>}
            </div>
            <div>
                <label htmlFor="password" className="block text-sm font-medium text-gray-700">Mật khẩu</label>
                <input type="password" {...register("password")} name="password" id="password" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                {errors.password && (<p className="text-red-500">{errors.password.message}</p>)}
            </div>
            <div className="flex items-center justify-start">
                <a href={PATH.QUENMATKHAU} className="text-sm text-fifth hover:underline">
                    Quên mật khẩu
                </a>

            </div>
            <button type="submit" className="w-full py-2 px-4 bg-primary hover:bg-accent text-white font-semibold rounded-lg transition duration-200">
                Đăng nhập
            </button>
            <p className="text-center text-sm text-white">
                Chưa có tài khoản? <a href={PATH.DANGKI} className="text-fifth hover:underline">Đăng ký</a>
            </p>
            <p className="text-center text-sm text-white">
                Bạn có thể đăng nhập qua
            </p>
            <div className="flex items-center justify-center gap-4">
                <Button>
                    <FaFacebook className="w-5 h-5"/>
                    Facebook
                </Button>
                <Button color="yellow">
                    <FaGoogle className="w-5 h-5 text-white"/>
                    Google
                </Button>
            </div>
            <DialogLoginComplete title="Đăng kí thành công" isOpen={isOpenDialog} />
            {
                loginMutation.isPending &&
                <DialogLoading isOpen={true} />
            }
        </form>
    )
}