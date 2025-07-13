import { User } from "../../types/UserTypes";
import DialogChangePassword from "../Dialog/DialogChangePassword";

interface PersonalInfoSectionProps {
  user: User | null;
}

export default function PersonalInfoSection({ user }: PersonalInfoSectionProps) {
  const infoItems = [
    {
      label: 'Họ và tên',
      value: user?.fullname || "Chưa có tên",
      action: 'Chỉnh sửa',
    },
    {
      label: 'Địa chỉ email',
      value: user?.email || "Chưa có email",
      description: 'Đây là địa chỉ email bạn dùng để đăng nhập. Chúng tôi cũng sẽ gửi các xác nhận đặt chỗ tới địa chỉ này.',
      action: 'Chỉnh sửa',
    },
    {
      label: 'Số điện thoại',
      value: user?.phone || "Chưa có số điện thoại",
      description: 'Chỗ nghỉ hoặc địa điểm tham quan bạn đặt sẽ liên lạc với bạn qua số này nếu cần.',
      action: 'Chỉnh sửa',
    },
    {
      label: 'Ngày sinh',
      value: user?.birthDay || "Chưa có ngày sinh",
      action: 'Chỉnh sửa',
    },
    {
      label: 'Giới tính',
      value: user?.gender === 0 ? "Nam" : "Nữ",
      action: 'Chỉnh sửa',
    },
    {
      label: 'Địa chỉ',
      value: user?.address || "Chưa có địa chỉ",
      action: 'Chỉnh sửa',
    },
    {
      label: "Được tạo vào ngày",
      value: user?.created_at
        ? new Date(user?.created_at).toLocaleDateString("vi-VN")
        : "Chưa cập nhật"
    }
  ];

  return (
    <div className="space-y-4 lg:px-26 py-2">
      <h1 className="text-2xl font-bold mb-2">Thông tin cá nhân</h1>
      {infoItems.map((item, index) => (
        <div
          key={index}
          className="border-b py-3 flex flex-col md:flex-row md:items-start justify-between gap-2"
        >
          <div className="min-w-[150px] text-gray-700 font-medium">{item.label}</div>
          <div className="flex-1">
            <p className="text-gray-900">
              {item.value}
            </p>
            {item.description && (
              <p className="text-sm text-gray-500 mt-1">{item.description}</p>
            )}
          </div>
        </div>
      ))}
      <DialogChangePassword />
    </div>
  );
}