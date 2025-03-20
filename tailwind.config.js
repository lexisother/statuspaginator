import debug from 'tailwindcss-debug-screens';

/** @type {import('tailwindcss').Config} */
const config = {
    mode: process.env.NODE_ENV ? "jit" : undefined,
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1280px',
            '2xl': '1536px',
            '3xl': '2456px',
        },
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
                sirenbg: 'sirenbg 5s cubic-bezier(.4,0,.6,1) infinite',
                sirentext: 'sirentext 2.5s cubic-bezier(.4,0,.6,1) infinite'
            },
            keyframes: {
                sirenbg: {
                    '0%, 48%, to': {
                        // TODO: figure out way to not unset cardbgcrit if this isn't here
                        'background-color': '#471c1c',
                        'border-color': '#e92d2d',
                    },
                    '16%': {
                        'background-color': '#5B2424',
                        'border-color': '#e92d2d'
                    }
                },
                sirentext: {
                    '0%, to': {
                        filter: 'drop-shadow(0 0 .6px #800) drop-shadow(0 0 .3px #a51)',
                        color: '#642'
                    },
                    '32%': {
                        filter: 'drop-shadow(0 0 2.4px #f22) drop-shadow(0 0 1.2px #fb3)',
                        color: '#fd6'
                    },
                    '96%': {
                        filter: 'drop-shadow(0 0 .6px #800) drop-shadow(0 0 .3px #a51)',
                        color: '#642'
                    }
                }
            }
        },
    },
    plugins: [debug()],
};

export default config;
