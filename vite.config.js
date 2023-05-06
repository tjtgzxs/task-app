import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/project.scss',
                'resources/js/app.js',
                'resources/js/project.js',
                'resources/js/jquery-3.6.4.min.js',
                'resources/js/jquery-ui.min.js',
            ],
            refresh: true,
        }),
    ],
});
