import { lazy, Suspense } from "react"
import { Route } from "react-router-dom"
import AuthenticatedGuard from "../guards/AuthenticatedGuard"
import { PATH } from "../constants/Paths"
import LoadingSpinner from "../components/Loading/LoadingSpinner"
import Payment from "../pages/Payment/Payment"
import InfoPayment from "../pages/Payment/InfoPayment"
import InfoUser from "../pages/User/InfoUser"
import HistoryBooking from "../pages/User/HistoryBooking"
import FavoriteHotels from "../pages/User/FavoriteHotels"

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
            <Route path={PATH.THANHTOAN} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <Payment />
                </Suspense>
            } />
            <Route path={PATH.THONGTINTHANHTOAN} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <InfoPayment />
                </Suspense>
            } />
            <Route path={PATH.THONGTINGUOIDUNG} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <InfoUser />
                </Suspense>
            } />
            <Route path={PATH.LICHSUBOOKING} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <HistoryBooking />
                </Suspense>
            } />
            <Route path={PATH.KHACHSANYEUTHICH} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <FavoriteHotels />
                </Suspense>
            } />



        </Route>
    )
}