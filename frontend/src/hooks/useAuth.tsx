import { useEffect } from "react";
import Cookies from "js-cookie";
import { useDispatch, useSelector} from "react-redux";
import { RootState } from "../redux/store";
import { login } from "../redux/slices/authSlice"

export default function useAuth(){
    const dispatch = useDispatch();
    const isAuthenticated = useSelector((state: RootState) => state.auth.isAuthenticated)
    const token = Cookies.get("token")

    useEffect(() => {
        if (token && !isAuthenticated){
            dispatch(login())
        }
    }, [token, isAuthenticated, dispatch])
}