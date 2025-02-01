/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.{html,js,php}",
  ],
  theme: {
    extend: {
      colors: {
        primary: "rgba(var(--primary))",
        secondary: "rgba(var(--secondary))",
        neutral: "rgba(var(--neutral))",
        brand: "rgba(var(--brand))",
        contrast: "rgba(var(--contrast))"
      },
      width: {
        dynamic: '100dvw',
        foreground: '500px',
        form: '900px',
        login: '600px',
        inherit: 'inherit',
        
        somewhat: '95%'
      },
      height: {
        mobile: "100dvh",
        inherit: "inherit"
      },
      gridTemplateColumns: {
        'auto-fill-100': 'repeat(auto-fill, minmax(100px, 1fr))',
        'auto-fit-100': 'repeat(auto-fit, minmax(100px, 1fr))',
      },
    },
  },
  plugins: [
    // require('flowbite/plugin')
  ],
}

