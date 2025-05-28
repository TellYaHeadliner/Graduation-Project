import { faker } from '@faker-js/faker';

export interface CardItemType {
  key: number;
  title: string;
  address: string;
  star: number;
  price: number;
  discountPrice: number;
  reviewCount: number;
}

export const CardListStaticData: CardItemType[] = [
  {
    key: Date.now(),
    title: "Khách sạn Bình Minh",
    address: faker.location.streetAddress(),
    star: 3.1,
    discountPrice: 270000,
    reviewCount: faker.number.int({ min: 50, max: 500 }),
    price: 0
  },
  {
    key: Date.now() + 1,
    title: "Khách sạn Rạng Đông",
    address: faker.location.streetAddress(),
    star: 5,
    price: 500000,
    discountPrice: 450000,
    reviewCount: faker.number.int({ min: 100, max: 1000 }),
  },
  {
    key: Date.now() + 2,
    title: "Khách sạn Stephen",
    address: faker.location.streetAddress(),
    star: 3.5,
    price: 350000,
    discountPrice: 320000,
    reviewCount: faker.number.int({ min: 60, max: 600 }),
  },
  {
    key: Date.now() + 3,
    title: "Khách sạn Hoàng Gia",
    address: faker.location.streetAddress(),
    star: 4.2,
    price: 450000,
    discountPrice: 400000,
    reviewCount: faker.number.int({ min: 80, max: 800 }),
  },
  {
    key: Date.now() + 4,
    title: "Khách sạn Ngọc Lan",
    address: faker.location.streetAddress(),
    star: 2.8,
    price: 280000,
    discountPrice: 250000,
    reviewCount: faker.number.int({ min: 30, max: 300 }),
  },
  {
    key: Date.now() + 5,
    title: "Khách sạn Sài Gòn Pearl",
    address: faker.location.streetAddress(),
    star: 4.5,
    price: 600000,
    discountPrice: 540000,
    reviewCount: faker.number.int({ min: 90, max: 900 }),
  },
  {
    key: Date.now() + 6,
    title: "Khách sạn Đại Dương",
    address: faker.location.streetAddress(),
    star: 3.9,
    price: 400000,
    discountPrice: 360000,
    reviewCount: faker.number.int({ min: 70, max: 700 }),
  },
  {
    key: Date.now() + 7,
    title: "Khách sạn Mặt Trời Mọc",
    address: faker.location.streetAddress(),
    star: 4.7,
    price: 700000,
    discountPrice: 630000,
    reviewCount: faker.number.int({ min: 110, max: 1100 }),
  },
];
