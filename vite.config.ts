import { defineConfig } from 'vite'
import { wordpress } from "wordpress-vite-plugin"
import fullReload from 'vite-plugin-full-reload'

export default defineConfig({
  build: {
    outDir: './public/dist',
    emptyOutDir: false,
    copyPublicDir: false,
    target: 'esnext',
  },
  plugins: [
    wordpress({
      input: 'src/main.ts',
      namespace: 'solarwp',
    }),
    fullReload([
      'templates/**/*.php',
      'partials/**/*.php',
      'single**.php',
      'header.php',
      'footer.php',
    ])
  ]
})