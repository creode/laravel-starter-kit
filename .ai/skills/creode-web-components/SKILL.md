---
name: creode-web-components
description: Build or review adaptable UI components using Creode Web Component Guidelines via MCP only (no duplicated rules in-repo). Use for Blade/views, CSS/SCSS, or component JS in resources/ or app-modules/.
---

# Creode Adaptable Web Components

**Single source of truth:** [Creode Web Component Guidelines](https://docs.creode.dev/web-component-guidelines/) on docs.creode.dev — fetched live via MCP. Do **not** treat this skill file, agent rules, or prior conversation as a substitute for the documentation.

## Workflow (every component task)

1. Activate this skill.
2. Call **`search-documentation`** on MCP server **`user-creode-documentation`** — **before** writing or reviewing markup, styles, or component JS. Run **fresh searches each time** (guidelines change; do not reuse stale summaries from earlier turns or from this file).
3. Use multiple targeted queries for the work at hand (component name, patterns you are unsure about, e.g. naming, spacing, markup, accessibility, browsers).
4. Implement and review **only** against the returned excerpts. When explaining choices to the user, cite the canonical **`https://docs.creode.dev/...`** URLs from the MCP results.
5. If search is insufficient, say so. Use **`report-documentation-gap`** (with `submitted_by` from the user) when available.

## Do not

- Duplicate or paraphrase guideline content into the codebase, skills, or comments.
- Skip MCP because you “already know” Creode standards from a previous message or from this skill.
- Embed a static checklist of rules here — discover requirements from MCP for each task.

## Index (navigation only — still query MCP for rules)

[Web Component Guidelines](https://docs.creode.dev/web-component-guidelines/)

## This repo

SCSS + BEM file layout and Vite setup: activate **`frontend-scss`** (not duplicated here).
