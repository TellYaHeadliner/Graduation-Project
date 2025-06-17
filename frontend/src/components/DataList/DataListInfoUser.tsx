export default function PersonalInfoSection() {
    const infoItems = [
      {
        label: 'Tên',
        value: 'Bảo Lâm Bùi',
        action: 'Chỉnh sửa',
      },
      {
        label: 'Tên hiển thị',
        value: 'Chọn tên hiển thị',
        action: 'Chỉnh sửa',
      },
      {
        label: 'Địa chỉ email',
        value: 'losmar2k4@gmail.com',
        verified: true,
        description: 'Đây là địa chỉ email bạn dùng để đăng nhập. Chúng tôi cũng sẽ gửi các xác nhận đặt chỗ tới địa chỉ này.',
        action: 'Chỉnh sửa',
      },
      {
        label: 'Số điện thoại',
        value: 'Thêm số điện thoại của bạn',
        description: 'Chỗ nghỉ hoặc địa điểm tham quan bạn đặt sẽ liên lạc với bạn qua số này nếu cần.',
        action: 'Chỉnh sửa',
      },
      {
        label: 'Ngày sinh',
        value: 'Nhập ngày sinh của bạn',
        action: 'Chỉnh sửa',
      },
      {
        label: 'Quốc tịch',
        value: 'Chọn vùng/quốc gia của bạn',
        action: 'Chỉnh sửa',
      },
      {
        label: 'Giới tính',
        value: 'Chọn giới tính',
        action: 'Chỉnh sửa',
      },
      {
        label: 'Địa chỉ',
        value: 'Nhập địa chỉ',
        action: 'Chỉnh sửa',
      },
      {
        label: 'Thông tin hộ chiếu',
        value: 'Chưa cung cấp',
        action: 'Thêm hộ chiếu',
      },
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
                {item.verified && (
                  <span className="ml-2 bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded">
                    Xác thực
                  </span>
                )}
              </p>
              {item.description && (
                <p className="text-sm text-gray-500 mt-1">{item.description}</p>
              )}
            </div>
            <button className="text-blue-600 text-sm whitespace-nowrap hover:underline">
              {item.action}
            </button>
          </div>
        ))}
      </div>
    );
}