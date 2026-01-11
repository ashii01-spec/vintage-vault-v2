import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                serif: ['Georgia', 'serif'],
            },
            colors: {
                vintage: {
                    50: '#fdfbf7',
                    100: '#f7f1e3', // Creamy vintage background
                    500: '#8c7b75', // Muted brown
                    900: '#3e2723', // Dark wood color
                    950: '#2D2E2E', // gray
                }
            }
        },
    },

    plugins: [forms, typography],
    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
