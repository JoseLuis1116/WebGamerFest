import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/stilo.css', // Agregado el nuevo archivo CSS
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
