const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    
    theme: {
        extend: {
            fontFamily: {
                'sans': ['Montserrat', 'sans-serif'],
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ['active'],
            
        }
    },
    content: [
        './app/**/*.php',
        './resources/**/*.html',
        './resources/**/*.js',
        './resources/**/*.jsx',
        './resources/**/*.ts',
        './resources/**/*.tsx',
        './resources/**/*.php',
        './resources/**/*.vue',
        './resources/**/*.twig',
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
