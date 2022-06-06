const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {},
    daisyui: {
        // base: false,
        themes: [
            {
                autumn: {
                    ...require("daisyui/src/colors/themes")[
                        "[data-theme=autumn]"
                    ],
                    "--rounded-box": "0",
                    "--rounded-btn": "0",
                    neutral: "#000000",
                },
            },
        ],
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("daisyui"),
    ],
};
