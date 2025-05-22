import { Box, Card, Inset, Text, Heading, Flex, Container } from "@radix-ui/themes"
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
        <Box width="200px" maxWidth="200px" className="h-full">
            <Card size="1" className="flex flex-col h-full">
                <Inset clip="padding-box" side="top" pb="current">
                    <img src={stephenHouse} alt="" className="w-full h-30 object-cover rounded-t" />
                </Inset>
                <div className="flex flex-col justify-between flex-1 py-1">
                    <Heading as="h3" size="3" className="pt-1 truncate" title={title}>
                        {title}
                    </Heading>
                    <Text as="p" size="2" weight="medium" className="pb-2 text-gray-600 line-clamp-2">
                        {address}
                    </Text>
                </div>


                <Flex justify="between" align="center" className="pb-1">
                    <Flex align="center" gap="1" className="text-yellow-500">
                        <StarIcon />
                        <span>{star}</span>
                    </Flex>
                    <Text weight="bold" className="text-primary">
                        {Currency.formatVND(price)}
                    </Text>
                </Flex>
            </Card>
        </Box>
    )
};