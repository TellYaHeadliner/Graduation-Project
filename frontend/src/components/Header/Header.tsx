import { TabNav, Container, Flex, Box} from '@radix-ui/themes';

import { PATH } from "../../constants/Paths"

import Search from '../TextField/Search';
import Person from '../Avatar/Person';

import "./Header.modules.css"

import hotel from "../../assets/hotel.svg"
import logo from "../../assets/logo-header.png"
import resort from "../../assets/resort.svg"
import homestay from "../../assets/homestay.svg"
import discount from "../../assets/discount.svg"

export default function Header() {
    return (
        <Container className="bg-[var(--color-primary)]" size="1">
            <Flex display="flex" direction="column" align="center">
                <Flex gap="5" display="flex" align="center" justify="between">
                    <a href={PATH.HOME}>
                        <img src={logo} alt={logo} className="logo"/>
                    </a>
                    <Search />
                    <Person />
                </Flex>
                <Flex gap="10" display="flex" align="center" justify="between">
                    <TabNav.Root>
                        <TabNav.Link href="/khachsan">
                            <img src={hotel} alt={hotel} width={20} height={20} className="mr-1"/>
                            Khách sạn
                        </TabNav.Link>
                        <TabNav.Link href="/">
                            <img src={homestay} alt={homestay} width={20} height={20} className="mr-1"/>
                            Homestay
                        </TabNav.Link>
                        <TabNav.Link href="#">
                            <img src={resort} alt={resort} width={20} height={20} className="mr-1"/>
                            Resort
                        </TabNav.Link>
                        <TabNav.Link href="#">
                            <img src={discount} alt={discount} width={20} height={20} className="mr-1" />
                            Khuyến mãi
                        </TabNav.Link>
                    </TabNav.Root>
                </Flex>
            </Flex>
        </Container>
    )
}