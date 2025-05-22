import { AspectRatio } from "radix-ui";
import { Carousel } from 'antd';

import ad_hotel_1 from "../../assets/Ad_hotel_1.png"
import ad_hotel_2 from "../../assets/Ad_hotel_2.png"
import ad_hotel_3 from "../../assets/Ad_hotel_3.png"


export default function CarouselImageLink() {
  return (
    <Carousel autoplay dotPosition="bottom">
      <AspectRatio.Root ratio={3 / 2}>
        <img
          src={ad_hotel_1}
          alt={ad_hotel_1}
          className="w-96 h-64 object-cover"
        />
      </AspectRatio.Root>
      <AspectRatio.Root ratio={3 / 2}>
        <img
          src={ad_hotel_2}
          alt={ad_hotel_2}
          className="w-96 h-64 object-cover"
        />
      </AspectRatio.Root>
      <AspectRatio.Root ratio={3 / 2}>
        <img
          src={ad_hotel_3}
          alt={ad_hotel_3}
          className="w-96 h-64 object-cover"
        />
      </AspectRatio.Root>
    </Carousel>
  );
}