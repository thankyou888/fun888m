import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'
import react from '@vitejs/plugin-react';

export default defineConfig(({ command }) => {
    const isBuild = command === 'build';

    return {
        base: isBuild ? '/wp-content/themes/fun888m/dist/' : '/',
        esbuild: {
            loader: 'jsx',
            include: /.*\.(js|jsx)$/, // ✅ รองรับ JSX เต็มรูปแบบ
          },
        server: {
            port: 3000,
            cors: true,
            origin: 'http://dev-fun888m.local',
        },
        build: {
            manifest: true,
            outDir: 'dist',
            rollupOptions: {
                input: {
                    'app': 'resources/js/app.js',
                    'theme-switcher': 'resources/js/theme-switcher.js',
                    'app-css': 'resources/css/app.css',
                    'editor-style': 'resources/css/editor-style.css',
                },
                output: {
                    entryFileNames: '[name].js',
                    chunkFileNames: '[name].js',
                    assetFileNames: '[name].[ext]',
                },
            },
        },
        plugins: [
            react(),
            tailwindcss(),
        ],
    }
});
