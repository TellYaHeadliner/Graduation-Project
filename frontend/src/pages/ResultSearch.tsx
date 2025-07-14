/* eslint-disable react-hooks/exhaustive-deps */
import MainLayout from "../layouts/MainLayout";
import useTitle from "../hooks/useTitle";
import SideBarFilter from "../components/Navbar/SidebarFilter";
import CardItemSearch from "../components/Card/CardItemSearch";
import FindHotel from "../components/FindHotel/FindHotel";
import { FindHotelProvider } from "../context/FindHotelContext";
import { useAmentities } from "../react-query/useAmentites";
import { FilterProvider } from "../context/FilterContext";
import { CardSearch } from "../types/SearchTypes";
import useQuery from "../hooks/useQuery";
import { useHotelSearch } from "../react-query/useHotelSearch";
import { Link, useLocation } from "react-router-dom";
import slug from "slug";
import { useEffect, useState } from "react";
import LoadingSpinner from "../components/Loading/LoadingSpinner";
import { Skeleton } from "@radix-ui/themes";


export default function ResultSearch() {

    useTitle("Kết quả tìm kiếm");

    const amenties = useAmentities();
    const queryParams = useQuery();
    
    const payload = {
        address: queryParams.get("address") ?? "",
        checkin: queryParams.get("checkin") ?? "",
        checkout: queryParams.get("checkout") ?? "",
        guest: Number(queryParams.get("guest") ?? "1"),
        children: Number(queryParams.get("children") ?? "0"),
        amenities: queryParams.getAll("amenities[]").map(Number),
        min_rating: Number(queryParams.get("min_rating") ?? "0"),
        min_price: Number(queryParams.get("min_price") ?? "0"),
        max_price: Number(queryParams.get("max_price") ?? "10000000"),
    }

    const location = useLocation();
    const path = location.pathname;
    const decodedPath = decodeURIComponent(path.substring(1))

    const defaultLoad = {
        address: decodedPath,
        checkin: new Date(Date.now()).toISOString().split('T')[0],
        checkout: new Date(Date.now() + 2 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
        guest: 2,
        children: 0
    }

    const isQueryEmpty =!queryParams.toString();
    const finalPayload = isQueryEmpty ? defaultLoad: payload;

    const [ searchPayload, setSearchPayload ] = useState(defaultLoad);

    useEffect(() => {
        setSearchPayload(finalPayload);
    }, [location.search]);

    const hotelSearch = useHotelSearch(searchPayload, true);
    const data = hotelSearch.data?.data

    return (
        <MainLayout>
            <FilterProvider>
                <div className="relative flex gap-x-4 lg:px-26 max-w-screen-xl mx-auto">
                    <div className="w-1/4 block">
                        {
                            hotelSearch.isPending ? (
                                <Skeleton width="300px" height="500px" className="my-4"/>
                            ) : (
                                <div className="sticky top-34">
                                    <SideBarFilter amenties={amenties.data?.data ?? []} />
                                </div>
                            )
                        } 

                    </div>
                    <div className="flex-1 space-y-4 mt-4">
                        
                        <FindHotelProvider>
                            <FindHotel />
                        </FindHotelProvider>
                        {
                            hotelSearch.isPending ? (
                                <div className="flex justify-center">
                                    <LoadingSpinner />
                                </div>
                            ) : data && data.length > 0 ? (
                            data?.map((item: CardSearch) => (
                                <Link key={item.id} to={`/${slug(item.name)}/${item.id}`}>
                                    <CardItemSearch data={item} />
                                </Link>
                            ))
                            ) : (
                                <div className="flex flex-col items-center justify-center">
                                    <span className="text-xl font-normal">
                                        Chúng tôi không tìm kiếm được kết quả của bạn
                                    </span>
                                </div>
                            )
                        }
                    </div>
                    
                </div>
            </FilterProvider>
        </MainLayout>
    )
}