/** @type {import('tailwindcss').Config} */
export default {
    mode: process.env.NODE_ENV ? "jit" : undefined,
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        extend: {
            colors: {
                gradt: "#11151a",
                gradb: "#2c323c",
                accent: "#52789e",
                navbg: "#191f27",
                navfg: "#a5bcd3",
                card: "hsl(198deg, 8%, 82%)",

                // misc
                cardbg: "#1f242c",
                cardbgalt: "#272c35",
                cardbgcrit: "#471c1c",
                blurple: "#52789e",
                subtitle: "#485057",
                hero: "#899cb1",
            }
        },
    },
    plugins: [],
};
