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
