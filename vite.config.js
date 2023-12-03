import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'public/resources/css/form.css',
                'public/resources/css/profile.css',
            ],
            refresh: false,
        }),
    ],
    build: {
        assetsDir: 'public',
    },
});
