import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    server: {
        host: "tasksdemo.local",
        port: 5173,
        strictPort: true,

        cors: {
            origin: /https?:\/\/([A-Za-z0-9\-\.]+)?(\.local)(?::\d+)?$/,
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss()
    ],
});
