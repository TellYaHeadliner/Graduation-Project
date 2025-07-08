import { lazy, Suspense } from "react"
import { Route } from "react-router-dom"
import { PATH } from "../constants/Paths"
import { FindRoomProvider } from "../context/FindRoomContext"

const Home = lazy(() => import("../pages/Home"))
const ResultSearch = lazy(() => import("../pages/ResultSearch"))
const DetailHotel = lazy(() => import("../pages/DetailHotel"))
const LoadingPage = lazy(() => import("../pages/LoadingPage"))

export default function HomeRoutes() {
    return (
        <>
            <Route path={PATH.HOME} element={
                <Suspense fallback={<LoadingPage />}>
                    <Home />
                </Suspense>
            } />
            <Route path={PATH.KETQUATIMKIEM} element={
                <Suspense fallback={<LoadingPage />}>
                    <FindRoomProvider>
                        <ResultSearch />
                    </FindRoomProvider>
                </Suspense>
            } />
            <Route path={PATH.CHITIETKHACHSAN} element={
                <Suspense fallback={<LoadingPage />}>
                    <FindRoomProvider>
                        <DetailHotel />
                    </FindRoomProvider>
                </Suspense>
            } />
            <Route path={PATH.TINHTHANH} element={
                <Suspense fallback={<LoadingPage />}>
                    <FindRoomProvider>
                        <ResultSearch />
                    </FindRoomProvider>
                </Suspense>
            } />
        </>

    )
}