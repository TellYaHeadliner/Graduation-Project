import { Navigate, Outlet } from "react-router-dom"
import { useSelector } from "react-redux"
import { RootState } from "../redux/store"
import Cookies from 'js-cookie';

function AuthenticatedGuard() {
    const isAuthenticated = useSelector((state: RootState) => state.auth.isAuthenticated);

    if (!isAuthenticated && Cookies.get('token')){
        return <Navigate to="/login" replace />;
    }

    return <Outlet />;
}

export default AuthenticatedGuard;