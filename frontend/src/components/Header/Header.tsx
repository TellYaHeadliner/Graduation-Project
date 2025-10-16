import Search from '../TextField/Search';
import logo from "../../assets/light-logo.png"
import { PATH } from "../../constants/Paths"
import Person from '../Avatar/Person';
import ButtonRegister from '../Button/ButtonRegister';
import NavUser from '../Navbar/NavUser';
import useAuth from '../../hooks/useAuth';
import LoadingSpinner from '../Loading/LoadingSpinner';

export default function Header() {

    const { user, loading } = useAuth();

    return (
        <header className="flex flex-col sm:flex-col bg-secondary color-white lg:text-lg 2xl:text-lg lg:px-20 2xl:px-40 shadow-md overflow-visible">
            <div className="flex items-center justify-around sm:justify-between sm:px-6 lg:px-6 2xl:px-6 py-2 ">
                <div className="flex flex-nowrap items-center">
                    <a href={PATH.HOME}>
                        <img src={logo} alt={logo} className='sm:w-40 lg:w-40 2xl:w-50 mr-4 '/>
                    </a>
                    
                </div>
                <div>
                    { loading ? ( <LoadingSpinner />
                    ) : user ? (
                        <div className="flex flex-nowrap items-center ">
                            <ButtonRegister />
                            <NavUser usernameProp={user.fullname} avatar={user.avatar ?? ""}/>
                        </div>
                    ) : (
                        <Person />
                    )
                    }
                </div>
            </div>
        </header>
    )
}