/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors:{
          'cypher-purple':'#853386',
          'cypher-red':'#FF0000',
          'cypher-green':'#318966',
          'cypher-black':'#333333',
          'white':'#ffffff',
          'cypher-gray':'#F4F4F4',
          'cypher-purple-50':'#A23A9A',
          'cypher-error':'#FF0000',
          'cypher-success':'#318966',
      },
      fontFamily: {
        'sans': ['"Roboto"'],
      },
    },
  },
  plugins: [],
}

