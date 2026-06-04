---
name: frontend-scss
description: Frontend styling for this project — SCSS compiled via Vite, BEM class names, one SCSS partial per component. Use when adding or changing Blade UI, SCSS, or component styles. Do not use Tailwind.
---

# Frontend SCSS & BEM (project convention)

This starter compiles **SCSS** through Vite (`resources/scss/app.scss`). **Tailwind is not used.**

Pair with `creode-web-components`: Creode compatibility rules come from **Creode Documentation MCP** only; this skill covers **how this repo organises styles**.

## Structure

```
resources/scss/
  app.scss                 # Entry — @use partials only
  abstracts/_variables.scss
  base/_reset.scss
  base/_typography.scss
  components/_{name}.scss   # One file per UI component (BEM block name)
resources/views/
  welcome.blade.php          # Page templates use BEM classes
  components/              # Blade components (optional)
```

## Adding a component

1. Choose a **purpose-driven** kebab-case name (e.g. `product-teasers`) — align naming with Creode MCP search results when building client UI.
2. Markup: root class = BEM **block** (`product-teasers`), children `product-teasers__element`, states `product-teasers__element--modifier`.
3. Create `resources/scss/components/_product-teasers.scss` (leading underscore partial; block name matches file).
4. Add `@use 'components/product-teasers';` to `resources/scss/app.scss`.
5. Do **not** add Tailwind classes. Do **not** put component rules in unrelated partials.
6. Run `ddev bun run dev` or `ddev bun run build` to compile.

## Blade components

- Prefer `resources/views/components/{name}.blade.php` with explicit BEM classes on the root element.
- Keep styles in the matching `components/_{name}.scss` partial, not inline `<style>` or utility frameworks.

## Vite

- Inputs are configured in `vite.config.ts`: `resources/scss/app.scss`, `resources/js/app.js`.
- Reference in layouts: `@vite(['resources/scss/app.scss', 'resources/js/app.js'])`.

## Commands (DDEV)

```bash
ddev bun install
ddev bun run dev
ddev bun run build
```
