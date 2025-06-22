import { Controller, useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { registerOwnerSchema } from "../../schemas/registerOwnerSchemas"; // Đường dẫn tùy bạn
import { z } from "zod";
import React, { useEffect, useState } from "react";

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
  const [galleryFiles, setGalleryFiles] = useState<File[]>([]);
  const [galleryPreview, setGalleryPreview] = useState<string[]>([]);

  useEffect(() => {
    if (avatarFile instanceof File) {
      setAvatarPreview(URL.createObjectURL(avatarFile));
    }
  }, [avatarFile]);

  useEffect(() => {
    if (Array.isArray(galleryFiles)) {
      const previews = galleryFiles.map((file) => URL.createObjectURL(file));
      setGalleryPreview(previews);
    }
  }, [galleryFiles]);


  const onSubmit = (data: RegisterOwnerForm) => {
    console.log("Dữ liệu gửi đi:", data);
  };

  return (
    <form onSubmit={handleSubmit(onSubmit)} className="space-y-4">
      <div>
        <label htmlFor="fullname" className="block-text-sm font-medium text-white">Email</label>
        <input {...register("email")} placeholder="Email" className="mt-1 bg-white block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:outline-none" />
        {errors.email && <p>{errors.email.message}</p>}
      </div>

      <div>
        <label htmlFor="password" className="block-text-sm font-medium text-white">Mật khẩu</label>
        <input {...register("password")} placeholder="Mật khẩu" type="password" className="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" />
        {errors.password && <p>{errors.password.message}</p>}
      </div>

      <div>
        <label htmlFor="password" className="block-text-sm font-medium text-white">Tên khách sạn</label>
        <input {...register("name")} placeholder="Tên khách sạn" className="bg-white mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" />
        {errors.name && <p>{errors.name.message}</p>}
      </div>

      <div>
        <label htmlFor="password" className="block-text-sm font-medium text-white">Địa chỉ</label>
        <input {...register("adresss")} placeholder="Địa chỉ" className="bg-white mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" />
        {errors.adresss && <p>{errors.adresss.message}</p>}
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
        <input {...register("mst")} placeholder="Mã số thuế" className="bg-white mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus accent focus:outline-none" />
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
          name="gallery"
          render={({ field }) => (
            <input
              type="file"
              accept="image/*"
              multiple
              onChange={(e) => {
                const file = e.target.files?.[0];
                if (file){
                  setGalleryFiles((prev) => [...prev, file]);
                  setGalleryPreview((prev) => [...prev, URL.createObjectURL(file)])
                } 
                e.target.value = ""
              }}
            />
          )}
        />
        {errors.gallery && <p className="text-red-500">{errors.gallery.message}</p>}
      </div>

      <div className="flex gap-2 flex-wrap overflow-y-auto">
        {galleryPreview.map((url, index) => (
          <img
            key={index}
            src={url}
            alt={`gallery-${index}`}
            className="w-24 h-24 object-cover rounded"
          />
        ))}
      </div>


      <button type="submit" className="bg-blue-500 text-white px-4 py-2 rounded">
        Đăng ký
      </button>
    </form>
  );
}
