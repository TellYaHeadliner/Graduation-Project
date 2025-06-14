import { useForm } from "react-hook-form"
import { zodResolver } from "@hookform/resolvers/zod"
import { loginSchema, LoginSchema } from "../../guards/loginSchemas"
import { PATH } from "../../constants/Paths";
import { FaFacebook, FaGoogle } from "react-icons/fa6"
import { Button } from "@radix-ui/themes";

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
                    <FaFacebook className="w-5 h-5 " />
                    Facebook
                </Button>
                <Button color="yellow">
                    <svg
                        className="w-5 h-5"
                        viewBox="-3 0 262 262"
                        xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="xMidYMid"
                    >
                        <path
                            d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"
                            fill="#4285F4"
                        />
                        <path
                            d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"
                            fill="#34A853"
                        />
                        <path
                            d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"
                            fill="#FBBC05"
                        />
                        <path
                            d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"
                            fill="#EB4335"
                        />
                    </svg>
                    Google
                </Button>
            </div>
        </form>
    )
}