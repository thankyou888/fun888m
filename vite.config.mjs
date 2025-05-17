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
                    'app-css': 'resources/css/app.css',
                    'editor-style': 'resources/css/editor-style.css',
                    'bonus-grid': 'blocks/bonus-grid/index.jsx',
                },
                output: {
                    entryFileNames: (chunkInfo) => {
                        if (chunkInfo.name === 'bonus-grid') {
                          return 'blocks/bonus-grid/build/index.js';
                        }
                        // if (chunkInfo.name === 'bonus-grid-view') {
                        //   return 'blocks/bonus-grid/build/view.js';
                        // }
                        return 'assets/[name].js'; // for other entries
                  },
                  assetFileNames: (assetInfo) => {
                    if (assetInfo.name === 'index.css' && assetInfo.source.includes('bonus-grid')) { // A bit simplistic, might need refinement
                       return 'blocks/bonus-grid/build/index.css';
                    }
                    return 'assets/[name].[hash][extname]';
                  },
                }, 
                external: [
                /^@wordpress\/.*/, // ✅ อย่ารวม WordPress modules
                ],
            },
        },
        plugins: [
            react(),
            tailwindcss(),
        ],
    }
});
