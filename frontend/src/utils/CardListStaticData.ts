import { faker } from '@faker-js/faker';

export interface CardItemType {
  key: number;
  title: string;
  address: string;
  star: number;
  price: number | null;
  discountPrice: number | null;
  reviewCount: number;
}

export const CardListStaticData: CardItemType[] = [
  {
    key: Date.now(),
    title: "Khách sạn Bình Minh",
    address: faker.location.streetAddress(),
    star: 3.1,
    price: null,
    discountPrice: null,
    reviewCount: faker.number.int({ min: 50, max: 500 }),
  },
  {
    key: Date.now() + 1,
    title: "Khách sạn Rạng Đông",
    address: faker.location.streetAddress(),
    star: 5,
    price: null,
    discountPrice: null,
    reviewCount: faker.number.int({ min: 100, max: 1000 }),
  },
  {
    key: Date.now() + 2,
    title: "Khách sạn Stephen",
    address: faker.location.streetAddress(),
    star: 3.5,
    price: null,
    discountPrice: null,
    reviewCount: faker.number.int({ min: 60, max: 600 }),
  },
  {
    key: Date.now() + 3,
    title: "Khách sạn Hoàng Gia",
    address: faker.location.streetAddress(),
    star: 4.2,
    price: null,
    discountPrice: null,
    reviewCount: faker.number.int({ min: 80, max: 800 }),
  },
  {
    key: Date.now() + 4,
    title: "Khách sạn Ngọc Lan",
    address: faker.location.streetAddress(),
    star: 2.8,
    price: null,
    discountPrice: null,
    reviewCount: faker.number.int({ min: 30, max: 300 }),
  },
  {
    key: Date.now() + 5,
    title: "Khách sạn Sài Gòn Pearl",
    address: faker.location.streetAddress(),
    star: 4.5,
    price: null,
    discountPrice: null,
    reviewCount: faker.number.int({ min: 90, max: 900 }),
  },
  {
    key: Date.now() + 6,
    title: "Khách sạn Đại Dương",
    address: faker.location.streetAddress(),
    star: 3.9,
    price: null,
    discountPrice: null,
    reviewCount: faker.number.int({ min: 70, max: 700 }),
  },
  {
    key: Date.now() + 7,
    title: "Khách sạn Mặt Trời Mọc",
    address: faker.location.streetAddress(),
    star: 4.7,
    price: null,
    discountPrice: null,
    reviewCount: faker.number.int({ min: 110, max: 1100 }),
  },
];

export const CardListWithPriceData: CardItemType[] = [
  {
    key: Date.now() + 10,
    title: "Khách sạn Hương Sen",
    address: faker.location.streetAddress(),
    star: 4.0,
    price: 550000,
    discountPrice: 500000,
    reviewCount: faker.number.int({ min: 100, max: 800 }),
  },
  {
    key: Date.now() + 11,
    title: "Khách sạn Ánh Dương",
    address: faker.location.streetAddress(),
    star: 3.8,
    price: 420000,
    discountPrice: 390000,
    reviewCount: faker.number.int({ min: 80, max: 700 }),
  },
  {
    key: Date.now() + 12,
    title: "Khách sạn Đại Phát",
    address: faker.location.streetAddress(),
    star: 4.5,
    price: 650000,
    discountPrice: 600000,
    reviewCount: faker.number.int({ min: 120, max: 1000 }),
  },
  {
    key: Date.now() + 13,
    title: "Khách sạn Minh Tâm",
    address: faker.location.streetAddress(),
    star: 4.3,
    price: 480000,
    discountPrice: 440000,
    reviewCount: faker.number.int({ min: 90, max: 750 }),
  },
  {
    key: Date.now() + 14,
    title: "Khách sạn Trúc Xanh",
    address: faker.location.streetAddress(),
    star: 3.9,
    price: 390000,
    discountPrice: 350000,
    reviewCount: faker.number.int({ min: 60, max: 600 }),
  },
  {
    key: Date.now() + 15,
    title: "Khách sạn Phương Nam",
    address: faker.location.streetAddress(),
    star: 5.0,
    price: 750000,
    discountPrice: 700000,
    reviewCount: faker.number.int({ min: 150, max: 1200 }),
  },
];

