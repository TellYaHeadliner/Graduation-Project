import { faker } from '@faker-js/faker';

export interface CardItemType {
    key: number;
    title: string;
    address: string;
    star: number;
    price: number;
}

export const CardListStaticData: CardItemType[] = [
  {
    key: Date.now(),
    title: "Khách sạn Bình Minh",
    address: faker.location.street(),
    star: 3.1,
    price: 300000,
  },
  {
    key: Date.now() + 1,
    title: "Khách sạn Rạng Đông",
    address: faker.location.street(),
    star: 5,
    price: 500000,
  },
  {
    key: Date.now() + 2,
    title: "Khách sạn Stephen",
    address: faker.location.street(),
    star: 3.5,
    price: 350000,
  },
  {
    key: Date.now() + 3,
    title: "Khách sạn Hoàng Gia",
    address: faker.location.street(),
    star: 4.2,
    price: 450000,
  },
  {
    key: Date.now() + 4,
    title: "Khách sạn Ngọc Lan",
    address: faker.location.street(),
    star: 2.8,
    price: 280000,
  },
  {
    key: Date.now() + 5,
    title: "Khách sạn Sài Gòn Pearl",
    address: faker.location.street(),
    star: 4.5,
    price: 600000,
  },
  {
    key: Date.now() + 6,
    title: "Khách sạn Đại Dương",
    address: faker.location.street(),
    star: 3.9,
    price: 400000,
  },
  {
    key: Date.now() + 7,
    title: "Khách sạn Mặt Trời Mọc",
    address: faker.location.street(),
    star: 4.7,
    price: 700000,
  },
];