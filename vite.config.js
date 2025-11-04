import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 
                'resources/js/app.js', 
                'resources/js/chart.js',
                'resources/js/address.js',
                'resources/js/address2.js',
                'resources/js/datetime.js',
                'resources/js/registeraddress.js',
                'resources/js/alpine.js',
                'resources/js/bootstrap.js'
            ],
            refresh: true,
        }),
    ],
});
