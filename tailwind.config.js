/** @type {import('tailwindcss').Config} */
const colors = require("tailwindcss/colors");

export default {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/masmerise/livewire-toaster/resources/views/*.blade.php",
    ],
    theme: {
        extend: {
            backgroundSize: {
                "300%": "300%",
            },
            keyframes: {
                shine: {
                    "0%": { backgroundPosition: "0% 50%" },
                    "100%": { backgroundPosition: "150% 50%" },
                },
            },
            transitionTimingFunction: {
                "bounce-in": "cubic-bezier(0.68, -0.55, 0.265, 1.55)",
            },
            animation: {
                shine: "shine 4s linear infinite",
            },
            fontFamily: {
                sans: ["Parkinsans", "sans-serif"],
                display: ["DM Serif Text", "serif"],
            },
            colors: {
                ...colors,
                // Main Colors
                primary: "#327039", // Green
                "primary-hover": "#2d6433", // Green
                "primary-light": "#8BC652",

                secondary: "#DD5C36", // Orange
                "secondary-hover": "#d65933", // Orange
                "secondary-light": "#EE892F",

                accent: "#E0BB76", // Orange

                // Background Colors
                "bg-primary": "#FFFFFF",
                "bg-dark-primary": "#252525",
                "bg-dark-secondary": "#1c1c1c",
                "bg-secondary": "#475569",
                "bg-tertiary": "#F1F5F9",

                // Text Colors
                "text-primary": "#0F172A",
                "text-dark-primary": "#FBFBFB",
                "text-secondary": "#475569",
                "text-muted": "#94A3B8",

                // Status Colors
                success: "#22C55E",
                warning: "#F59E0B",
                error: "#EF4444",
                info: "#3B82F6",
            },
        },
    },
    plugins: [],
};
