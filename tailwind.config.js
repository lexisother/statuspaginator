/** @type {import('tailwindcss').Config} */
export default {
    mode: process.env.NODE_ENV ? "jit" : undefined,
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        extend: {
        },
    },
    plugins: [],
};
