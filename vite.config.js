import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import { VitePWA } from "vite-plugin-pwa";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),

        vue(),

        VitePWA({
            registerType: "autoUpdate",

            // Laravel serves Vite files from /build
            buildBase: "/build/",

            manifest: {
                name: "murwaj Marketplace",
                short_name: "murwaj",
                description: "Discover products on murwaj Marketplace",

                start_url: "/",
                scope: "/",

                display: "standalone",
                orientation: "portrait-primary",

                theme_color: "#f97316",
                background_color: "#ffffff",

                lang: "en",
                dir: "ltr",

                categories: ["shopping", "marketplace"],

                icons: [
                    {
                        src: "/icons/pwa-192x192.png",
                        sizes: "192x192",
                        type: "image/png",
                        purpose: "any",
                    },
                    {
                        src: "/icons/pwa-512x512.png",
                        sizes: "512x512",
                        type: "image/png",
                        purpose: "any",
                    },
                    {
                        src: "/icons/pwa-512x512.png",
                        sizes: "512x512",
                        type: "image/png",
                        purpose: "maskable",
                    },
                ],
            },

            workbox: {
                cleanupOutdatedCaches: true,

                globPatterns: ["**/*.{js,css,html,ico,png,svg,webp,woff2}"],
            },
        }),
    ],

    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
        },
    },
});
