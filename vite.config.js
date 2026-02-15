import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build',
    },
    base: '/build/', // 👈 สำคัญ ตรงนี้จะบังคับให้ asset ใช้ path https://domain/build/...
});
