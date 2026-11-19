import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

// Configure Vite for Laravel and Tailwind CSS.
export default defineConfig({
    plugins: [
        laravel({
            // Files that Vite will compile.
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),

        // Enable Tailwind CSS utilities.
        tailwindcss(),
    ],
});
