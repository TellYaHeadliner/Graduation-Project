import {
    Menubar,
    MenubarMenu,
    MenubarTrigger,
    MenubarContent,
    MenubarItem,
} from "@radix-ui/react-menubar";
import { useEffect, useState } from "react";
  
import AvatarCustom from "../Avatar/AvatarCustom"
import { PATH } from "../../constants/Paths";
import { useLogOut } from "../../react-query/useLogOut";
import DialogLoading from "../Dialog/DialogLoading";

interface NavUserProps{
    usernameProp: string;
    avatar: string | null;
}

export default function NavUser({ usernameProp, avatar }: NavUserProps){

    const [username, setUserName] = useState<string>("");
    const logOut = useLogOut();

    useEffect(() => {
        if (typeof usernameProp === 'string'){
          const newUserName = usernameProp.match(/[A-Z]/g)?.slice(0, ).join('') || "";
          setUserName(newUserName);
        }
    }, [usernameProp])

    return (
    <Menubar className="bg-transparent border-none">
      <MenubarMenu>
        <MenubarTrigger className="focus:outline-none rounded-full ring-offset-background transition-all hover:scale-105">
          <AvatarCustom username={username} avatar={avatar}/>
        </MenubarTrigger>
        <MenubarContent
          className="mt-2 min-w-[160px] rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 p-1 overflow-y-auto z-50"
          align="end"
        >
          <MenubarItem className="cursor-pointer px-3 py-2 rounded-md text-sm text-gray-900 hover:bg-third hover:text-white">
            <a href={PATH.THONGTINGUOIDUNG}>
              Thông tin cá nhân
            </a>
          </MenubarItem>
            <MenubarItem className="cursor-pointer px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-third hover:text-white">
            <a href={PATH.LICHSUBOOKING}>
              Lịch sử booking
            </a>
          </MenubarItem>
            <MenubarItem className="cursor-pointer px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-third hover:text-white">
            <a href={PATH.KHACHSANYEUTHICH}>
              Khách sạn yêu thích
            </a>
          </MenubarItem>
            <MenubarItem className="cursor-pointer px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-third hover:text-white" onClick={() => logOut.mutate()} disabled={logOut.isPending}>
            Đăng xuất
          </MenubarItem>
        </MenubarContent>
      </MenubarMenu>
      {
        logOut.isPending && (
          <DialogLoading isOpen={true} />
        )
      }
    </Menubar>
    )
}