import { lazy, Suspense } from "react"
import { Route } from "react-router-dom"
import AuthenticatedGuard from "../guards/AuthenticatedGuard"
import { PATH } from "../constants/Paths"
import LoadingSpinner from "../components/Loading/LoadingSpinner"

const Home = lazy(() => import("../pages/Home"))
const ResultSearch = lazy(() => import("../pages/ResultSearch"))

export default function HomeRoutes() {
    return (
        <Route element={<AuthenticatedGuard />}>
            <Route path={PATH.HOME} element={
                <Suspense fallback={<LoadingSpinner />}>
                    <Home />
                </Suspense>
            } />
            <Route path="/ketquatimkiem"element={
                <Suspense fallback={<LoadingSpinner />}>
                    <ResultSearch />
                </Suspense>
            } />
        </Route>
    )
}