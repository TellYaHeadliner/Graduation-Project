export interface GhiChuType {
  note1: string | null;
  note2: string | null;
  note3: string | null;
}

export interface TableRoomType {
  key: string;
  tenPhong: string;
  loaiPhong: string;
  soLuong: number;          
  soLuongKhach: number;    
  giaPhong: number;  
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
        note1: "Hoàn tiền 100%",
        note2: "Miễn phí hủy phòng trước 24h",
        note3: "Có bao gồm bữa sáng"
      }
    ]
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
        note1: "Không hoàn tiền",
        note2: "Không bao gồm bữa sáng",
        note3: null
      }
    ]
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
        note1: "Có dịch vụ spa miễn phí",
        note2: "Check-in sớm miễn phí",
        note3: "Hồ bơi riêng"
      }
    ]
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
        note1: "Phù hợp cho nhóm hoặc gia đình",
        note2: "Miễn phí xe đưa đón sân bay",
        note3: "Có khu vui chơi trẻ em"
      }
    ]
  },
];
