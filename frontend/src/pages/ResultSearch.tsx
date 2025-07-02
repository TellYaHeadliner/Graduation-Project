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
import { Link } from "react-router-dom";
import slug from "slug";


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
    }

    const hotelSearch = useHotelSearch(payload, true);
    const data = hotelSearch.data?.data


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
                                <Link key={item.id} to={`/${slug(item.name)}/${item.id}`}>
                                    <CardItemSearch data={item} />
                                </Link>
                            ))
                        }
                    </div>
                    
                </div>
            </FilterProvider>
        </MainLayout>
    )
}