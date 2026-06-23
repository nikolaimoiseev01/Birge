import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Roboto Flex', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                azure: {
                    400: '#112E3B',
                    500: '#0A1C2B',
                    600: '#1E1E1E'
                },
                mint: {
                    200: '#EFF5E9',
                    500: '#DEFEC0',
                    600: '#3CA19B',
                    800: '#118891',
                    900: '#295A57',
                },
                bright: {
                    40: '#E2F1F0',
                    400: '#edf3e7',
                    500: '#E8EFE2',
                    600: '#D3DCCB',
                }
            },
            screens: {
                '2xl': {'max': '1535px'}, // => @media (max-width: 1535px) { ... }
                'xl': {'max': '1279px'}, // => @media (max-width: 1279px) { ... }
                'lg': {'max': '1023px'}, // => @media (max-width: 1023px) { ... }
                'md': {'max': '767px'}, // => @media (max-width: 767px) { ... }
                'sm': {'max': '639px'}, // => @media (max-width: 639px) { ... }
            },
        },
    },
    plugins: [forms],
};
