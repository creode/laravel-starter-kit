## SCSS & BEM (no Tailwind)

- Styles are compiled with **SCSS** through Vite (`resources/scss/app.scss`). Use **`ddev npm run dev`** / **`ddev npm run build`**.
- **Do not use Tailwind** or other utility-first CSS frameworks in this project.
- Each UI component gets **BEM** classes in Blade and a dedicated partial: `resources/scss/components/_{block-name}.scss`, registered in `app.scss` via `@use`.
- Component compatibility and naming discipline: query **Creode Documentation MCP** per `creode-web-components` — do not duplicate those guidelines in the repo.
