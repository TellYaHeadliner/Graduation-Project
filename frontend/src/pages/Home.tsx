import MainLayout from "../layouts/MainLayout";
import CarouselCard from "../components/CustomCarousel/CarouselCard";
import { CardListStaticData } from "../utils/CardListStaticData";
import useTitle from "../hooks/useTitle";
import FindHotel from "../components/FindHotel/FindHotel";


export default function Home() {
    useTitle("Trang chủ");

    return (
        <MainLayout>
            <FindHotel />
            <CarouselCard cardList={CardListStaticData}/>
        </MainLayout>
    )
}