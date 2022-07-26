import { fileURLToPath, URL } from "url";

import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      "@": fileURLToPath(new URL("./src", import.meta.url)),
    },
  },
  server: {
    proxy: {
      "^/api/": {
        target: "http://localhost:8000",
        changeOrigin: true,
        rewrite: (path) => path.replace(/^\/api/, ""),
      },
      "^/images/": {
        target: "http://localhost:8000/",
        changeOrigin: true,
        // rewrite: (path) => path.replace(/^\/images/, ""),
      },
    },
  },
  css: {
    preprocessorOptions: {
      scss: {
        additionalData:
          '@import "@/assets/scss/variables.scss"; @import "@/assets/scss/mixins.scss";',
      },
    },
  },
});
