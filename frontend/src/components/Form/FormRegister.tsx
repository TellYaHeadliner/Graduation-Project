import { useForm  } from "react-hook-form"
import { zodResolver } from "@hookform/resolvers/zod"
import { registerSchema, RegisterSchema } from "../../guards/registerSchemas"

export default function FormRegister(){
    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm<RegisterSchema>({
        resolver: zodResolver(registerSchema),
    });

    const onSubmit = (data: RegisterSchema) => {
        console.log("Dữ liệu: ", data)
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)} className="space-y-4" method="POST">
            <div>
                <label htmlFor="fullname" className="block-text-sm font-medium text-gray-700">Họ và tên</label>
                <input type="text" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:accent focus:outline-none" placeholder="Nguyễn Văn A"
                {...register("fullname")} />
                {errors.fullname && <p className="text-red-500">{ errors.fullname.message}</p> }
            </div>
            <div>
                <label htmlFor="email" className="block-text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:accent focus:outline-none" placeholder="abc@example.com"
                {...register("email")}
                />
                { errors.email && <p className="text-red-500">
                    { errors.email.message }
                </p> }
            </div>

            <div>
                <label htmlFor="password" className="block-text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" 
                {...register("password")}
                />
                { errors.password && <p className="text-red-500">
                    { errors.password.message}
                </p> }
            </div>

            <div>
                <label htmlFor="phone" className="block-text-sm font-medium text-gray-700">Số điện thoại</label>
                <input type="password" id="phone" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" 
                {...register("phone")}
                />
                { errors.phone && <p className="text-red-600">
                    { errors.phone.message }
                </p> }
            </div>

            <div>
                <label htmlFor="gender" className="block-text-sm font-medium text-gray-700">Giới tính</label>
                <div className="flex items-center space-x-3">
                    <input type="radio" value="false" {...register("gender", {
                        setValueAs: (v) => v === "false"
                    })} />
                    <span>Nam</span>
                    <input type="radio" value="true" {...register("gender", {
                        setValueAs: (v) => v === "true"
                    })} />
                    <span>Nữ</span>
                </div>
            </div>
            
            <div>
                <label htmlFor="address" className="block-text-sm font-medium text-gray-700">Địa chỉ</label>
                <input type="text" id="address" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" {...register("phone")} placeholder="Có thể để trống"/>
                { errors.address && <p className="text-red-600">
                    { errors.address.message }
                </p> }
            </div>

            <div>
                <label htmlFor="address" className="block-text-sm font-medium text-gray-700">Sinh nhật</label>
                <input type="date" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none"/>
                { errors.birthDay && <p className="text-red-600">
                    { errors.birthDay.message }
                </p> }
                <span className="text-gray-700 mt-2">
                    Có thể để trống
                </span>
            </div>
            <button type="submit"  className="w-full py-2 px-4 bg-primary hover:bg-accent text-white font-semibold rounded-lg transition duration-200">
                Đăng nhập
            </button>
        </form>
    )
}