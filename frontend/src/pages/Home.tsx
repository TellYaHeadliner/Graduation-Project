import MainLayout from "../layouts/MainLayout";
import CustomCarousel from "../components/CustomCarousel/CustomCarousel";

export default function Home(this: any) {
    return (
        <MainLayout>
            <CustomCarousel />
        </MainLayout>
    )
}