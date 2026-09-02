import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

const ddevHostname =
    process.env.DDEV_HOSTNAME?.split(',')[0] ??
    'laravel-starter-kit.ddev.site';

let primaryUrl = process.env.DDEV_PRIMARY_URL;
if (primaryUrl) {
    primaryUrl = primaryUrl.replace(/:\d+$/, '') + ':5173';
} else {
    primaryUrl = `https://${ddevHostname}:5173`;
}

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: true,
        strictPort: true,
        port: 5173,
        origin: primaryUrl,
        cors: {
            origin: /https?:\/\/([A-Za-z0-9\-\.]+)?(\.ddev\.site)(?::\d+)?$/,
        },
        hmr: {
            protocol: 'wss',
            host: ddevHostname,
        },
    },
});
