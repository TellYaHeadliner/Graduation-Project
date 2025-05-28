import MainLayout from "../layouts/MainLayout";
import CarouselCard from "../components/CustomCarousel/CarouselCard";
import { CardListStaticData } from "../utils/CardListStaticData";
import useTitle from "../hooks/useTitle";
import FindHotel from "../components/FindHotel/FindHotel";

import section from "../assets/section.jpg"
import TrendingLocation from "../components/TrendingTab/TrendingLocation";


export default function Home() {
    useTitle("Roomix");

    return (
        <MainLayout>
            <div className="relative h-[70vh] mx-18">
                <div className="absolute inset-0 bg-cover bg-center " style={{ backgroundImage: `url(${section})`, filter: 'brightness(0.5)' }} />
                <div className="relative z-10 flex flex-col justify-center h-full px-8 lg:px-32 max-w-6xl">
                    <h1 className="text-4xl lg:text-6xl font-bold leading-tight text-white">
                        Roomix <br/>
                        Trang web đặt khác sạn
                    </h1>
                    <p className="mt-4 text-2xl text-gray font-medium text-white">
                        Hãy đặt phòng khách sạn như bạn mong muốn !
                    </p>
                <FindHotel />
                </div>
            </div>
            <TrendingLocation />
            <CarouselCard cardList={CardListStaticData} title="Khách sạn bạn quan tâm"/>
        </MainLayout>
    )
}