import { useEffect } from "react";
import Cookies from "js-cookie";
import { useAppContext } from "../context/AppContext";

export default function useAuth(){
    const { state, dispatch } = useAppContext();
    const isAuthenticated = state.auth.isAuthenticated;
    const token = Cookies.get("token");

    useEffect(() => {
        if (token && !isAuthenticated){
            dispatch({ type: 'LOGIN' });
        }
    }, [token, isAuthenticated, dispatch]);
}