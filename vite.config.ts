import { defineConfig } from 'vite'

export default defineConfig({
  build: {
    outDir: './public/dist',
    emptyOutDir: false,
    copyPublicDir: false,
    manifest: true,
    sourcemap: true,
    target: 'esnext',
    rollupOptions: {
      input: {
        main: '/src/main.ts'
      }
    }
  }
})