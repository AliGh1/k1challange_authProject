module.exports = {
   purge: [
       './storage/framework/views/*.php',
       './resources/views/**/*.blade.php',
       './resources/**/*.js',
       './resources/**/*.vue'
  ],
  darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"'],
            },
        },
    },
  variants: {
    extend: {},
  },
  plugins: [require('@tailwindcss/forms')],
}
