import MainLayout from "../layouts/MainLayout";
import useTitle from "../hooks/useTitle";
import SideBarFilter from "../components/Navbar/SidebarFilter";
import CardItemSearch from "../components/Card/CardItemSearch";


export default function Home() {
    useTitle("Kết quả tìm kiếm");

    return (
        <MainLayout>
            <div className="relative flex justify-between lg:px-26 max-w-screen-xl mx-auto ">
                <div className="w-1/4 block">
                    <div className="sticky top-34">
                        <SideBarFilter />
                    </div>
                </div>
                <div className="flex-1 space-y-4 mt-4 overflow-auto">
                    <h1 className="text-xl:font-normal">
                        Kết quả tìm kiếm: Khách sạn Bình Minh
                    </h1>
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                    <CardItemSearch />
                </div>
            </div>
        </MainLayout>
    )
}