import AliceCarousel, { Link } from 'react-alice-carousel';
import 'react-alice-carousel/lib/alice-carousel.css';
import slug from "slug"

import CardItem from "../Card/CardItem";
import { Hotel } from '../../types/ListHotelsTypes';
import { useShortCheckFavorites } from '../../react-query/useShortCheckFavorites';

interface CardListProps {
  cardList: Hotel[] | undefined;
  title: string;
}

export default function CarouselCard({ cardList, title }: CardListProps) {
  const checkShortFavorites = useShortCheckFavorites();
  const favorites = checkShortFavorites.data?.data.map((item) => ({
    id: item.id,
    is_favorite: item.is_favorite
  })) ?? [];

  const items = cardList?.map((card) => (
    <Link href={`/${slug(card.name)}/${card.id}`} key={card.id}>
      <CardItem
        id={card.id}
        avatar={card.avatar}
        name={card.name}
        address={card.address}
        star_rating={card.star_rating}
        avg_star={card.avg_star}
        total_reviews={card.total_reviews}
        price={card.base_price}
        discountPrice={card.discount_price}
        slug={slug(card.name)}
        is_favorite={favorites.find((fav) => fav.id === card.id)?.is_favorite ?? false}
      />
    </Link>
  ));

  return (
    <div className="w-full h-full my-3 lg:px-18 2xl:px-20 flex flex-wrap">
      <h2 className="text-2xl font-bold mb-2">{title}</h2>
      <AliceCarousel
        mouseTracking
        infinite
        controlsStrategy="alternate"
        disableDotsControls
        autoPlay={false}
        responsive={{
          0: { items: 1, itemsFit: "contain" },
          640: { items: 2 },
          768: { items: 3 },
          1024: { items: 4 },
          1920: { items: 5 }
        }}
      >
        {items}
      </AliceCarousel>
    </div>
  );
}
