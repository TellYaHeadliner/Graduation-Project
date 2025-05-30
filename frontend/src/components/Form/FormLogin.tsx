import { useForm } from "react-hook-form"
import { zodResolver } from "@hookform/resolvers/zod"
import { loginSchema, LoginSchema } from "../../guards/loginSchemas"
import { PATH } from "../../constants/Paths";

export default function FormLogin() {
    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm<LoginSchema>({
        resolver: zodResolver(loginSchema),
    });

    const onSubmit = (data: LoginSchema) => {
        console.log("Dữ liệu: ", data)
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
            <div className="flex-items-center justify-center">
                <a href={PATH.QUENMATKHAU} className="text-sm text-blue-500 hover:underline">
                    Quên mật khẩu
                </a>

            </div>
            <button type="submit" className="w-full py-2 px-4 bg-primary hover:bg-accent text-white font-semibold rounded-lg transition duration-200">
                Đăng nhập
            </button>
            <p className="text-center text-sm text-white">
                Chưa có tài khoản? <a href={PATH.DANGKI} className="text-blue-500 hover:underline">Đăng ký</a>
            </p>
        </form>
    )
}