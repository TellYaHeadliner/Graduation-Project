import { lazy, Suspense } from "react"
import { Route } from "react-router-dom"
import AuthenticatedGuard from "../guards/AuthenticatedGuard"
import { PATH } from "../constants/Paths"
import LoadingSpinner from "../components/Loading/LoadingSpinner"

const Home = lazy(() => import("../pages/Home"))
const KhuyenMai = lazy(() => import("../pages/KhuyenMai"))

export default function HomeRoutes() {
    return (
        <Route element={<AuthenticatedGuard />}>
            <Route path={PATH.HOME} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <Home />
                </Suspense>
            } />
            <Route path={PATH.KHUYENMAI} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <KhuyenMai />
                </Suspense>
            } />
        </Route>
    )
}