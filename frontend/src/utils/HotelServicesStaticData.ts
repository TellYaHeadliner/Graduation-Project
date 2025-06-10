export const hotelServices = [
    "Wi-Fi miễn phí",
    "Bữa sáng",
    "Hồ bơi",
    "Phòng gym",
    "Dịch vụ giặt ủi",
    "Đưa đón sân bay",
    "Bãi đỗ xe",
    "Spa & Massage",
    "Lễ tân 24/7",
    "Dịch vụ phòng",
    "Nhà hàng",
    "Quầy bar",
    "Phòng không hút thuốc",
    "Két an toàn",
    "Tivi màn hình phẳng",
    "Điều hòa không khí",
    "Máy sấy tóc",
    "Bồn tắm",
    "Phòng họp/hội nghị",
    "Dịch vụ giữ hành lý"
];

export interface CombosType{
    tenCombo: string;
    moTa: string;
    giaCombo: number;
    giaGoc: number;
    uuDai: number;
    dichVu: dichVuType[];
}
export interface dichVuType{
  ten: string;
  soLuong: string
}

export const combos: CombosType[] = [
    {
      tenCombo: "Thư giãn tối đa",
      moTa: "Phù hợp cho kỳ nghỉ cuối tuần thư thái",
      giaCombo: 1050000,
      giaGoc: 1235000,
      uuDai: 15,
      dichVu: [
        { ten: "Phòng Deluxe", soLuong: "1 đêm" },
        { ten: "Massage 60", soLuong: "1 lần" },
        { ten: "Đưa đón sân bay", soLuong: "2 chiều" }
      ]
    },
    {
      tenCombo: "Kỳ nghỉ lãng mạn",
      moTa: "Dành cho các cặp đôi tận hưởng không gian riêng tư và lãng mạn",
      giaCombo: 1650000,
      giaGoc: 1950000,
      uuDai: 15,
      dichVu: [
        { ten: "Phòng Suite hướng biển", soLuong: "1 đêm" },
        { ten: "Bữa tối tại nhà hàng sang trọng", soLuong: "1 lần" },
        { ten: "Massage đôi", soLuong: "1 lần" },
        { ten: "Trang trí phòng đặc biệt", soLuong: "1 lần" }
      ]
    },
    {
      tenCombo: "Gia đình vui vẻ",
      moTa: "Combo lý tưởng cho chuyến du lịch gia đình trọn vẹn",
      giaCombo: 2450000,
      giaGoc: 2870000,
      uuDai: 15,
      dichVu: [
        { ten: "Phòng Family", soLuong: "2 đêm" },
        { ten: "Vé vào khu vui chơi trẻ em", soLuong: "2 trẻ" },
        { ten: "Buffet sáng", soLuong: "2 ngày" },
        { ten: "Đưa đón sân bay", soLuong: "2 chiều" }
      ]
    }
];