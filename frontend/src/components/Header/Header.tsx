
import Search from '../TextField/Search';
import logo from "../../assets/logo-header.png"
import { PATH } from "../../constants/Paths"
import "./Header.modules.css"
import Person from '../Avatar/Person';
import TabNavLink from '../Tab/TabNavLink';
import ButtonRegister from '../Button/ButtonRegister';


export default function Header() {
    return (
        <header className="flex flex-col sm:flex-col bg-primary color-white 2xl:text-2xl 2xl:px-40 shadow-md">
            <div className="flex items-center justify-around sm:justify-between sm:px-6 py-2">
                <div className="flex flex-nowrap items-center">
                    <a href={PATH.HOME}>
                        <img src={logo} alt={logo} width="40" className='2xl:w-15 mr-4 shadow-md '/>
                    </a>
                    <Search />
                </div>
                <div className="flex flex-nowrap items-center">
                    <ButtonRegister />
                    <Person />
                </div>
            </div>
            <div className="flex flex-row items-center justify-around py-2 ">
                <TabNavLink />
            </div>
        </header>
    )
}