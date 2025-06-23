export interface GhiChuType {
  adults: number;
  children: number;
  isHaveBreakfast: boolean;
  isSmoking: boolean;
  cancelBooking: string;
}

export interface TableRoomType {
  key: string;
  tenPhong: string;
  loaiPhong: string;
  soLuong: number;          
  soLuongKhach: number;    
  giaPhong: number;  
  giaGiam: number | null;
  ghiChu: GhiChuType[];
}

export const tableRoomData: TableRoomType[] = [
  {
    key: '1',
    tenPhong: 'Phòng Deluxe',
    loaiPhong: 'Giường đôi',
    soLuong: 2,
    soLuongKhach: 2,
    giaPhong: 850000,
    ghiChu: [
      {
        adults: 0,
        children: 0,
        isHaveBreakfast: false,
        isSmoking: false,
        cancelBooking: ""
      }
    ],
    giaGiam: 720000
  },
  {
    key: '2',
    tenPhong: 'Phòng Superior',
    loaiPhong: 'Giường đơn',
    soLuong: 1,
    soLuongKhach: 1,
    giaPhong: 650000,
    ghiChu: [
      {
        adults: 0,
        children: 0,
        isHaveBreakfast: false,
        isSmoking: false,
        cancelBooking: ""
      }
    ],
    giaGiam: null
  },
  {
    key: '3',
    tenPhong: 'Phòng Suite',
    loaiPhong: 'Giường King',
    soLuong: 3,
    soLuongKhach: 2,
    giaPhong: 1200000,
    ghiChu: [
      {
        adults: 0,
        children: 0,
        isHaveBreakfast: false,
        isSmoking: false,
        cancelBooking: ""
      }
    ],
    giaGiam: 900000
  },
  {
    key: '4',
    tenPhong: 'Phòng Gia đình',
    loaiPhong: '2 Giường đôi',
    soLuong: 4,
    soLuongKhach: 4,
    giaPhong: 1500000,
    ghiChu: [
      {
        adults: 2,
        children: 1,
        isHaveBreakfast: false,
        isSmoking: false,
        cancelBooking: ""
      }
    ],
    giaGiam: null
  },
];
