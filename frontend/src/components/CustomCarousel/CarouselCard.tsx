import AliceCarousel from 'react-alice-carousel';
import 'react-alice-carousel/lib/alice-carousel.css';
import { Flex, Container } from "@radix-ui/themes"

import CardItem from "../Card/CardItem";
import { CardItemType } from "../../utils/CardListStaticData";

interface CardListProps {
  cardList: CardItemType[];
}


export default function CarouselCard({ cardList }: CardListProps) {

    const chunkArray = (arr: CardItemType[], size: number) => {
        const result = [];
        for (let i = 0; i < arr.length; i += size) {
          result.push(arr.slice(i, i + size));
        }
        return result;
    };

    const chunkedList = chunkArray(cardList, 2)

    const items = chunkedList.map((group, index) => (
        <Flex key={index} gap="4" justify="start" className="slide-group" >
          {group.map((card) => (
            <CardItem key={card.key} title={card.title} address={card.address} star={card.star} price={card.price} />
          ))}
        </Flex>
      ));
      
    return (
        <Container className="mt-4">
            <AliceCarousel 
            mouseTracking 
            controlsStrategy="alternate" 
            disableDotsControls 
            infinite
            >
            {items}
        </AliceCarousel>
        </Container>
    );
}
