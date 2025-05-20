import MainLayout from "../layouts/MainLayout";
import CustomCarousel from "../components/CustomCarousel/CustomCarousel";
import SearchBooking from "../components/TextField/SearchBooking";

export default function Home(this: any) {
    return (
        <MainLayout>
            <CustomCarousel />
            <SearchBooking />
        </MainLayout>
    )
}