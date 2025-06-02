import MainLayout from "../layouts/MainLayout";
import useTitle from "../hooks/useTitle";
import SideBarFilter from "../components/Navbar/SidebarFilter";


export default function Home() {
    useTitle("Kết quả tìm kiếm");

    return (
        <MainLayout>
            <SideBarFilter />
        </MainLayout>
    )
}