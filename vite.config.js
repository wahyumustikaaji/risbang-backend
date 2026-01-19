import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    base: '/admin/',
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    build: {
        outDir: 'public/admin/build',
        manifest: true,
        rollupOptions: {
            input: ['resources/css/app.css', 'resources/js/app.js'],
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            buildDirectory: 'admin/build',
        }),
    ],
});
