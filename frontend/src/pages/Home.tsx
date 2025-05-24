import MainLayout from "../layouts/MainLayout";
import SearchBooking from "../components/TextField/SearchBooking";
import CarouselImageLink from "../components/CustomCarousel/CarouseImageLink";
import CarouselCard from "../components/CustomCarousel/CarouselCard";
import { CardListStaticData } from "../utils/CardListStaticData";
import AccordionCustom from "../components/Accordion/AccordionCustom";
import useTitle from "../hooks/useTitle";


export default function Home(this: any) {
    useTitle("Trang chủ");

    return (
        <MainLayout>
            <CarouselImageLink />
            <SearchBooking />
            <CarouselCard cardList={CardListStaticData}/>
        </MainLayout>
    )
}