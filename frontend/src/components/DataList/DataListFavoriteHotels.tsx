import { CardListStaticData } from "../../utils/CardListStaticData";
import CardItem from "../Card/CardItem";

export default function DataListFavoriteHotels(){
    return (
        <div className="grid grid-cols-4 gap-x-6 gap-y-6 mt-4">
            {CardListStaticData.map((cardItem) => (
                <a href="">
                    <CardItem
                        title={cardItem.title}
                        address={cardItem.address}
                        star={cardItem.star}
                        price={cardItem.price}
                        reviewCount={cardItem.reviewCount}
                        discountPrice={cardItem.discountPrice}
                    />
                </a>
            ))}
        </div>
    )
}