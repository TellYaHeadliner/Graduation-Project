import { Avatar } from "@radix-ui/themes";

interface AvatarProps{
    username: string;
}

export default function AvatarCustom({ username }: AvatarProps){
    return (
        <Avatar fallback={username} className="bg-white" radius="full"/>
    )
}