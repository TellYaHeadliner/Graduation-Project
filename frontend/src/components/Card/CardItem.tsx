import React from "react"
import { StarIcon, HeartFilledIcon } from "@radix-ui/react-icons";
import { AlertDialog, Flex, Button } from "@radix-ui/themes";
import { useNavigate } from "react-router-dom";
import stephenHouse from "../../assets/stephen-house.jpg"
import { Currency } from '../../utils/Currency';
import { useAuthCheck } from "../../hooks/useAuthCheck";

import "./CardItem.css"

interface CardItemProps {
    title: string;
    address: string;
    star: number;
    price: number | null;
    reviewCount: number;
    discountPrice: number | null;
}

interface TagScoreProp {
    star: number;
}

interface TagDiscountPrice {
    discountPrice: number | null;
}

interface AlertDialogCompProps {
    open: boolean;
    onOpenChange: (open: boolean) => void;
}

const AlertDialogComp: React.FC<AlertDialogCompProps> = ({ open, onOpenChange }) => {

    const navigate = useNavigate();

    return (
        <AlertDialog.Root open={open} onOpenChange={onOpenChange}>
            <AlertDialog.Content>
                <AlertDialog.Title>
                    Cảnh báo
                </AlertDialog.Title>
                <AlertDialog.Description size="2">
                    Vui lòng thực hiện đăng nhập để có thể thực hiện chức năng yêu thích khách sạn
                </AlertDialog.Description>

                <Flex gap="3" mt="4" justify="end">
                    <AlertDialog.Cancel>
                        <Button variant="soft" color="gray">
                            Thoát ra
                        </Button>
                    </AlertDialog.Cancel>
                    <AlertDialog.Action>
                        <Button type="button" variant="solid" color="blue" onClick={() => navigate("/login")} >
                            Đăng nhập
                        </Button>
                    </AlertDialog.Action>
                </Flex>
            </AlertDialog.Content>
        </AlertDialog.Root>
    )
}

const TagScore: React.FC<TagScoreProp> = ({ star }) => {
    if (star < 3) {
        return (
            <span className="inline-block bg-red-600 text-white text-xs px-2 py-1 rounded mr-2">
                Bad hotel
            </span>
        )
    }
    if (star >= 4 && star <= 5) {
        return (
            <span className="inline-block bg-blue-900 text-white text-xs px-2 py-1 rounded mr-2">
                Good hotel
            </span>
        )
    }
    return null;
}

const TagDiscount: React.FC<TagDiscountPrice> = ({ discountPrice }) => {
    if (discountPrice) {
        return (
            <span className="inline-block bg-yellow-400 text-white text-xs px-2 py-1 rounded">
                Có giảm giá !
            </span>
        )
    }
    return null;
}

export default function CardItem({ title, address, star, price, reviewCount, discountPrice }: CardItemProps) {

    const { isDialogOpen, closeDialog, checkAuth } = useAuthCheck();

    return (
        <div className="w-[270px] h-[330px] rounded-xl shadow-md overflow-hidden relative hover:bg-accent hover:shadow-2xl card holographic-card">
            <div className="relative">
                <img
                    src={stephenHouse}
                    alt={stephenHouse}
                    className="w-full h-40 object-cover"
                />
            </div>

            <div className="absolute top-2 right-2 z-10">
                <button className="bg-white hover:bg-accent text-red-500 p-1 rounded-full shadow"
                    onClick={(e) => {
                        e.stopPropagation();
                        e.preventDefault();
                        checkAuth()}}
                    type="button"
                >
                    <HeartFilledIcon className="w-5 h-5" />
                </button>
            </div>

            <AlertDialogComp open={isDialogOpen} onOpenChange={closeDialog} />

            <div className="p-3 flex flex-col gap-1">
                <h3 className="text-sm font-bold leading-snug">
                    {title}
                </h3>
                <p className="text-sm text-gray-600 leading-snug">
                    {address}
                </p>

                <div className="flex flex-col items-start justify-start gap-2 mt-1">
                    <span className="text-gray-500 flex flex-row items-center gap-1">
                        <StarIcon className="text-secondary" />
                        {star} •
                        <span className="text-sm font-normal text-gray-600">
                            {reviewCount} người đánh giá
                        </span>
                    </span>
                    <div>
                        <TagScore star={star} />
                        <TagDiscount discountPrice={discountPrice} />
                    </div>
                    <span className="block w-full text-right text-gray-500">
                        {discountPrice ? (
                            <div>
                                <span className="text-red-600 line-through mr-2">
                                    {Currency.formatVND(price)}
                                </span>
                                <span className="text-gray-500">
                                    {Currency.formatVND(discountPrice)}
                                </span>
                            </div>
                        ) : price ? (
                            Currency.formatVND(price)
                        ) : null}
                    </span>
                </div>
            </div>
        </div>
    )
};