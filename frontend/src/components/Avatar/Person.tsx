import { PersonIcon } from "@radix-ui/react-icons";
import { PATH } from "../../constants/Paths";

export default function Person() {
    return (

    <a 
        href={PATH.LOGIN} 
        className="rounded-full border-indigo-50 text-white 2xl:text-2xl">
            <PersonIcon className="w-8 h-7" />
    </a>
    )
}