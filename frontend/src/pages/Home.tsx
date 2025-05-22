import MainLayout from "../layouts/MainLayout";
import SearchBooking from "../components/TextField/SearchBooking";
import CarouselImageLink from "../components/CustomCarousel/CarouseImageLink";
import CarouselCard from "../components/CustomCarousel/CarouselCard";
import { CardListStaticData } from "../utils/CardListStaticData";

export default function Home(this: any) {
    return (
        <MainLayout>
            <CarouselImageLink />
            <SearchBooking />
            <CarouselCard cardList={CardListStaticData}/>
        </MainLayout>
    )
}