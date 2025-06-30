import MainLayout from "../layouts/MainLayout";
import useTitle from "../hooks/useTitle";
import SideBarFilter from "../components/Navbar/SidebarFilter";
import CardItemSearch from "../components/Card/CardItemSearch";
import FindHotel from "../components/FindHotel/FindHotel";
import { FindHotelProvider } from "../context/FindHotelContext";
import { useAmentities } from "../react-query/useAmentites";
import { FilterProvider } from "../context/FilterContext";
import { useLocation } from "react-router-dom";
import { useQueryClient } from "@tanstack/react-query";
import { CardSearch } from "../types/SearchTypes";


export default function ResultSearch() {

    useTitle("Kết quả tìm kiếm");

    const amenties = useAmentities();
    const queryClient = useQueryClient();
    const data = queryClient.getQueryData(['search-result']);
    console.log(data)

    return (
        <MainLayout>
            <FilterProvider>
                <div className="relative flex gap-x-4 lg:px-26 max-w-screen-xl mx-auto">
                    <div className="w-1/4 block">
                        <div className="sticky top-34">
                            <SideBarFilter amenties={amenties.data?.data ?? []} />
                        </div>
                    </div>
                    <div className="flex-1 space-y-4 mt-4">
                        <FindHotelProvider>
                            <FindHotel />
                        </FindHotelProvider>
                        {
                            data?.map((item: CardSearch) => (
                                <CardItemSearch data={item} />
                            ))
                        }
                    </div>
                    
                </div>
            </FilterProvider>
        </MainLayout>
    )
}