// const mix =require('laravel-mix')

// mix.browserSync('127.0.0.1:8000');

const mix = require('laravel-mix');

mix.browserSync({
    proxy: '127.0.0.1:8000', // Proxy your Laravel server
    port: 8000, // Set BrowserSync to use port 8000
    open: true // Optional: Do not automatically open the browser
});