import { Routes } from "react-router-dom"
import HomeRoutes from "./routes/HomeRoutes"
import AuthRoutes from "./routes/AuthRoutes"
import ProtectedRoutes from "./routes/ProtectedRoutes"

function App() {
  return (
    <Routes>
        {AuthRoutes()}
        {HomeRoutes()}
        {ProtectedRoutes()}
    </Routes>
  )
}

export default App
