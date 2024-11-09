import { fileURLToPath, URL } from 'node:url'

import { defineConfig , loadEnv} from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'

export default ({ mode }) => {
  process.env = {...process.env, ...loadEnv(mode, process.cwd())};

  return defineConfig({
      plugins: [
        vue()
      ],
      resolve: {
        alias: {
          '@': fileURLToPath(new URL('./src', import.meta.url))
        },
      },
      server: {
          port: parseInt(process.env.VITE_PORT),
          proxy: {
            "/api": {
              target: process.env.VITE_API_URL,
              changeOrigin: true,
              headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
              },
            },
          },
      },
  });
}
