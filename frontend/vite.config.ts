import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react-swc'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
  plugins: [
    react(),
    tailwindcss(),
  ],
  optimizeDeps: {
    include: ['@tanstack/react-query'], // ép bundle lại từ đầu
  },
  server: {
    host: '127.0.0.1',
    port: 5173
  }
})
