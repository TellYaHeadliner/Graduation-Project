import MainLayout from "../../layouts/MainLayout";

import useTitle from "../../hooks/useTitle";
import DataListFavoriteHotels from "../../components/DataList/DataListFavoriteHotels";


export default function FavoriteHotels() {
    useTitle("Khách sạn yêu thích");

    return (
        <MainLayout>
            <div className="flex flex-wrap w-full my-4 lg:px-24">
                <h1 className="text-3xl font-bold">
                    Khách sạn mà bạn yêu thích
                </h1>
                <DataListFavoriteHotels />
            </div>
            
        </MainLayout>
    )
}