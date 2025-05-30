import { Routes, Route, BrowserRouter } from "react-router-dom"
import HomeRoutes from "./routes/HomeRoutes"
import AuthRoutes from "./routes/AuthRoutes"

function App() {
  return (
    <BrowserRouter>
      <Routes>
          {AuthRoutes()}
          {HomeRoutes()}
      </Routes>
    </BrowserRouter>

  )
}

export default App
