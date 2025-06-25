import MainLayout from "../layouts/MainLayout";
import locationPin from "../assets/location-pin.svg"
import CarouselComment from "../components/CustomCarousel/CarouselComment";
import TableRoom from "../components/Table/TableRoom";
import DataListRule from "../components/DataList/DataListRule";
import AccordionFAQHotel from "../components/Accordion/AccordionFAQHotel";
import catFAQ from "../assets/cat_faq.png"
import ChatButton from "../components/Chat/ChatButton";
import DiscountBar from "../components/Discount/DiscountBar";
import Breadcrumb from "../components/Breadcrumb/Breadcrumb";
import DialogHotelServices from "../components/Dialog/DialogHotelServices";
import { useParams } from "react-router-dom";
import { useHotelDetailQuery } from "../react-query/useHotelDetailQuery";
import useTitle from "../hooks/useTitle";
import { CheckIcon } from "@radix-ui/react-icons";
import FindRoom from "../components/FindHotel/FindRoom";
import { useFindRoomContext } from "../context/FindRoomContext";
import { useHotelRoomTypesQuery } from '../react-query/useHotelRoomTypesQuery';
import { useState } from "react";


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
    return (
        <MainLayout>
            <div className="flex lg:mx-26 2xl:mx-47 flex-col text-black">
                <div className="my-4">
                    <Breadcrumb items={breadcrumbItems} />
                </div>
                <h1 className="text-3xl font-bold">
                    {getDetailHotel.data?.data.hotel.name}
                </h1>
                <div className="text-thin text-md flex items-center gap-1">
                    <img src={locationPin} alt={locationPin} className="w-6 h-6 inline" />
                    {getDetailHotel.data?.data.hotel.address}
                </div>
                <div className="flex gap-4">
                    <img src={`${import.meta.env.VITE_URL}${listGalley[0]}`} alt="" className="w-2/3 h- bg-gray-300" />
                    <div className="grid grid-cols-1 gap-4 w-1/3">
                        <img src={listGalley[1]} alt="" className="h-30 rounded bg-gray-300" />
                        <img src={listGalley[2]} alt="" className="h-30 rounded bg-gray-300" />
                    </div>
                </div>
                <div className="flex flex-row mt-4">
                    <div className="lg:w-1/2 w-full mr-4">
                        <h3 className="text-lg font-semibold">Về khách sạn chúng tôi:</h3>
                        <div className="text-lg text-justify" dangerouslySetInnerHTML={{ __html: getDetailHotel.data?.data.hotel.description ?? "" }} />
                        <h2 className="text-lg font-semibold mt-2">
                            Các tiện nghi chúng tôi có
                        </h2>
                        <div>
                            <ul className="flex flex-row flex-wrap gap-4 mt-2">
                                {getDetailHotel.data?.data?.hotel?.amenities.map((amenity) => (
                                    <li key={amenity.id} className="flex items-center gap-1">
                                        <CheckIcon className="text-green-300 font-semibold w-6 h-6" />
                                        {amenity.name}
                                    </li>
                                ))}
                            </ul>
                        </div>
                        <h2 className="text-lg font-semibold mt-2">
                            Các dịch vụ chúng tôi có
                        </h2>
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
                        <DiscountBar discountList={getDetailHotel.data?.data.hotel.vouchers || []}/>
                    </div>
                </div>
                <div className="flex flex-col mt-4">
                    <h2 className="text-xl font-semibold">
                        Lựa chọn loại phòng
                    </h2>
                    <div className="mb-4">
                        <FindRoom onSearch={() => setIsSearchRoomType(true)}/>
                    </div>
                    <TableRoom datas={getRoomType.data?.data.list ?? []} />
                    <div className="flex justify-end py-3">
                        <DialogHotelServices />
                    </div>
                </div>
                <div>
                    <h2 className="text-xl font-bold mt-2">
                        Đây là quy định của khách sạn chúng tôi
                    </h2>
                    <p className="font-thin">
                        Bạn nên biết khi sử dụng khách sạn của chúng tôi
                    </p>
                    <div className="mt-2">
                        <DataListRule hotelRule={getDetailHotel.data?.data.hotel.hotel_rule} />
                    </div>
                </div>
                <div>
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
            </div>
            {/* <div className="mt-2">
                <CarouselCard cardList={CardListStaticData} title="Những khách sạn bạn có thể quan tâm" />
            </div> */}
            <ChatButton />
        </MainLayout>
    )
}