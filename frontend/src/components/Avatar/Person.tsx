import { Avatar, Box } from "@radix-ui/themes";
import { PersonIcon } from "@radix-ui/react-icons";

import { PATH } from "../../constants/Paths";
import "./Person.modules.css"

export default function Person(){
    return (
        <a href={PATH.LOGIN}>
            <Box className="person rounded-full outline">
                <PersonIcon />
            </Box>
        </a>
    )
}