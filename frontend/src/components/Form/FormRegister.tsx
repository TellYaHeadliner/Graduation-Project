import { useForm } from "react-hook-form"
import { zodResolver } from "@hookform/resolvers/zod"
import { registerSchema, RegisterSchema } from "../../guards/registerSchemas"
import { useState } from "react";
import authApi from "../../api/Auth.api";
import { ErrorUtils } from "../../utils/Error";
import { useNavigate } from "react-router-dom";
import DialogLoginComplete from "../Dialog/DialogLoginComplete";

export interface newFormattedForm {
    fullname: string;
    email: string;
    password: string;
    confirmPassword: string;
    phone: string;
    gender: 0 | 1;
    address: string;
    avatar: File;
    birthday: string;
}

export default function FormRegister() {
    const {
        register,
        handleSubmit,
        formState: { errors },
        setValue
    } = useForm<RegisterSchema>({
        resolver: zodResolver(registerSchema),
    });

    const [previewImage, setPreviewImage] = useState<string | null>(null);
    const [isOpenDialog, setIsOpenDialog] = useState(false);
    const navigate = useNavigate();

    const onSubmit = async (data: RegisterSchema) => {
        const errorHandler = new ErrorUtils();

        try {
            const newFormData: newFormattedForm = {
                ...data,
                gender: data.gender === "false" ? 0 : 1,
                avatar: data.avatar,
                birthday: data.birthday
            };
            const responseSignIn = await authApi.signIn(newFormData);
            if (responseSignIn) {
                setIsOpenDialog(true);
                setTimeout(() => {
                    navigate("/");
                }, 5000);
            }
        } catch (error) {
            errorHandler.handleError(error);
        }
    }

    const handleFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const file = event.target.files?.[0];
        if (file) {
            setValue("avatar", file)
            const url = URL.createObjectURL(file)
            setPreviewImage(url);
        }
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)} className="space-y-4" method="POST" encType="multipart/form-data">
            <div>
                <label htmlFor="fullname" className="block-text-sm font-medium text-gray-700">Họ và tên</label>
                <input type="text" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:accent focus:outline-none" placeholder="Nguyễn Văn A"
                    {...register("fullname")} />
                {errors.fullname && <p className="text-red-500">{errors.fullname.message}</p>}
            </div>
            <div>
                <label htmlFor="email" className="block-text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:outline-none" placeholder="abc@example.com"
                    {...register("email")} autoComplete="new-password"
                />
                {errors.email && <p className="text-red-500">
                    {errors.email.message}
                </p>}
            </div>

            <div>
                <label htmlFor="password" className="block-text-sm font-medium text-gray-700">Mật khẩu</label>
                <input type="password" id="password" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none"
                    {...register("password")} autoComplete="new-password"
                />
                {errors.password && <p className="text-red-500">
                    {errors.password.message}
                </p>}
            </div>

            <div>
                <label htmlFor="confirmPassword" className="block-text-sm font-medium text-gray-700">Xác nhận mật khẩu</label>
                <input type="password" id="confirmPassword" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none"
                    {...register("confirmPassword")} autoComplete="new-password"
                />
                {errors.confirmPassword && <p className="text-red-500">
                    {errors.confirmPassword.message}
                </p>}
            </div>

            <div>
                <label htmlFor="phone" className="block-text-sm font-medium text-gray-700">Số điện thoại</label>
                <input type="tel" id="phone" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:outline-none"
                    {...register("phone")}
                />
                {errors.phone && <p className="text-red-600">
                    {errors.phone.message}
                </p>}
            </div>

            <div>
                <label htmlFor="gender" className="block-text-sm font-medium text-gray-700">Giới tính</label>
                <div className="flex items-center space-x-3">
                    <input
                        type="radio"
                        value="false"
                        {...register("gender", {
                            setValueAs: (v) => v === "false",
                        })}
                    />
                    <span>Nam</span>
                    <input
                        type="radio"
                        value="true"
                        {...register("gender", {
                            setValueAs: (v) => v === "true",
                        })}
                    />
                    <span>Nữ</span>
                </div>
                {errors.gender && <p className="text-red-600">
                    {errors.gender.message}
                </p>}
            </div>

            <div>
                <label htmlFor="address" className="block-text-sm font-medium text-gray-700">Địa chỉ</label>
                <input type="text" id="address" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:outline-none" {...register("address")} />
                {errors.address && <p className="text-red-600">
                    {errors.address.message}
                </p>}
            </div>

            <div>
                <label htmlFor="avatar" className="text-white mr-2">Ảnh đại diện</label>
                <input
                    type="file"
                    accept="image/*"
                    className="input text-white"
                    onChange={handleFileChange}
                />
                {errors.avatar && <p className="text-red-500">{errors.avatar.message}</p>}
                {previewImage && (
                    <img
                        src={previewImage}
                        alt="Ảnh xem trước"
                        className="mt-2 w-32 h-32 object-cover rounded-full border mx-auto"
                    />
                )}
            </div>

            <div>
                <label htmlFor="birthdate" className="block mb-1 font-medium">Ngày sinh</label>
                <input
                    type="date"
                    id="birthdate"
                    {...register("birthday")}
                    className="w-full border border-gray-300 rounded px-3 py-2"
                />
                {errors.birthday && (
                    <p className="text-red-500 text-sm mt-1">{errors.birthday.message}</p>
                )}
            </div>

            <button type="submit" className="w-full py-2 px-4 bg-primary hover:bg-accent text-white font-semibold rounded-lg transition duration-200">
                Đăng kí
            </button>

            <DialogLoginComplete title="Đăng kí thành công" isOpen={isOpenDialog} />
        </form>
    )
}