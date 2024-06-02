const mix = require('laravel-mix');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
// mix.js('resources/js/app.js', 'public/js').vue().postCss('resources/css/app.css', 'public/css', [require("tailwindcss")])
mix.js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss')
    ])
    .version();
mix.ts('resources/js/utils/functions.ts', 'public/js');
mix.webpackConfig({
    resolve: {
        extensions: [".wasm", ".mjs", ".js", ".jsx", ".json", ".ts", ".tsx", ".vue"]
    }
});
// Optionally, you can enable source maps for better debugging in development mode
if (!mix.inProduction()) {
    mix.webpackConfig({devtool: 'source-map'})
        .sourceMaps();
}

if (mix.inProduction()) {
    mix.version();
}
