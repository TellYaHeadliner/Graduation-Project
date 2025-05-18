import { Box, Container, Flex} from '@radix-ui/themes';

import Search from '../TextField/Search';
import logo from "../../assets/logo-header.png"
import { PATH } from "../../constants/Paths"
import "./Header.modules.css"
import Person from '../Avatar/Person';


export default function Header() {
    return (
        <Container className="bg-primamry" >
            <Flex gap="3" display="inline-flex" align="center">
                <a href={PATH.HOME}>
                    <img src={logo} alt={logo} className="logo"/>
                </a>
                <Search />
                <Person />
            </Flex>
        </Container>
    )
}