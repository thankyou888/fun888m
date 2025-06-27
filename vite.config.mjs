import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig(({ command }) => {
    const isBuild = command === 'build';

    return {
        base: isBuild ? '/wp-content/themes/fun888m/dist/' : '/',
        server: {
            port: 3000,
            cors: true,
            origin: 'http://all88bet.local',
        },
        build: {
            manifest: true,
            outDir: 'dist',
            rollupOptions: {
                input: [
                    'resources/js/app.js',
                    'resources/js/theme-switcher.js',
                    'resources/css/app.css',
                    'resources/css/editor-style.css',
                ],
                output: {
                    entryFileNames: '[name].js',
                    chunkFileNames: '[name].js',
                    assetFileNames: '[name].[ext]',
                },
            },
        },
        plugins: [
            tailwindcss(),
        ],
    }
});