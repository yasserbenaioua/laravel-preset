const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  purge: [
    "./vendor/laravel/jetstream/**/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ["Tajawal", ...defaultTheme.fontFamily.sans],
      },
    },
  },

  variants: {
    extend: {
      opacity: ["disabled"],
      margin: ["responsive", "direction"],
      padding: ["responsive", "direction"],
      borderWidth: ["responsive", "direction"],
      translate: ["responsive", "direction"],
      justifyContent: ["responsive", "direction"],
      inset: ["responsive", "direction"],
      space: ["responsive", "direction"],
      textAlign: ["responsive", "direction"],
    },
  },

  plugins: [
    require("tailwindcss-dir")(),
    require("@tailwindcss/forms"),
    require("@tailwindcss/typography"),
  ],
};
