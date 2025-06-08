
export interface TableRoomType{
    key: string;
    tenPhong: string;
    loaiGiuong: string;
    soLuong: number;
}

export const tableRoomData: TableRoomType[] = [
    {
      key: '1',
      tenPhong: 'Phòng Deluxe',
      loaiGiuong: 'Giường đôi',
      soLuong: 2,
    },
    {
      key: '2',
      tenPhong: 'Phòng Superior',
      loaiGiuong: 'Giường đơn',
      soLuong: 1,
    },
    {
      key: '3',
      tenPhong: 'Phòng Suite',
      loaiGiuong: 'Giường King',
      soLuong: 3,
    },
    {
      key: '4',
      tenPhong: 'Phòng Gia đình',
      loaiGiuong: '2 Giường đôi',
      soLuong: 4,
    },
];