import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
//import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/admin/app.scss',
                'resources/js/admin/app.js',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve:{
        alias:{
            //"~bootstrap":path.resolve(__dirname,"node_modules/bootstrap"),
            //"~sweetalert":path.resolve(__dirname,"node_modules/sweetalert"),
        }
    },
    build: {
        commonjsOptions: { include: [] },
    },
    optimizeDeps: {
        disabled: false,
    },
});
