
import Search from '../TextField/Search';
import logo from "../../assets/logo-header.png"
import { PATH } from "../../constants/Paths"
import "./Header.modules.css"
import Person from '../Avatar/Person';
import TabNavLink from '../Tab/TabNavLink';


export default function Header() {
    return (
        <header className="flex flex-col bg-primary color-white">
            <div className="flex flex-row items-center justify-around py-2">
                <a href={PATH.HOME}>
                    <img src={logo} alt={logo} width="40"/>
                </a>
                <Search />
                <Person />
            </div>
            <div className="flex flex-row items-center justify-around py-2 ">
                <TabNavLink />
            </div>
        </header>
    )
}