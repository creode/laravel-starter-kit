## Modules

- Domain code belongs in `app-modules/{module-name}/`; do not add parallel `app/` trees for module features.
- Use `ddev artisan make:* --module={module}` for module components, and run `ddev artisan modules:sync` after structural changes.
- After creating a module, add its `src` directory to the `<source><include>` list in `phpunit.xml`, for example `<directory>app-modules/{module-name}/src</directory>`. Without it, the module's code is left out of the 100% coverage gate. A glob is not used there because it breaks the type-coverage plugin while no module exists.
