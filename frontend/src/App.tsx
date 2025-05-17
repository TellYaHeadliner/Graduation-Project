import { Routes, Route } from "react-router-dom"
import AuthenticatedGuard from "./guards/AuthenticatedGuard"
import HomeRoutes from "./routes/HomeRoutes"

function App() {
  return (
    <Routes>
      <Route element={<AuthenticatedGuard />}>
        {HomeRoutes()}
      </Route>
    </Routes>
  )
}

export default App
