import { Avatar, Box } from "@radix-ui/themes";
import { PersonIcon } from "@radix-ui/react-icons";

import { PATH } from "../../constants/Paths";

export default function Person(){
    return (
        <Box width="64px" height="64px" className="object-contain">
            <a href={PATH.LOGIN}>
                <PersonIcon />
            </a>
        </Box>
    )
}