import { lazy, Suspense } from "react"
import { Route } from "react-router-dom"
import { PATH } from "../constants/Paths"
import LoadingSpinner from "../components/Loading/LoadingSpinner"
import RegisterOwner from "../pages/Login/RegisterOwner"

const Login = lazy(() => import("../pages/Login/Login"))
const Register = lazy(() => import("../pages/Login/Register"))
const ForgotPassword = lazy(() => import("../pages/Login/ForgotPassword"))
const ConfirmMail = lazy(() => import("../pages/Login/ConfirmMail"))


export default function AuthRoutes() {
    return (
        <>
            <Route path={PATH.DANGNHAP} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <Login />
                </Suspense>
            } />
            <Route path={PATH.DANGKI} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <Register />
                </Suspense>
            } />
            <Route path={PATH.QUENMATKHAU} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <ForgotPassword />
                </Suspense>
            } />
            <Route path={PATH.MAILGUI} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <ConfirmMail />
                </Suspense>
            } />

            <Route path={PATH.DANGKITAIKHOANKHACHSAN} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <RegisterOwner />
                </Suspense>
            } />
            
        </>
    )
}