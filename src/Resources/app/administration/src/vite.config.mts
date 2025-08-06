import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
    resolve: {
        alias: {
            '@slugify': resolve(__dirname, '../node_modules/slugify'),
        },
    },
});
