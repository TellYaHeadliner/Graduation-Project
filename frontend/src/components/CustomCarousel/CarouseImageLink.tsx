import AliceCarousel from 'react-alice-carousel';
import 'react-alice-carousel/lib/alice-carousel.css';

import ad_hotel_1 from "../../assets/Ad_hotel_1.png"
import ad_hotel_2 from "../../assets/Ad_hotel_2.png"
import ad_hotel_3 from "../../assets/Ad_hotel_3.png"

export default function CarouselImageLink() {

  const items = [
    <div className="item w-full">
      <img src={ad_hotel_1} alt={ad_hotel_1} />
    </div>,
    <div className="item w-full">
      <img src={ad_hotel_2} alt={ad_hotel_2} />
    </div>,
    <div className="item w-full">
      <img src={ad_hotel_3} alt={ad_hotel_3} />
    </div>
  ]
  return (
    <AliceCarousel 
      autoPlay
      autoPlayInterval={1000}
      animationDuration={1000}
      disableButtonsControls
      items={items}
      infinite
    />
  );
}