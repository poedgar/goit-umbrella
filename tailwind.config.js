/**
 * @type {import('tailwindcss/tailwind-config').TailwindConfig }
 */
module.exports = {
  future: {
    hoverOnlyWhenSupported: true,
  },
  content: ['./**/*.{php,html,css}', './src/**/*.{js,ts}'],
  theme: {
    screens: {
      sm: '480px',
      md: '768px',
      xl: '1280px',
      smOnly: { max: '767.98px' },
      mdOnly: { min: '768px', max: '1279.98px' },
      notXl: { max: '1279.98px' },
    },
    container: {
      center: true,
      padding: {
        DEFAULT: '1.25rem',
        sm: '1.25rem',
        md: '2rem',
        xl: '2rem',
      },
      sm: '20px',
      md: '20px',
      xl: '80px',
    },
    fontFamily: {
      inter: ['Inter Tight', 'sans-serif'],
      unbounded: ['Unbounded', 'serif'],
    },
    extend: {
      backgroundColor: (theme) => ({
        ...theme('colors'),
        body: '#F2F1EE', // bg-body
        primary: '#456FAB',
        secondary: '#ffffff',
        main: '#f8f8ff',
        checkbox: '#456FAB',
      }),
      colors: {
        white: {
          DEFAULT: '#ffffff', // *-white
        },
        black: {
          DEFAULT: '#000000', // *-black
          61: '#616161', // *-black-61
        },
        gray: {
          DEFAULT: '#565656', // *-gray
          68: '#686868', // *-gray-68
        },
        accent: {
          DEFAULT: '#FFC72F', // *-accent-yellow
          orange: '#FF8856', // *-accent-orange
          purple: '#A472FF', // *-accent-purple
          purple2: '#5A05F4', // *-accent-purple2
        },

        loading: '#000000',
      },
    },
  },
  plugins: [],
};
