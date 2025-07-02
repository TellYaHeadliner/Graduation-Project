import MainLayout from "../layouts/MainLayout";
import CarouselCard from "../components/CustomCarousel/CarouselCard";
import useTitle from "../hooks/useTitle";
import FindHotel from "../components/FindHotel/FindHotel";

import section from "../assets/section.jpg"
import TrendingLocation from "../components/TrendingTab/TrendingLocation";
import { ToastContainer } from "react-toastify";
import LocationTab from "../components/TrendingTab/LocationTab";
import { useEffect } from "react";
import { useHotelSeasonsQuery } from "../react-query/useHotelSeasonsQuery";
import { ErrorUtils } from "../utils/Error";
import LoadingSpinner from "../components/Loading/LoadingSpinner";
import { FindHotelProvider } from "../context/FindHotelContext";
import { useHotelSearch } from "../react-query/useHotelSearch";
import DialogLoading from "../components/Dialog/DialogLoading";
import { useQueryClient } from "@tanstack/react-query";

export default function Home() {
    useTitle("Roomix");

    const getHotelSeasonResponse = useHotelSeasonsQuery();


    useEffect(() => {
        if (getHotelSeasonResponse.isError) {
            const errorHandler = new ErrorUtils();
            errorHandler.handleError(getHotelSeasonResponse.error);
        }
    }, [getHotelSeasonResponse])

    return (
        <MainLayout>
            <div className="relative h-[80vh] ">
                <div className="absolute inset-0 bg-cover bg-no-repeat bg-center " style={{ backgroundImage: `url(${section})`, filter: 'brightness(0.5)' }} />
                <div className="relative z-10 flex flex-col justify-center h-full px-8 lg:px-32 max-w-6xl">
                    <h1 className="text-4xl lg:text-6xl font-bold leading-tight text-white">
                        Roomix <br />
                        Trang web đặt khác sạn
                    </h1>
                    <p className="mt-4 text-2xl text-gray font-medium text-white">
                        Hãy đặt phòng khách sạn như bạn mong muốn !
                    </p>
                    <FindHotelProvider>
                        <FindHotel />
                    </FindHotelProvider>
                </div>
            </div>
            <TrendingLocation />
           
            {getHotelSeasonResponse.isLoading ? (
                <div className="flex justify-center my-4">
                    <LoadingSpinner />
                </div>
            ): <CarouselCard cardList={getHotelSeasonResponse?.data?.data.hotels ?? []} title="Khách sạn bạn quan tâm" /> }
            {/* <CarouselCard cardList={CardListWithPriceData} title="Khách sạn có giá ưu đãi" />
            <CarouselCard cardList={CardListStaticData} title="Khách sạn có ưu đãi cuối tuần" />
            <CarouselCard cardList={CardListStaticData} title="Khách sạn theo mùa du lịch" /> */}
            <LocationTab />
            <ToastContainer position="top-right" />
        </MainLayout>
    )
}