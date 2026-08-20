/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
   
  ],
  theme: {
    extend: {
      colors: {
        primary: "#083944",
        secondary: "#00CAFF",
        bebrasBlue: '#00CAFF',
        bebrasDarkBlue: '#0099CC',
        bebrasLightBlue: '#E6F7FF',
      },
    },
  },
  plugins: [],
}
