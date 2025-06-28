import { lazy, Suspense } from "react";
import { Route } from "react-router-dom";
import AuthenticatedGuard from "../guards/AuthenticatedGuard";
import { PATH } from "../constants/Paths";
import LoadingPage from "../pages/LoadingPage";


const Payment = lazy(() => import("../pages/Payment/Payment"))
const InfoPayment = lazy(() => import("../pages/Payment/InfoPayment"))
const InfoUser = lazy(() => import("../pages/User/InfoUser"))
const HistoryBooking = lazy(() => import("../pages/User/HistoryBooking"))
const FavoriteHotels = lazy(() => import("../pages/User/FavoriteHotels"))

export default function ProtectedRoutes() {
  return (
    <Route element={<AuthenticatedGuard />}>
      <Route path={PATH.THANHTOAN} element={<Suspense fallback={<LoadingPage />}>
        <Payment />
      </Suspense>} />
      <Route path={PATH.THONGTINTHANHTOAN} element={<Suspense fallback={<LoadingPage />}><InfoPayment /></Suspense>} />
      <Route path={PATH.THONGTINGUOIDUNG} element={<Suspense fallback={<LoadingPage />}><InfoUser /></Suspense>} />
      <Route path={PATH.LICHSUBOOKING} element={<Suspense fallback={<LoadingPage />}><HistoryBooking /></Suspense>} />
      <Route path={PATH.KHACHSANYEUTHICH} element={<Suspense fallback={<LoadingPage />}><FavoriteHotels /></Suspense>} />
    </Route>
  );
}