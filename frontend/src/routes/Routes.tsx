import { BrowserRouter } from "react-router-dom";
import HomeRoutes from "./HomeRoutes";
import AuthRoutes from "./AuthRoutes";

export default function Routes(){
    return (
        <BrowserRouter>
            <HomeRoutes/>
            <AuthRoutes />
        </BrowserRouter>
    )
}