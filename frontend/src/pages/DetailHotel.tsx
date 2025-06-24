import MainLayout from "../layouts/MainLayout";
import locationPin from "../assets/location-pin.svg"
import CarouselComment from "../components/CustomCarousel/CarouselComment";
import { HeartFilledIcon } from "@radix-ui/react-icons";
import TableRoom from "../components/Table/TableRoom";
import { tableRoomData } from "../utils/TableRoomStaticData";
import FindHotel from "../components/FindHotel/FindHotel";
import DataListRule from "../components/DataList/DataListRule";
import AccordionFAQHotel from "../components/Accordion/AccordionFAQHotel";
import CarouselCard from "../components/CustomCarousel/CarouselCard";
import { CardListStaticData } from "../utils/CardListStaticData";
import catFAQ from "../assets/cat_faq.png"
import ChatButton from "../components/Chat/ChatButton";
import DiscountBar from "../components/Discount/DiscountBar";
import Breadcrumb from "../components/Breadcrumb/Breadcrumb";
import DialogHotelServices from "../components/Dialog/DialogHotelServices";
import { useParams } from "react-router-dom";
import { useHotelDetailQuery } from "../react-query/useHotelDetailQuery";
import { useEffect } from "react";
import useTitle from "../hooks/useTitle";




export default function DetailHotel() {

    const { id } = useParams();
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
                    <img src={`${import.meta.env.VITE_API_URL}${listGalley[0]}`} alt="" className="w-2/3 h-64 bg-gray-300"/>
                    <div className="grid grid-cols-1 gap-4 w-1/3">
                        <img src={listGalley[1]} alt="" className="h-30 rounded bg-gray-300"/>
                        <img src={listGalley[2]} alt="" className="h-30 rounded bg-gray-300"/>
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
                                <li className="flex items-center gap-2">
                                    <HeartFilledIcon />
                                    Free WiFi
                                </li>
                                <li className="flex items-center gap-2">
                                    <HeartFilledIcon />
                                    Buffet
                                </li>
                                <li className="flex items-center gap-2">
                                    <HeartFilledIcon />
                                    Massage
                                </li>
                                <li className="flex items-center gap-2">
                                    <HeartFilledIcon />
                                    Hồ bơi vô cực
                                </li>
                                <li className="flex items-center gap-2">
                                    <HeartFilledIcon />
                                    Phòng xông hơi
                                </li>
                                <li className="flex items-center gap-2">
                                    <HeartFilledIcon />
                                    Massage
                                </li>
                                <li className="flex items-center gap-2">
                                    <HeartFilledIcon />
                                    Massage
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div className="w-1/2 space-y-4 flex flex-wrap justify-start">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15675.627299399666!2d106.68599318715822!3d10.818442200000007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752893ce3dd19b%3A0x5bbb4a49c123be78!2zS0jDgUNIIFPhuqBOIELDjE5IIE1JTkg!5e0!3m2!1svi!2s!4v1749129751015!5m2!1svi!2s"
                            width={800}
                            height={400}
                            style={{ border: 0 }}
                            loading="lazy"
                            referrerPolicy="no-referrer-when-downgrade"
                        />
                        <h3 className="text-lg font-bold">
                            Đánh giá về khách sạn chúng tôi
                        </h3>
                        <CarouselComment />
                        <DiscountBar />
                    </div>
                </div>
                <div className="flex flex-col mt-4">
                    <h2 className="text-xl font-semibold">
                        Lựa chọn loại phòng
                    </h2>
                    <div className="mb-4">
                        <FindHotel />
                    </div>
                    <TableRoom data={tableRoomData} />
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
                        <DataListRule />
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