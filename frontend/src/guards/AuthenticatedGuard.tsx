import { Navigate, Outlet } from "react-router-dom"
import useAuth from "../hooks/useAuth";
import { Spinner } from "@radix-ui/themes";

function AuthenticatedGuard() {
    const { user, loading } = useAuth();

    if (loading){
        return <Spinner />
    }
    if (!user && location.pathname !== "/"){
        return <Navigate to="/" replace />;
    }

    return <Outlet />;
}

export default AuthenticatedGuard;