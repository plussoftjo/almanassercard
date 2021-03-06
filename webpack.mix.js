const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/containers/Code/code.js", "public/js")
    .js("resources/js/containers/CodeTrash/code_trash.js", "public/js")
    .js("resources/js/containers/AddCode/add_code.js", "public/js")
    .js("resources/js/containers/EditCode/edit_code.js", "public/js")
    .js("resources/js/containers/Dashboard/dashboard.js", "public/js")
    .js("resources/js/containers/AddBalance/add_balance.js", "public/js")
    .js("resources/js/containers/Reports/reports.js", "public/js")
    .js("resources/js/containers/FetchCount/fetch_count.js", "public/js")
    .js("resources/js/containers/Clients/clients.js", "public/js")
    .js("resources/js/containers/ShowClients/show_clients.js", "public/js")
    .js("resources/js/containers/CodeChecker/code_checker.js", "public/js")
    .sass("resources/sass/app.scss", "public/css");
