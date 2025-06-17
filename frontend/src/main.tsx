import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './styles/input.css'
import App from './App.tsx'
import { AppProvider } from './context/AppContext'

createRoot(document.getElementById('root')!).render(
  <AppProvider>
    <StrictMode>
      <App />
    </StrictMode>
  </AppProvider>
)
