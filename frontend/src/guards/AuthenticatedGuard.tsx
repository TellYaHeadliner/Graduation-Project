import { Navigate, Outlet } from "react-router-dom"
import { useSelector } from "react-redux"
import { RootState } from "../redux/store"

function AuthenticatedGuard() {
    const isAuthenticated = useSelector((state: RootState) => state.auth.isAuthenticated);

    if (!isAuthenticated && sessionStorage.getItem('token')){
        return <Navigate to="/login" replace />;
    }

    return <Outlet />;
}

export default AuthenticatedGuard;