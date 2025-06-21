import { lazy, Suspense } from "react"
import { Route } from "react-router-dom"
import { PATH } from "../constants/Paths"
import RegisterOwner from "../pages/Login/RegisterOwner"

const Login = lazy(() => import("../pages/Login/Login"))
const Register = lazy(() => import("../pages/Login/Register"))
const ForgotPassword = lazy(() => import("../pages/Login/ForgotPassword"))
const ConfirmMail = lazy(() => import("../pages/Login/ConfirmMail"))
const LoadingPage = lazy(() => import("../pages/LoadingPage"))

export default function AuthRoutes() {
    return (
        <>
            <Route path={PATH.DANGNHAP} element={
                <Suspense fallback={<LoadingPage />}>
                    <Login />
                </Suspense>
            } />
            <Route path={PATH.DANGKI} element={
                <Suspense fallback={<LoadingPage />}>
                    <Register />
                </Suspense>
            } />
            <Route path={PATH.QUENMATKHAU} element={
                <Suspense fallback={<LoadingPage />}>
                    <ForgotPassword />
                </Suspense>
            } />
            <Route path={PATH.MAILGUI} element={
                <Suspense fallback={<LoadingPage />}>
                    <ConfirmMail />
                </Suspense>
            } />

            <Route path={PATH.DANGKITAIKHOANKHACHSAN} element={
                <Suspense fallback={<LoadingPage />}>
                    <RegisterOwner />
                </Suspense>
            } />
            
        </>
    )
}