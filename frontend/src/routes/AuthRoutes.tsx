import { lazy, Suspense } from "react"
import { Route } from "react-router-dom"
import { PATH } from "../constants/Paths"
import LoadingSpinner from "../components/Loading/LoadingSpinner"

const Login = lazy(() => import("../pages/Login"))
const Register = lazy(() => import("../pages/Register"))
const ForgotPassword = lazy(() => import("../pages/ForgotPassword"))
const ConfirmMail = lazy(() => import("../pages/ConfirmMail"))

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

            
        </>
    )
}