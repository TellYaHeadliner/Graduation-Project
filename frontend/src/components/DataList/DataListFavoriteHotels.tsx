import slug from "slug";
import { FavoriteHotels } from "../../types/FavoritesTypes";

import CardFavorite from "../Card/CardFavorite";

interface Props{
    datas: FavoriteHotels[];
}

export default function DataListFavoriteHotels({ datas }: Props){

    return (
        <div className="grid grid-cols-4 gap-x-6 gap-y-6 mt-4">
            {datas.map((data) => (
                <CardFavorite 
                key={data.id}
                id={data.id} 
                name={data.name} 
                address={data.address} 
                avatar={data.avatar} 
                slug={slug(data.name)}  
                />
            ))}
        </div>
    )
}