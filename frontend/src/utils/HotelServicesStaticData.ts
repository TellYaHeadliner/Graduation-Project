export interface hotelServiceType{
  name: string;
  price: number;
}

export const hotelServices = [
  { name: "Wi-Fi miễn phí", price: 0 },
  { name: "Bữa sáng", price: 100_000 },
  { name: "Hồ bơi", price: 50_000 },
  { name: "Phòng gym", price: 70_000 },
  { name: "Dịch vụ giặt ủi", price: 30_000 },
  { name: "Đưa đón sân bay", price: 200_000 },
  { name: "Bãi đỗ xe", price: 20_000 },
  { name: "Spa & Massage", price: 300_000 },
  { name: "Lễ tân 24/7", price: 0 },
  { name: "Dịch vụ phòng", price: 40_000 },
  { name: "Nhà hàng", price: 0 }, // miễn phí nếu chỉ là phục vụ, tùy chọn món tính sau
  { name: "Quầy bar", price: 0 }, // đồ uống tính riêng
  { name: "Phòng không hút thuốc", price: 0 },
  { name: "Két an toàn", price: 10_000 },
  { name: "Tivi màn hình phẳng", price: 0 },
  { name: "Điều hòa không khí", price: 0 },
  { name: "Máy sấy tóc", price: 0 },
  { name: "Bồn tắm", price: 0 },
  { name: "Phòng họp/hội nghị", price: 500_000 },
  { name: "Dịch vụ giữ hành lý", price: 0 }
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