import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/recipe-export.js",
            ],
            refresh: true,
        }),
    ],
    server: {
        host: "0.0.0.0", // Add this line
        hmr: {
            // host: "172.20.10.2",
            host: "192.168.1.2",
        },
        port: 5173,
        watch: {
            usePolling: true,
        },
    },
});
