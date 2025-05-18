import { Routes, Route, BrowserRouter } from "react-router-dom"
import AuthenticatedGuard from "./guards/AuthenticatedGuard"
import HomeRoutes from "./routes/HomeRoutes"

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route element={<AuthenticatedGuard />}>
          {HomeRoutes()}
        </Route>
      </Routes>
    </BrowserRouter>

  )
}

export default App
