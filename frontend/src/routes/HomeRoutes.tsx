import { lazy, Suspense } from "react"
import { Route } from "react-router-dom"
import AuthenticatedGuard from "../guards/AuthenticatedGuard"
import { PATH } from "../constants/Paths"
import LoadingSpinner from "../components/Loading/LoadingSpinner"

const Home = lazy(() => import("../pages/Home"))
const ResultSearch = lazy(() => import("../pages/ResultSearch"))
const DetailHotel = lazy(() => import("../pages/DetailHotel"))

export default function HomeRoutes() {
    return (
        <Route element={<AuthenticatedGuard />}>
            <Route path={PATH.HOME} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <Home />
                </Suspense>
            } />
            <Route path={PATH.KETQUATIMKIEM} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <ResultSearch />
                </Suspense>
            } />
            <Route path={PATH.CHITIETKHACHSAN} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <DetailHotel />
                </Suspense>
            } />
        </Route>
    )
}