import MainLayout from "../layouts/MainLayout";
import locationPin from "../assets/location-pin.svg"
import TableRoom from "../components/Table/TableRoom";
import DataListRule from "../components/DataList/DataListRule";
import ChatButton from "../components/Chat/ChatButton";
import Breadcrumb from "../components/Breadcrumb/Breadcrumb";
import DialogHotelServices from "../components/Dialog/DialogHotelServices";
import { useParams } from "react-router-dom";
import { useHotelDetailQuery } from "../react-query/useHotelDetailQuery";
import useTitle from "../hooks/useTitle";
import { CheckIcon, InfoCircledIcon } from "@radix-ui/react-icons";
import FindRoom from "../components/FindHotel/FindRoom";
import { useFindRoomContext } from "../context/FindRoomContext";
import { useHotelRoomTypesQuery } from '../react-query/useHotelRoomTypesQuery';
import { useEffect, useState } from "react";
import { BookingDetail } from "../types/PaymentTypes";
import { Callout, Skeleton } from "@radix-ui/themes";
import AccordionFAQHotel from "../components/Accordion/AccordionFAQHotel";
import catFAQ from "../assets/cat_faq.png"
import { ReviewForm } from "../components/Form/FormReview";
import { useCheckReviewQuery } from "../react-query/useReview";
import LoadingSpinner from "../components/Loading/LoadingSpinner";
import CarouselImage from "../components/CustomCarousel/Carouselmage";
import { ToastContainer } from "react-toastify";
import CarouselComment from "../components/CustomCarousel/CarouselComment";

export default function DetailHotel() {

    const { id } = useParams();
    const { state } =  useFindRoomContext();
    const getDetailHotel = useHotelDetailQuery(Number(id));
    const title = getDetailHotel.data?.data?.hotel?.name
    useTitle(title ?? "Đang tải")

    const breadcrumbItems = [
        { label: "Trang chủ", href: "/" },
        { label: "Khách sạn", href: "/hotels" },
        { label: getDetailHotel.data?.data.hotel.name ?? "Đang tải", active: true },
    ];

    const galleyString = getDetailHotel.data?.data.hotel.gallery;
    const listGalley = galleyString?.split(",") ?? [];
    const [isSearchRoomType, setIsSearchRoomType] = useState(false);
    const getRoomType = useHotelRoomTypesQuery(Number(id), state.dateRange[0] , state.dateRange[1], state.adults, state.children, state.rooms, isSearchRoomType)

    const [bookingDetails, setBookingDetails] = useState<BookingDetail[]>([]);

    useEffect(() => {
        localStorage.setItem('comboTotal', JSON.stringify(0));
        localStorage.setItem('infoSelectedCombos', JSON.stringify([]));
        localStorage.setItem('infoSelectedRoom', JSON.stringify([]));
        localStorage.setItem('infoSelectedService', JSON.stringify([]));
        localStorage.setItem('numberOfNights', JSON.stringify(0));
        localStorage.setItem('serviceTotal', JSON.stringify(0));
        localStorage.setItem('totalRoom', JSON.stringify(0));
        localStorage.setItem('findHotel', JSON.stringify({ "dateRange": [null, null], "adults": 0, "children": 0, "rooms": 0 }))
    }, [])

    const checkReview = useCheckReviewQuery(Number(id));

    return (
        <MainLayout>
            <div className="flex lg:mx-26 2xl:mx-47 flex-col text-black">
                <div className="my-3 mt-5 font-medium">
                    <Breadcrumb items={breadcrumbItems} />
                </div>
                <h1 className="text-3xl font-bold">
                    {getDetailHotel.isPending ? <Skeleton width="1090px" height="36px" /> : getDetailHotel.data?.data.hotel.name}
                </h1>

                <div className="text-thin text-md flex items-center gap-1 my-2">
                    <img src={locationPin} alt={locationPin} className="w-6 h-6 inline" />
                    {
                        getDetailHotel.isPending && (
                            <Skeleton width="3000px" />
                        )
                    }
                    {getDetailHotel.data?.data.hotel.address}
                </div>
                <div className="flex gap-4">
                    <CarouselImage listGalley={listGalley} />
                </div>
                <div className="flex flex-row mt-4">
                    <div className="lg:w-1/2 w-full mr-4">

                        <h3 className="text-lg font-semibold">Về khách sạn chúng tôi:</h3>
                        { getDetailHotel.isPending ? (
                            <Skeleton height="100px"/>
                        ): (
                            <div className="text-lg text-justify" dangerouslySetInnerHTML={{ __html: getDetailHotel.data?.data.hotel.description ?? "" }} />
                        )}
                        <h2 className="text-lg font-semibold mt-5">
                            Các tiện nghi chúng tôi có
                        </h2>
                        <div>
                            <ul className="flex flex-row flex-wrap gap-4 mt-2">
                                {getDetailHotel.data?.data?.hotel.amenities.map((amenity) => (
                                    <li key={amenity.name} className="flex items-center gap-1">
                                        <CheckIcon className="text-green-300 font-semibold w-6 h-6" />
                                        {amenity.name}
                                    </li>
                                ))}
                            </ul>
                        </div>
                        <h2 className="text-lg font-semibold mt-5">
                            Các dịch vụ chúng tôi có
                        </h2>
                        {getDetailHotel.isPending && (
                            <Skeleton height="500px"/>
                        )}
                        <div>
                            <ul className="flex flex-row flex-wrap gap-4 mt-2">
                                {getDetailHotel.data?.data?.hotel?.services.map((service) => (
                                    <li key={service.id} className="flex items-center gap-1">
                                        <CheckIcon className="text-green-300 font-semibold w-6 h-6" />
                                        {service.name}
                                    </li>
                                ))}
                            </ul>
                        </div>

                    </div>
                    <div className="w-1/2 space-y-4 flex flex-wrap justify-start">
                        <iframe
                            src={`https://www.google.com/maps?q=${encodeURIComponent(getDetailHotel.data?.data?.hotel?.address ?? "")}&output=embed`}
                            width={800}
                            height={400}
                            style={{ border: 0 }}
                            loading="lazy"
                            allowFullScreen
                            referrerPolicy="no-referrer-when-downgrade"
                        />
                        <h3 className="text-lg font-bold">
                            Đánh giá về khách sạn chúng tôi
                        </h3>
                        <CarouselComment />
                    </div>
                </div>
                <div className="flex flex-col mt-6">
                    <h2 className="text-xl font-semibold">
                        Lựa chọn loại phòng
                    </h2>

                    <div className="mb-4">
                        <FindRoom onSearch={() => setIsSearchRoomType(true)}/>
                    </div>
                    <div >
                        <TableRoom isLoading={getRoomType.isPending} datas={getRoomType.data?.data.list ?? []} onChange={setBookingDetails} hotelRule={getDetailHotel.data?.data.hotel.rules}/>
                    </div>

                    <div className="flex justify-end py-3 items-center">
                        <DialogHotelServices
                            combos={getDetailHotel.data?.data.hotel.combos ?? []}
                            services={getDetailHotel.data?.data.hotel.services ?? []}
                            hasSelectedRoom={bookingDetails.length > 0}
                        />
                    </div>
                </div>
                <div className="mt-5">
                    <h2 className="text-xl font-bold mt-2">
                        Đây là quy định của khách sạn chúng tôi
                    </h2>
                    <p className="font-thin">
                        Bạn nên biết khi sử dụng khách sạn của chúng tôi
                    </p>
                    <div className="mt-2">
                        <DataListRule hotelRule={getDetailHotel.data?.data.hotel.rules} />
                    </div>
                </div>
                <div className="mt-5">
                    <h2 className="text-xl font-bold mt-2">
                        FAQ (Câu hỏi thường xuyên về khách sạn)
                    </h2>
                    <p className="font-thin">
                        Những câu hỏi thường gặp mà khách hàng hay hỏi về khách sạn chúng tôi
                    </p>
                    <div className="flex flex-row justify-around items-center gap-8">
                        <img src={catFAQ} alt={catFAQ} className="w-40 md:w-60 h-auto" />
                        <div className="w-full md:w-3/4">
                            <AccordionFAQHotel />
                        </div>
                    </div>
                </div>

                <div className="mt-5 mb-5">
                    <h2 className="text-xl font-bold mt-2">
                        Đánh giá khách sạn 
                    </h2>
                    {
                        checkReview.isLoading ? (
                            <LoadingSpinner />
                        ) : checkReview.error ? (
                            <div className="text-red-500">Đã xảy ra lỗi khi kiểm tra đánh giá.</div>
                        ) : (
                            <div>
                                <Callout.Root>
                                    <Callout.Icon>
                                        <InfoCircledIcon />
                                    </Callout.Icon>
                                    <Callout.Text>
                                        Bạn có đủ quyền đánh giá khách sạn
                                    </Callout.Text>
                                </Callout.Root>
                                <ReviewForm hotel_id={Number(id)} />
                            </div>
                        )
                    }
                    
                </div>
            </div>
            <ChatButton />
            <ToastContainer position="top-right" />
        </MainLayout>
    )
}