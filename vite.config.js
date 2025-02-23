import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        host: "0.0.0.0", // Add this line
        hmr: {
            host: "192.168.1.7",
        },
        port: 5173,
        watch: {
            usePolling: true,
        },
    },
});
