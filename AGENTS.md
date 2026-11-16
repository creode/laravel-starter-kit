<laravel-boost-guidelines>
=== .ai/app-modules rules ===

## Modules

- Domain code belongs in `app-modules/{module-name}/`; do not add parallel `app/` trees for module features.
- Use `ddev artisan make:* --module={module}` for module components, and run `ddev artisan modules:sync` after structural changes.
- After creating a module, add its `src` directory to the `<source><include>` list in `phpunit.xml`, for example `<directory>app-modules/{module-name}/src</directory>`. Without it, the module's code is left out of the 100% coverage gate. A glob is not used there because it breaks the type-coverage plugin while no module exists.

=== .ai/creode-web-components rules ===

## Adaptable Web Components (Creode)

- **Single source of truth:** [Web Component Guidelines](https://docs.creode.dev/web-component-guidelines/) on docs.creode.dev — via **Creode Documentation MCP** only. Do not duplicate guideline content in this repo or rely on cached summaries.
- **IMPORTANT:** On every component build or review, activate `creode-web-components` and run **`search-documentation`** (`user-creode-documentation`) with fresh queries before changing markup, CSS, or JS. Guidelines change; query again each task.
- Cite canonical `https://docs.creode.dev/...` URLs from MCP results. Use **`report-documentation-gap`** when docs are missing (with the user's identity as `submitted_by`).

=== .ai/ddev rules ===

## DDEV

This project uses DDEV (`.ddev/`). PHP, database, and Node/npm run inside the web container; the project root in the container is `/var/www/html`.

- **IMPORTANT:** Do not run PHP, Composer, Artisan, Pest, Pint, Rector, PHPStan, or frontend (npm) commands on the host. Always run them through DDEV so tooling matches the project environment.
- Run `ddev start` if DDEV is not already running before other commands.
- **Composer:** `ddev composer install`, `ddev composer require …`, `ddev composer update`
- **Artisan:** `ddev artisan …` (e.g. `ddev artisan migrate`, `ddev artisan test --compact`)
- **PHP binaries:** `ddev exec vendor/bin/pest …`, `ddev exec vendor/bin/pint …`, `ddev exec php artisan tinker --execute '…'`
- **Frontend:** `ddev npm install`, `ddev npm run build`, `ddev npm run dev`
- **Composer scripts** that invoke PHP/Node (e.g. `composer run dev`, `composer run test`): use `ddev composer run …`, not host `composer`.
- For Laravel debugging, read `storage/logs/laravel.log` — do not rely on host-only log paths outside the project.

=== .ai/frontend-styling rules ===

## SCSS & BEM (no Tailwind)

- Styles are compiled with **SCSS** through Vite (`resources/scss/app.scss`). Use **`ddev npm run dev`** / **`ddev npm run build`**.
- **Do not use Tailwind** or other utility-first CSS frameworks in this project.
- Each UI component gets **BEM** classes in Blade and a dedicated partial: `resources/scss/components/_{block-name}.scss`, registered in `app.scss` via `@use`.
- Component compatibility and naming discipline: query **Creode Documentation MCP** per `creode-web-components` — do not duplicate those guidelines in the repo.

=== .ai/php-runtime rules ===

## PHP runtime

- **PHP runtime:** Target **8.4** everywhere (DDEV, Composer, production). Hosting does not support 8.5 yet — do not adopt 8.5-only language features or raise the minimum above 8.4.

=== foundation rules ===

# Laravel Boost Guidelines

## Foundational Context

This application is a Laravel application running on PHP 8.4. Always use the APIs that match the installed major version of each package — do not assume a version.

Before relying on a package's API, confirm its installed version:
- PHP packages: run `ddev composer show --direct` to list direct dependencies with versions, or `ddev composer show <vendor/package>` for a single package.
- JS packages: check `package.json` for the installed versions.

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If a frontend change doesn't show in the UI or you get a "Unable to locate file in Vite manifest" error, run `ddev npm run build` or ask the user to run `ddev npm run dev` or `ddev composer run dev`.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Use `search-docs` before changes that depend on Laravel ecosystem APIs, behavior, configuration, or version-specific syntax. Skip it for copy-only edits and other changes where package documentation is irrelevant. Reuse sufficient results already in context instead of searching again.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Project Rules

- This project contains committed, area-grouped rules in `.ai/rules` when that directory exists, including path-scoped framework guidelines under `.ai/rules/boost`. Before you enter plan mode or create/edit any file, you MUST first: open @.ai/rules/index.md (it maps file globs to rule files), read every rule file whose globs cover the path(s) in scope, and run `grep -rin 'keyword' .ai/rules` to catch what a path match alone misses. Do not write code until you have read and are following every matching rule. If `.ai/rules` does not exist, continue without it.

## Artisan

- Run Artisan commands directly via the command line (e.g., `ddev php artisan route:list`). Use `ddev php artisan list` to discover available commands and `ddev php artisan [command] --help` to check parameters.
- Inspect routes with `ddev php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `ddev php artisan config:show app.name`, `ddev php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `ddev php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `ddev php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.

=== tests rules ===

# Test Enforcement

- Add or update tests for behavior and logic changes when a test provides meaningful regression coverage.
- Pure copy, styling, and layout-only changes do not require new or updated tests.
- When test coverage applies, run the affected tests and ensure they pass.
- Test the changed behavior and its important failure modes, but do not add tests beyond them.
- Read the `testing-best-practices` skill before writing tests.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `ddev php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `ddev php artisan list` and check their parameters with `ddev php artisan [command] --help`.
- If you're creating a generic PHP class, use `ddev php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `ddev php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `ddev php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `ddev exec vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `ddev exec vendor/bin/pint --test --format agent`, simply run `ddev exec vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

# Pest

- This project uses Pest. Create tests with `ddev php artisan make:test --pest {name}`.
- Do not include the test suite directory in `{name}`. Use `SomeFeatureTest`, not `Feature/SomeFeatureTest`.
- Read the `testing-best-practices` skill for guidance on coverage, naming, structure, dependency isolation, and review.
- Do not delete tests or test files without approval. They are part of the application.

## Running Tests

- Run the narrowest set of tests that covers the change. Pass a file path or `--filter=testName` to `ddev php artisan test --compact`.
- Rerun a test after each change to it.
- Run `ddev exec vendor/bin/pest` to call the test runner directly. It accepts the same file path and `--filter=testName` arguments.

=== internachi/modular/core rules ===

## Modular

- This a modular application. Each module is located in its own directory inside of `app-modules`.
- IMPORTANT: Activate `modular` every time you're working with or creating a new module.

</laravel-boost-guidelines>
