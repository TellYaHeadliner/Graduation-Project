import { Badge } from "@radix-ui/themes";

export const BadHotelBadge = () => {
    return (
        <Badge color="red" variant="solid">
            Bad hotel
        </Badge>
    )
}

export const GoodHotelBadge = () => {
    return (
        <Badge color="indigo" variant="solid">
            Good hotel
        </Badge>
    )
}

interface DiscountPriceBadgeProps {
    discountPrice: number | null;
}
  

export const DiscountPriceBadge = ({ discountPrice }: DiscountPriceBadgeProps) => {
    if (discountPrice){
        return (
            <Badge color="orange" variant="solid" className="ml-2">
                Có giảm giá
            </Badge>
        )
    }
    return null;
}