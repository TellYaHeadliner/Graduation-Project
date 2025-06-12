import { useForm } from "react-hook-form"
import { zodResolver } from "@hookform/resolvers/zod"
import { paymentSchemas, PaymentSchema } from "../../guards/paymentSchemas"

export default function FormPayment() {

    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm<PaymentSchema>({
        resolver: zodResolver(paymentSchemas),
    });

    const onSubmit = (data) => {
        console.log(data)
    }

    return (
        <form className="max-w-xl space-y-4 bg-gray-50 p-6 rounded-md" onSubmit={handleSubmit(onSubmit)}>
            {/* Họ và tên */}
            <div>
                <label className="block text-sm font-medium text-gray-700">Họ và tên</label>
                <input
                    type="text"
                    className="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    {...register('fullname', { required: 'Họ và tên là bắt buộc' })}
                    value="Nguyễn Văn A"
                    readOnly
                />
            </div>

            {/* Email */}
            <div>
                <label className="block text-sm font-medium text-gray-700">Địa chỉ email</label>
                <input
                    type="email"
                    className="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="abc@example.com"
                    {...register('email')}
                    value="abc@gmail.com"
                    readOnly
                />
            </div>

            {/* Số điện thoại */}
            <div>
                <label className="block text-sm font-medium text-gray-700">Số điện thoại</label>
                <input
                    type="tel"
                    className="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    {...register('phone')}
                    value="0123456789"
                    readOnly
                />
            </div>

            {/* Địa chỉ */}
            <div>
                <label className="block text-sm font-medium text-gray-700">Địa chỉ</label>
                <input
                    type="text"
                    className="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    {...register("address")}
                />
                {errors.address && <p className="text-red-500">
                    {errors.email?.message}
                </p> }
            </div>

            {/* Yêu cầu */}
            <div>
                <label className="block text-sm font-medium text-gray-700">Yêu cầu</label>
                <p className="text-xs text-gray-500">Bạn có yêu cầu gì với khách sạn?</p>
                <input
                    {...register('request')}
                    type="text"
                    className="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                />
            </div>

            {/* Check-in */}
            <div>
                <label className="block text-sm font-medium text-gray-700">Thời gian check-in</label>
                <select 
                    className="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    {...register('checkIn')}>
                    <option>14:00</option>
                    <option>15:00</option>
                </select>
                {errors.checkIn && <p className="text-red-500">
                    { errors.checkIn.message }
                </p> }
            </div>

            

        </form>
    )
}