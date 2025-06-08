import MainLayout from "../layouts/MainLayout";
import useTitle from "../hooks/useTitle";
import SideBarFilter from "../components/Navbar/SidebarFilter";
import CardItemSearch from "../components/Card/CardItemSearch";
import useQuery from "../hooks/useQuery";
import FindHotel from "../components/FindHotel/FindHotel";


export default function Home() {
    const { query } = useQuery();

    useTitle("Kết quả tìm kiếm");

    return (
        <MainLayout>
            <div className="relative flex gap-x-4 lg:px-26 max-w-screen-xl mx-auto">
                <div className="w-1/4 block">
                    <div className="sticky top-34">
                        <SideBarFilter />
                    </div>
                </div>
                <div className="flex-1 space-y-4 mt-4">
                    <FindHotel />
                    <h1 className="text-xl font-normal mt-4">
                        Kết quả tìm kiếm: {query}
                    </h1>
                    <CardItemSearch />
                </div>
            </div>
        </MainLayout>
    )
}