import MainLayout from "../layouts/MainLayout";
import CarouselImageLink from "../components/CustomCarousel/CarouseImageLink";
import CarouselCard from "../components/CustomCarousel/CarouselCard";
import { CardListStaticData } from "../utils/CardListStaticData";
import useTitle from "../hooks/useTitle";
import FindHotel from "../components/FindHotel/FindHotel";


export default function Home(this: any) {
    useTitle("Trang chủ");

    return (
        <MainLayout>
            <CarouselImageLink />
            <FindHotel />
            <CarouselCard cardList={CardListStaticData}/>
        </MainLayout>
    )
}