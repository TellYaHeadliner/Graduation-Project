import AliceCarousel, { Link } from 'react-alice-carousel';
import 'react-alice-carousel/lib/alice-carousel.css';
import  { Heading } from "@radix-ui/themes"

import CardItem from "../Card/CardItem";
import { CardItemType } from "../../utils/CardListStaticData";

interface CardListProps {
  cardList: CardItemType[];
}


export default function CarouselCard({ cardList }: CardListProps) {
  const items = cardList.map((card) => (
    <div key={card.key} >
      <Link href="#">
        <CardItem
          title={card.title}
          address={card.address}
          star={card.star}
          price={card.price}
        />
      </Link>
    </div>
  ));

  return (
    <div className="w-full mt-4 lg:px-22 2xl:px-34 flex flex-wrap">
      <Heading as="h4" className="pb-2">
        Khách sạn để bạn quan tâm
      </Heading>
      <AliceCarousel
        mouseTracking
        controlsStrategy="alternate"
        disableDotsControls
        infinite
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
          1920: {
            items: 5
          },
        }}
      >
        {items}
      </AliceCarousel>
    </div>
  );
}
