/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'primary': '#86003C'
            },
            backgroundImage: {
                "products-hero": "url('../assets/Products-Hero/el-kelaa-mgouna2.webp')"
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms')
    ],
}

