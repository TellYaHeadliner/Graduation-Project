import { Controller, useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { registerOwnerSchema } from "../../schemas/registerOwnerSchemas"; // Đường dẫn tùy bạn
import { z } from "zod";
import  { useEffect, useState } from "react";
import { useRegisterHotelMutation } from "../../react-query/useRegisterHotelMutation";
import { ErrorUtils } from '../../utils/Error';
import DialogLoginComplete from "../Dialog/DialogLoginComplete";
import DialogLoading from "../Dialog/DialogLoading";
import { useNavigate } from "react-router-dom";

type RegisterOwnerForm = z.infer<typeof registerOwnerSchema>;

export default function RegisterOwnerForm() {
  const {
    register,
    handleSubmit,
    formState: { errors },
    watch,
    control
  } = useForm<RegisterOwnerForm>({
    resolver: zodResolver(registerOwnerSchema),
  });

  const avatarFile = watch("avatar");


  const [avatarPreview, setAvatarPreview] = useState<string | null>(null);

  useEffect(() => {
    if (avatarFile instanceof File) {
      setAvatarPreview(URL.createObjectURL(avatarFile));
    }
  }, [avatarFile]);


  const [isOpenDialog, setIsOpenDialog] = useState(false);

  const hotelRegister = useRegisterHotelMutation();
  const navigate = useNavigate();
  const onSubmit = (data: RegisterOwnerForm) => {
    const errorUtils = new ErrorUtils();

    const formattedData = {
      ...data,
      mst: Number(data.mst)
    }

    hotelRegister.mutate(formattedData, {
      onSuccess: () => {
        setIsOpenDialog(true);
        setTimeout(() => {
          navigate("/")
        }, 5000);
      },
      onError: (error) => {
        errorUtils.handleError(error);
      }
    })
  };

  return (
    <form onSubmit={handleSubmit(onSubmit)} className="space-y-4" encType='multipart/form-data'>
      <div>
        <label htmlFor="email" className="block-text-sm font-medium text-white">Email</label>
        <input {...register("email")} placeholder="Email" className="mt-1 bg-white block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:outline-none" />
        {errors.email && <p>{errors.email.message}</p>}
      </div>

      <div>
        <label htmlFor="password" className="block-text-sm font-medium text-white">Tên khách sạn</label>
        <input {...register("name")} placeholder="Tên khách sạn" className="bg-white mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" />
        {errors.name && <p>{errors.name.message}</p>}
      </div>

      <div>
        <label htmlFor="password" className="block-text-sm font-medium text-white">Địa chỉ</label>
        <input {...register("address")} placeholder="Địa chỉ" className="bg-white mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" />
        {errors.address && <p>{errors.address?.message}</p>}
      </div>

      <div>
        <label htmlFor="password" className="block-text-sm font-medium text-white mr-2">Số sao</label>
        <select {...register("star_rating")}>
          <option value="">Chọn số sao</option>
          <option value="1">1 sao</option>
          <option value="2">2 sao</option>
          <option value="3">3 sao</option>
          <option value="4">4 sao</option>
          <option value="5">5 sao</option>
        </select>
        {errors.star_rating && <p>{errors.star_rating.message}</p>}
      </div>

      <div>
        <label htmlFor="password" className="block-text-sm font-medium text-white mr-2">Mã số thuế</label>
        <input type="number" {...register("mst")} placeholder="Mã số thuế" className="bg-white mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" />
        {errors.mst && <p>{errors.mst.message}</p>}
      </div>

      <div>
        <label htmlFor="password" className="block-text-sm font-medium text-white mr-2">Số điện thoại</label>
        <input {...register("phone")} placeholder="Số điện thoại" className="bg-white mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" />
        {errors.phone && <p>{errors.phone.message}</p>}
      </div>

      <div>
        <label htmlFor="password" className="block-text-sm font-medium text-white mr-2">Tên ngân hàng</label>
        <input {...register("bank_name")} placeholder="Tên ngân hàng" className="bg-white mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" />
        {errors.bank_name && <p>{errors.bank_name.message}</p>}
      </div>

      <div>
        <label htmlFor="password" className="block-text-sm font-medium text-white mr-2">Tên tài khoản</label>
        <input {...register("bank_account_name")} placeholder="Tên tài khoản" className="bg-white mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" />
        {errors.bank_account_name && <p>{errors.bank_account_name.message}</p>}
      </div>

      <div>
        <label htmlFor="password" className="block-text-sm font-medium text-white mr-2">Số tài khoản</label>
        <input {...register("bank_account_number")} placeholder="Số tài khoản" className="bg-white mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" />
        {errors.bank_account_number && <p>{errors.bank_account_number.message}</p>}
      </div>

      <div>
        <label htmlFor="password" className="block-text-sm font-medium text-white mr-2">Ảnh đại diện</label>
        <Controller
          control={control}
          name="avatar"
          render={({ field }) => (
            <input
              type="file"
              accept="image/*"
              onChange={(e) => {
                const file = e.target.files?.[0];
                if (file) {
                  setAvatarPreview(URL.createObjectURL(file));
                  field.onChange(file); 
                } else {
                  field.onChange(null);
                }
              }}
              
            />
          )}
        />
        
        {errors.avatar && <p className="text-red-500">{errors.avatar.message}</p>}
      </div>
      
      {avatarPreview && (
        <div className="mt-2">
          <img
            src={avatarPreview}
            alt="Avatar Preview"
            className="w-24 h-24 object-cover rounded"
          />
        </div>
      )}
      {
        isOpenDialog === true && (
          <DialogLoginComplete title="Đăng kí khách sạn thành công" isOpen={isOpenDialog}/>
        )
      }
      {
        hotelRegister.isPending && (
          <DialogLoading isOpen={true}/>
        )
      }

      <button type="submit" className="bg-blue-500 text-white px-4 py-2 rounded">
        Đăng ký
      </button>
    </form>
  );
}
