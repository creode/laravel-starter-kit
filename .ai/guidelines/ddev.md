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

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `ddev npm run build`, `ddev npm run dev`, or `ddev composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.
