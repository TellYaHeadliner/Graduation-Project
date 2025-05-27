import AliceCarousel, { Link } from 'react-alice-carousel';
import 'react-alice-carousel/lib/alice-carousel.css';
import { Container, Heading } from "@radix-ui/themes"

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
    <Container className="mt-2">
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
          }
        }}
      >
        {items}
      </AliceCarousel>
    </Container>
  );
}
