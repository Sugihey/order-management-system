import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                ZenOldMincho: ['Zen Old Mincho', 'san-serif'],
                ZenKakuGothicNew: ['Zen Kaku Gothic New', 'san-serif'],
            },
        },
    },
    plugins: [],
};
