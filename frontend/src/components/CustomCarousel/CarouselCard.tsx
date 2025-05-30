import AliceCarousel, { Link } from 'react-alice-carousel';
import 'react-alice-carousel/lib/alice-carousel.css';


import CardItem from "../Card/CardItem";
import { CardItemType } from "../../utils/CardListStaticData";

interface CardListProps {
  cardList: CardItemType[];
  title: string;
}


export default function CarouselCard({ cardList, title }: CardListProps) {

  const items = cardList.map((card) => (
    <div key={card.key} >
      <Link href="">
        <CardItem
          title={card.title}
          address={card.address}
          star={card.star}
          price={card.price}
          reviewCount={card.reviewCount}
          discountPrice={card.discountPrice}
        />
      </Link>
    </div>
  ));


  return (
    <div className="w-full h-full my-3 lg:px-15 2xl:px-16 flex flex-wrap">
      <h2 className="text-2xl font-bold mb-2">
        {title}
      </h2>
      <AliceCarousel
        mouseTracking
        controlsStrategy="alternate"
        disableDotsControls
        responsive={{
          0: {
            items: 1,
            itemsFit: "contain",
          },
          640: {
            items: 2
          },
          768: {
            items: 3
          },
          1024: {
            items: 4
          },
        }}
      >
        {items}
      </AliceCarousel>
    </div>
  );
}
