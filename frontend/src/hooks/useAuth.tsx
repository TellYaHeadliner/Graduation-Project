import { useEffect } from "react";
import { useAppContext } from "../context/AppContext";

export default function useAuth(){
    const { state, dispatch } = useAppContext();
    const isAuthenticated = state.auth.isAuthenticated;


    useEffect(() => {
        if (!isAuthenticated){
            dispatch({ type: 'LOGIN' });
        }
    }, [ isAuthenticated, dispatch]);
}