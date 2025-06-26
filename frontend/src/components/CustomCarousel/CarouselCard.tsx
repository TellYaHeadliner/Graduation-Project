import AliceCarousel, { Link } from 'react-alice-carousel';
import 'react-alice-carousel/lib/alice-carousel.css';
import slug from "slug"

import CardItem from "../Card/CardItem";
import { Hotel } from '../../types/ListHotelsTypes';
interface CardListProps {
  cardList: Hotel[] | undefined;
  title: string;
}

export default function CarouselCard({ cardList, title }: CardListProps) {

  const items = cardList?.map((card) => (
    <div key={card.name}>
      <Link href={`/${slug(card.name)}/${card.id}`}>
        <CardItem
          avatar={card.avatar}
          name={card.name}
          address={card.address}
          star_rating={card.star_rating}
          reputation_score={card.reputation_score} 
          price={card.room_types[0].variants[0].base_price} 
          discountPrice={card.room_types[0].variants[0].discount_price}        
          />
      </Link>
    </div>
  ));


  return (
    <div className="w-full h-full my-3 lg:px-18 2xl:px-20 flex flex-wrap">
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
            items: 3,
          },
          1024: {
            items: 4
          },
          1920: {
            items: 5
          }
        }}
      >
        {items}
      </AliceCarousel>
    </div>
  );
}
