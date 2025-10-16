import React from "react";
import { HeartFilledIcon } from "@radix-ui/react-icons";
import { AlertDialog, Flex, Button } from "@radix-ui/themes";
import { useNavigate } from "react-router-dom";

import { Currency } from "../../utils/Currency";
import { useAuthCheck } from "../../hooks/useAuthCheck";
import { StarIcon } from '@heroicons/react/24/solid';


import "./CardItem.css";
import {
  BadHotelBadge,
  DiscountPriceBadge,
  GoodHotelBadge
} from "../Badge/BadgeCardItem";
import TooltipReputation from "../Tooltip/TooltipReputation";

interface CardItemProps {
  id: number;
  name: string;
  address: string;
  star_rating: number;
  avg_star: number;
  total_reviews: number;
  price: number ;
  discountPrice: number | null;
  avatar: string;
  slug: string;
  is_favorite: boolean;
}

interface AlertDialogCompProps {
  open: boolean;
  onOpenChange: (open: boolean) => void;
}

const AlertDialogComp: React.FC<AlertDialogCompProps> = ({
  open,
  onOpenChange
}) => {
  const navigate = useNavigate();

  return (
    <AlertDialog.Root open={open} onOpenChange={onOpenChange}>
      <AlertDialog.Content>
        <AlertDialog.Title>Cảnh báo</AlertDialog.Title>
        <AlertDialog.Description size="2">
          Vui lòng đăng nhập để sử dụng chức năng yêu thích khách sạn.
        </AlertDialog.Description>
        <Flex gap="3" mt="4" justify="end">
          <AlertDialog.Cancel>
            <Button variant="soft" color="gray">
              Thoát ra
            </Button>
          </AlertDialog.Cancel>
          <AlertDialog.Action>
            <Button variant="solid" color="blue" onClick={() => navigate("/login")}>
              Đăng nhập
            </Button>
          </AlertDialog.Action>
        </Flex>
      </AlertDialog.Content>
    </AlertDialog.Root>
  );
};

const TagScore: React.FC<{ reputation_score: number }> = ({ reputation_score }) => {
  if (reputation_score <= 3) return <BadHotelBadge />;
  if (reputation_score <= 5) return <GoodHotelBadge />;
  return null;
};

const CardItem: React.FC<CardItemProps> = ({
  id,
  name,
  address,
  star_rating,
  price,
  total_reviews,
  avg_star,
  discountPrice,
  avatar,
  slug,
  is_favorite
}) => {
  const { isDialogOpen, closeDialog, checkAuth, isPending } = useAuthCheck(id);
  const navigate = useNavigate();


  return (
    <div onClick={() => navigate(`/${slug}/${id}`)} className="w-[270px] h-[330px] rounded-xl shadow-md overflow-hidden relative hover:bg-accent hover:shadow-2xl card holographic-card">
      {/* Hình ảnh */}
      <div className="relative">
        <img
          src={import.meta.env.VITE_URL + avatar}
          className="w-full h-40 object-cover"
        />
        <button
          onClick={(e) => {
            e.stopPropagation();
            e.preventDefault();
            checkAuth();
          }}
          disabled={isPending}
          type="button"

          className="absolute top-2 right-2 bg-white hover:bg-accent p-1 rounded-full shadow z-10"

        >
          <HeartFilledIcon className={`w-5 h-5 transition-colors duration-300 ${is_favorite ? "text-red-500" : "text-gray-400"}`} />
        </button>
      </div>

      <AlertDialogComp open={isDialogOpen} onOpenChange={closeDialog} />

      {/* Thông tin chi tiết */}
      <div className="p-3 flex flex-col gap-1">
        <h3 className="text-sm font-bold leading-snug">{name}</h3>
        <div className="text-sm text-gray-600 leading-snug">
          {address}
        </div>

        <div className="flex flex-col items-start gap-2 mt-1">
          <span className="text-gray-500 flex flex-row items-center gap-1">
            {[...Array(star_rating)].map((_, i) => (
              <StarIcon
                key={i}
                className="w-4 h-4 text-yellow-400"
              />
            ))}
            <TooltipReputation reputation={avg_star} />
            {typeof total_reviews === "number" && (
              <span className="text-sm text-gray-500">
                ({total_reviews} đánh giá)
              </span>
            )}
          </span>

          <div className="flex flex-row gap-2 items-center">
            <TagScore reputation_score={avg_star} />
            <DiscountPriceBadge discountPrice={discountPrice} />
          </div>

          {/* Giá */}
          <div className="block w-full text-right text-gray-500">
            {typeof price === "number" && (
              <div className="flex flex-row items-center gap-2">
                {typeof discountPrice === "number" ? (
                  <>
                    <span className="text-red-600 line-through">
                      {Currency.formatVND(price)}
                    </span>
                    <span className="font-semibold text-primary">
                      {Currency.formatVND(discountPrice)}
                    </span>
                  </>
                ) : (
                  <span className="font-semibold text-primary">
                    {Currency.formatVND(price)}
                  </span>
                )}
              </div>
            )}
          </div>
        </div>
      </div>
    </div>
  );
};

export default CardItem;
