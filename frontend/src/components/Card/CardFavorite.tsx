import React from "react";
import { AlertDialog, Flex, Button } from "@radix-ui/themes";
import { useNavigate } from "react-router-dom";

import { useAuthCheck } from "../../hooks/useAuthCheck";

import "./CardItem.css";



interface CardFavoriteProps {
    id: number;
    name: string;
    address: string;
    avatar: string;
    slug: string;
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



const CardFavorite: React.FC<CardFavoriteProps> = ({
    id,
    name,
    address,
    avatar,
    slug,
}) => {
    const { isDialogOpen, closeDialog } = useAuthCheck(id);
    const navigate = useNavigate();


    return (
        <div onClick={() => navigate(`/${slug}/${id}`)} className="w-[270px] h-[330px] rounded-xl shadow-md overflow-hidden relative hover:bg-accent hover:shadow-2xl card holographic-card">
            {/* Hình ảnh */}
            <div className="relative">
                <img
                    src={import.meta.env.VITE_URL + avatar}
                    className="w-full h-40 object-cover"
                />
            </div>

            <AlertDialogComp open={isDialogOpen} onOpenChange={closeDialog} />

            {/* Thông tin chi tiết */}
            <div className="p-3 flex flex-col gap-1">
                <h3 className="text-sm font-bold leading-snug">{name}</h3>
                <div className="text-sm text-gray-600 leading-snug">
                    {address}
                </div>

            </div>
        </div>
    );
};

export default CardFavorite;
