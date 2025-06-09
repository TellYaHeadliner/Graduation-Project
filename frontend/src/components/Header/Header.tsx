
import Search from '../TextField/Search';
import logo from "../../assets/light-logo.png"
import { PATH } from "../../constants/Paths"
import Person from '../Avatar/Person';
import TabNavLink from '../Tab/TabNavLink';
import ButtonRegister from '../Button/ButtonRegister';
// import NavUser from '../Navbar/NavUser';


export default function Header() {
    return (
        <header className="flex flex-col sm:flex-col bg-secondary color-white lg:text-lg 2xl:text-lg lg:px-20 2xl:px-40 shadow-md">
            <div className="flex items-center justify-around sm:justify-between sm:px-6 lg:px-6 2xl:px-6 py-2 ">
                <div className="flex flex-nowrap items-center">
                    <a href={PATH.HOME}>
                        <img src={logo} alt={logo} className='sm:w-40 lg:w-40 2xl:w-50 mr-4 '/>
                    </a>
                    <Search />
                </div>
                <div className="flex flex-nowrap items-center ">
                    <ButtonRegister />
                    <Person />
                    {/* <NavUser usernameProp="TellYa"/> */}
                </div>
            </div>
            <div className="flex flex-row items-center justify-start py-2 ml-4 ">
                <TabNavLink />
            </div>
        </header>
    )
}