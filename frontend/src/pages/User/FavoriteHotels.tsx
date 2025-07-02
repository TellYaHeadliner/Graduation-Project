import MainLayout from "../../layouts/MainLayout";

import useTitle from "../../hooks/useTitle";
import DataListFavoriteHotels from "../../components/DataList/DataListFavoriteHotels";
import { useFavoriteQuery } from "../../react-query/useFavoriteQuery";
import { Spinner } from "@radix-ui/themes";


export default function FavoriteHotels() {
    useTitle("Khách sạn yêu thích");

    const favoriteList = useFavoriteQuery();

    return (
        <MainLayout>
            <div className="flex flex-col w-full my-4 lg:px-24">
                <h1 className="text-3xl font-bold">
                    Khách sạn mà bạn yêu thích
                </h1>
                {
                    favoriteList.isPending ? (
                        <Spinner />
                    ) : (
                        <div>
                            <DataListFavoriteHotels datas={favoriteList.data?.data ?? []} />
                        </div>
                    )
                }
            </div>
            
        </MainLayout>
    )
}