import { PersonIcon } from "@radix-ui/react-icons";
import { PATH } from "../../constants/Paths";

export default function Person() {
    return (

    <a 
        href={PATH.LOGIN} 
        className="rounded-full border-indigo-50 text-white">
            <PersonIcon className="w-8 h-7" />
    </a>
    )
}