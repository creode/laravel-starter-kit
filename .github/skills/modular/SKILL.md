---
name: modular
description: Create or modify Laravel modules using `internachi/modular`. Use when the user asks to create a module, add components to a module, scaffold module structure, or work on files in an `app-modules` directory.
argument-hint: <module-name> [component-type]
---

# Laravel Modular Development

You are helping with a Laravel application that uses `internachi/modular` for modular architecture. Modules live in `app-modules/` and follow Laravel package conventions.

**DDEV:** This project runs in DDEV. Prefix all `composer`, `php artisan`, and `vendor/bin` commands with `ddev` (e.g. `ddev artisan make:module`, `ddev composer update modules/foo`).

## Module Structure

The structure of `app-modules` mimics a standard Laravel application, where what typically would be found in `app` is found in `src`:

```
app-modules/
  {module-name}/
    composer.json # PSR-4 autoload, Laravel provider discovery

    src/
      Providers/
      Models/
      Http/
    tests/
      Feature/
      Unit/
    routes/
      {module-name}-routes.php
    resources/
    database/
      migrations/
      factories/
      seeders/
```

## Creating a New Module

When asked to create a new module:

1. **Check if `internachi/modular` is installed:**
   ```bash
   ddev composer show internachi/modular
   ```
   If not installed, install it first:
   ```bash
   ddev composer require internachi/modular
   ```

2. **Check the modular namespace:**

    - Check for `config/app-modules.php`
    - If present, get the `modules_vendor` value from that file
    - If not, assume the vendor name is "modules"

3. **Create the module:**
   ```bash
   ddev artisan make:module {module-name} --no-interaction
   ```

4. **Register with Composer:**
   ```bash
   ddev composer update {module-vendor}/{module-name}
   ```
5. **Sync modules**
   ```bash
   ddev artisan modules:sync
   ```

## Adding Components to a Module

Use the `--module` flag with Laravel's make commands:

| Component  | Command                                                                              |
|------------|--------------------------------------------------------------------------------------|
| Model      | `ddev artisan make:model {Name} --module={module} --no-interaction`                   |
| Controller | `ddev artisan make:controller {Name}Controller --module={module} --no-interaction`    |
| Migration  | `ddev artisan make:migration create_{table}_table --module={module} --no-interaction` |
| Factory    | `ddev artisan make:factory {Name}Factory --module={module} --no-interaction`          |
| Seeder     | `ddev artisan make:seeder {Name}Seeder --module={module} --no-interaction`            |
| Request    | `ddev artisan make:request {Name}Request --module={module} --no-interaction`          |
| Test       | `ddev artisan make:test {Name}Test --module={module} --no-interaction`                |
| Policy     | `ddev artisan make:policy {Name}Policy --module={module} --no-interaction`            |
| Event      | `ddev artisan make:event {Name} --module={module} --no-interaction`                   |
| Listener   | `ddev artisan make:listener {Name} --module={module} --no-interaction`                |
| Job        | `ddev artisan make:job {Name} --module={module} --no-interaction`                     |
| Middleware | `ddev artisan make:middleware {Name} --module={module} --no-interaction`              |
| Resource   | `ddev artisan make:resource {Name}Resource --module={module} --no-interaction`        |
| Rule       | `ddev artisan make:rule {Name} --module={module} --no-interaction`                    |
| Observer   | `ddev artisan make:observer {Name}Observer --module={module} --no-interaction`        |

## Module Conventions

### Namespacing

- Default namespace: `{ModuleVendor}\{ModuleName}\`
- Example: `Modules\Billing\Models\Invoice`

### composer.json Format

```json
{
    "name": "{module-vendor}/{module-name}",
    "require": {},
    "autoload": {
        "psr-4": {
            "{ModuleVendor}\\{ModuleName}\\": "src/"
        }
    },
    "extra": {
        "laravel": {
            "providers": [
                "{ModuleVendor}\\{ModuleName}\\Providers\\{ModuleName}ServiceProvider"
            ]
        }
    }
}
```

### Routes

- By convention, module routes are in `routes/{module-name}-routes.php`
- By convention, module route names are prefixed with the module name (eg. `billing::dashboards.index`)
- If necessary, break into separate files as needed (eg. `routes/{module-name}-api.php`)
- Routes are auto-discovered—no need to register them

### Migrations

- Place in `database/migrations/`
- Auto-discovered by Laravel's migrator
- Run with `ddev artisan migrate`

### Factories

- Place in `database/factories/`
- Auto-loaded for `factory()` calls
- Namespace: `{ModuleVendor}\{ModuleName}\Database\Factories`

### Tests

- Place in `tests/Feature/` and `tests/Unit/`
- Run module tests: `ddev artisan test app-modules/{module-name}/tests`
- All module tests can be run using the `Modules` testsuite configuration that is auto-generated by the `modules:sync` command

### Cross-Module Dependencies

- Import models/services from other modules directly
- Example: `use Modules\Billing\Models\Invoice;`
- Keep dependencies minimal and unidirectional when possible

## Available Commands

```bash

# List all modules

ddev artisan modules:list

# Sync phpunit.xml and IDE configs

ddev artisan modules:sync

# Cache module configs

ddev artisan modules:cache

# Clear module cache

ddev artisan modules:clear

# Run module seeders

ddev artisan db:seed --module={module-name}
```

## Best Practices

1. **One domain per module** - Group related functionality together
2. **Minimal cross-dependencies** - Modules should be loosely coupled
3. **Follow Laravel conventions** - Use standard directory structure within modules (treat `src` like `app`)

## When Processing Arguments

If `$ARGUMENTS` contains:

- Just a module name (e.g., "billing"): Create the module or list what can be added
- Module + component (e.g., "billing model Invoice"): Create that specific component
- "list": Show existing modules with `ddev artisan modules:list`