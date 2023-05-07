import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/project.scss',
                'resources/js/jquery-ui.min.js',
                'resources/js/app.js',
                'resources/js/project.js',
            ],
            refresh: true,
        }),
    ],
});
