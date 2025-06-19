import { Navigate, Outlet } from "react-router-dom"
import useAuth from "../hooks/useAuth";

function AuthenticatedGuard() {

    if (localStorage.getItem('token')){
        return <Navigate to="/login" replace />;
    }

    return <Outlet />;
}

export default AuthenticatedGuard;