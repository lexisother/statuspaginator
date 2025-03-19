/** @type {import('tailwindcss').Config} */
const config = {
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
            },

            animation: {
                siren: 'siren 5s cubic-bezier(.4,0,.6,1) infinite'
            },
            keyframes: {
                siren: {
                    '0%, 48%, to': {
                        // TODO: figure out way to not unset cardbgcrit if this isn't here
                        'background-color': '#471c1c',
                        'border-color': '#e92d2d',
                    },
                    '16%': {
                        'background-color': '#5B2424',
                        'border-color': '#e92d2d'
                    }
                }
            }
        },
    },
    plugins: [],
};

export default config;
