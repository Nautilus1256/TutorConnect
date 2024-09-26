import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: ["./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php", "./storage/framework/views/*.php", "./resources/views/**/*.blade.php"],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                'title': ['"Pangolin"', 'cursive'],
                'body': ['"M PLUS Rounded 1c"', 'sans-serif'],
            },
            colors: {
                'orangered': '#ff4500',
                'orange': '#f1af2d',
                'yellow': '#ffe682',
                'green': '#bbcb79',
                'pink': '#e69b97',
            },
            spacing: {
                '7.5': '1.875rem',
                '30': '7.5rem',
                '36.5': '9.125rem',
                '50': '12.5rem',
                '100': '25rem',
                '4/5': '80%',
                'full-6' : 'calc(100% - 24px)',
                'full-12': 'calc(100% - 48px)',
                'full-16': 'calc(100% - 64px)',
                'full-23.5': 'calc(100% - 94px)',
                'full-25': 'calc(100% - 100px)',
                'screen-40': 'calc(100vh - 160px)',
            },
            height: {
                '30': '7.5rem',
                '36.5': '9.125rem',
                '50': '12.5rem',
                '100': '25rem',
                'full-6' : 'calc(100% - 24px)',
                'full-16': 'calc(100% - 64px)',
                'full-23.5': 'calc(100% - 94px)',
                'screen-40': 'calc(100vh - 160px)',
            },
            width: {
                '30': '7.5rem',
                '50': '12.5rem',
                '100': '25rem',
                'full-12': 'calc(100% - 48px)',
                'full-25': 'calc(100% - 100px)',
            },
            maxWidth: {
                '4/5': '80%',
            },
            bottom: {
                '7.5': '1.875rem',
            },
            right: {
                '7.5': '1.875rem',
            },
            boxShadow: {
                'whole-lightgray': '0 0 8px lightgray',
                'whole-orange': '0 0 8px #f1af2d',
            },
        },
    },

    plugins: [forms],
};
