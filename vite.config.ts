import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import {defineConfig} from 'vite-plus';

export default defineConfig({
    fmt: {
        printWidth: 80,
        tabWidth: 4,
        useTabs: false,
        semi: true,
        singleQuote: true,
        overrides: [
            {
                files: ["**/*.yml"],
                options: {
                    tabWidth: 2,
                },
            },
        ],
        sortTailwindcss: {
            functions: ["clsx", "cn"],
            stylesheet: "resources/css/app.css",
        },
        sortImports: {
            groups: ["builtin", "external", "internal", "parent", "sibling", "index"],
            newlinesBetween: false,
        },
        ignorePatterns: ["resources/views/mail/*"],
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
