import {
    Menubar,
    MenubarMenu,
    MenubarTrigger,
    MenubarContent,
    MenubarItem,
} from "@radix-ui/react-menubar";
import { useEffect, useState } from "react";
  
import AvatarCustom from "../Avatar/AvatarCustom"

interface NavUserProps{
    usernameProp: string;
}

export default function NavUser({ usernameProp }: NavUserProps){

    const [username, setUserName] = useState<string>("");

    useEffect(() => {
        const newUserName = usernameProp.match(/[A-Z]/g)?.slice(0, 2).join('') || "";

        setUserName(newUserName);
    }, [usernameProp])

    return (
    <Menubar className="bg-transparent border-none">
      <MenubarMenu>
        <MenubarTrigger className="focus:outline-none rounded-full ring-offset-background transition-all hover:scale-105">
          <AvatarCustom username={username} />
        </MenubarTrigger>
        <MenubarContent
          className="mt-2 min-w-[160px] rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 p-1"
          align="end"
        >
          <MenubarItem className="cursor-pointer px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100">
            Thông tin cá nhân
          </MenubarItem>
          <MenubarItem className="cursor-pointer px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100">
            Đăng xuất
          </MenubarItem>
        </MenubarContent>
      </MenubarMenu>
    </Menubar>
    )
}