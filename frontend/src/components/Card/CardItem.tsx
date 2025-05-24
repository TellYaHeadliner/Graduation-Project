import { StarIcon } from "@radix-ui/react-icons";

import stephenHouse from "../../assets/stephen-house.jpg"
import { Currency } from "../../utils/Currency";

interface CardItemProps {
    title: string;
    address: string;
    star: number;
    price: number;
}

export default function CardItem({ title, address, star, price }: CardItemProps) {
    return (
        <div className="w-[220px] rounded-xl shadow-md overflow-hidden bg-white relative">
            <div className="relative">
                <img
                    src={stephenHouse}
                    alt={stephenHouse}
                    className="w-full h-40 object-cover"
                />
            </div>

            <div className="p-3 flex flex-col gap-1">
                <h3 className="text-sm font-bold leading-snug">
                    {title}
                </h3>
                <p className="text-sm text-gray-600 leading-snug">
                    {address}
                </p>

                <div className="flex items-center justify-between gap-2 mt-1">
                    <span className="text-gray-500 flex flex-row items-center">
                        <StarIcon />
                        {star}
                    </span>

                    {Currency.formatVND(price)}
                </div>
            </div>
        </div>
    )
};