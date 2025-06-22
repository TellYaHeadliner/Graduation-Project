import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './styles/input.css'
import App from './App.tsx'
import { AppProvider } from './context/AppContext'
import { UserProvider } from './context/UserContext.tsx'
import { BrowserRouter } from 'react-router-dom'

createRoot(document.getElementById('root')!).render(
  <StrictMode>
    <BrowserRouter>
      <AppProvider>
        <UserProvider>
          <App />
        </UserProvider>
      </AppProvider>
    </BrowserRouter>
  </StrictMode>
)
