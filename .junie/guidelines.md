<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.4
- laravel/framework (LARAVEL) - v13
- laravel/prompts (PROMPTS) - v0
- larastan/larastan (LARASTAN) - v3
- laravel/boost (BOOST) - v2
- laravel/mcp (MCP) - v0
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- pestphp/pest (PEST) - v4
- phpunit/phpunit (PHPUNIT) - v12
- rector/rector (RECTOR) - v2

- **PHP runtime:** Target **8.4** everywhere (DDEV, Composer, production). Hosting does not support 8.5 yet — do not adopt 8.5-only language features or raise the minimum above 8.4.

## Skills Activation

This project has domain-specific skills available. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

- `laravel-best-practices` — Apply this skill whenever writing, reviewing, or refactoring Laravel PHP code. This includes creating or modifying controllers, models, migrations, form requests, policies, jobs, scheduled commands, service classes, and Eloquent queries. Triggers for N+1 and query performance issues, caching strategies, authorization and security patterns, validation, error handling, queue and job configuration, route definitions, and architectural decisions. Also use for Laravel code reviews and refactoring existing Laravel code to follow best practices. Covers any task involving Laravel backend PHP code patterns.
- `modular` — Activate when creating or modifying Laravel modules with `internachi/modular`, scaffolding module structure, or working in `app-modules/`. Covers `make:module`, `--module` Artisan flags, module routes, migrations, factories, tests, and cross-module dependencies.

=== internachi/modular rules ===

## Modular

- This is a modular application. Each module is located in its own directory inside `app-modules/`.
- IMPORTANT: Activate the `modular` skill every time you are working with or creating a module.
- Use `ddev artisan make:* --module={module}` for module components; run `ddev artisan modules:sync` after structural changes.

=== ddev rules ===

## DDEV

This project uses DDEV (`.ddev/`). PHP, database, and Node/bun run inside the web container; the project root in the container is `/var/www/html`.

- **IMPORTANT:** Do not run PHP, Composer, Artisan, Pest, Pint, Rector, PHPStan, or frontend (bun/npm) commands on the host. Always run them through DDEV so tooling matches the project environment.
- Run `ddev start` if DDEV is not already running before other commands.
- **Composer:** `ddev composer install`, `ddev composer require …`, `ddev composer update`
- **Artisan:** `ddev artisan …` (e.g. `ddev artisan migrate`, `ddev artisan test --compact`)
- **PHP binaries:** `ddev exec vendor/bin/pest …`, `ddev exec vendor/bin/pint …`, `ddev exec php artisan tinker --execute '…'`
- **Frontend:** `ddev bun install`, `ddev bun run build`, `ddev bun run dev` (or `ddev exec npm …` when using npm)
- **Composer scripts** that invoke PHP/Node (e.g. `composer run dev`, `composer run test`): use `ddev composer run …`, not host `composer`.
- For Laravel debugging, read `storage/logs/laravel.log` — do not rely on host-only log paths outside the project.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Domain code belongs in `app-modules/{module-name}/` (see Modular rules above); do not add parallel `app/` trees for module features.
- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `ddev bun run build`, `ddev bun run dev`, or `ddev composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Always use `search-docs` before making code changes. Do not skip this step. It returns version-specific docs based on installed packages automatically.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Artisan

- Run Artisan via DDEV (e.g. `ddev artisan route:list`). Use `ddev artisan list` to discover commands and `ddev artisan [command] --help` for parameters.
- Inspect routes with `ddev artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `ddev artisan config:show app.name`, `ddev artisan config:show database.default`. Or read config files directly from the `config/` directory.
- To check environment variables, read the `.env` file directly.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `ddev exec php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `ddev exec php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8.4-compatible features and constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== tests rules ===

# Test Enforcement

- Every change must be programmatically tested. Write a new test or update an existing test, then run the affected tests to make sure they pass.
- Run the minimum number of tests needed to ensure code quality and speed. Use `ddev artisan test --compact` with a specific filename or filter.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `ddev artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `ddev artisan list` and check their parameters with `ddev artisan [command] --help`.
- If you're creating a generic PHP class, use `ddev artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `ddev artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `ddev artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `ddev bun run build` or ask the user to run `ddev bun run dev` or `ddev composer run dev`.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `ddev exec vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `ddev exec vendor/bin/pint --test --format agent`, simply run `ddev exec vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

## Pest

- This project uses Pest for testing. Create tests: `ddev artisan make:test --pest {name}`.
- Run tests: `ddev artisan test --compact` or filter: `ddev artisan test --compact --filter=testName`.
- Do NOT delete tests without approval.

</laravel-boost-guidelines>
