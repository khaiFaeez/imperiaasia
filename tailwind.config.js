module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Roboto"],
            },
        },
    },
    daisyui: {
        themes: [
            {
                autumn: {
                    ...require("daisyui/src/colors/themes")[
                        "[data-theme=autumn]"
                    ],
                    "--rounded-box": "0.2rem",
                    "--rounded-btn": "0.2rem",
                    neutral: "#000000",
                },
            },
        ],
    },
    plugins: [require("daisyui"), require("@tailwindcss/typography")],
};
