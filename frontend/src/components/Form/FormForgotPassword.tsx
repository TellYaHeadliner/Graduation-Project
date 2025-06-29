import { useForm } from "react-hook-form"
import { zodResolver } from "@hookform/resolvers/zod"
import { forgotPasswordSchema, ForgotPasswordSchema } from '../../schemas/forgotPasswordSchemas';
import { useNavigate } from "react-router-dom";
import { PATH } from "../../constants/Paths"

export default function FormForgotPassword(){

    const navigate = useNavigate()

    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm<ForgotPasswordSchema>({
        resolver: zodResolver(forgotPasswordSchema),
    });

    const onSubmit = () => {
        navigate(PATH.MAILGUI)
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)} method="post">
            <input type="email" {...register("email")} className="my-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:accent focus:outine-none" />
            { errors.email && <p className="text-red-500">
                { errors.email.message }
            </p> }
            <button type="submit" className="w-full mt-2 py-2 px-4 bg-primary hover:bg-accent text-white font-semibold rounded-lg transition duration-200">
                Gửi email
            </button>
        </form>
    )
}