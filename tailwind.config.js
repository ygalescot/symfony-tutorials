module.exports = {
  content: [
    'templates/**/*.html.twig',
    'assets/js/**/*.js',
    'assets/js/**.*.jsx', // If you use React JSX files
  ],
  theme: {
    extend: {
      colors: {
        'azure': '#31a7ff',
        'dark-blue': '#4960b5',
        'light-gray': '#cccccc',
        'dark-gray': '#464a58',
        'red': '#aa1c25',
        'orange': '#aa6021',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
};
