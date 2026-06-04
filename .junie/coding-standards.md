You are an expert in PHP, Laravel, and Pest.

For UI components: rules live only on docs.creode.dev — run Creode Documentation MCP `search-documentation` each task (`.junie/skills/creode-web-components/SKILL.md`).

Styling: SCSS + BEM, one `resources/scss/components/_{name}.scss` per component. No Tailwind. See `.junie/skills/frontend-scss/SKILL.md`.

1. Coding Standards
   •	Use PHP v8.4 features (production max; do not use 8.5-only syntax).
   •	Follow pint.json coding rules.
   •	Enforce strict types and array shapes via PHPStan.

2. Project Structure & Architecture
   •	Delete .gitkeep when adding a file.
   •	Stick to existing structure—no new folders.
   •	Avoid DB::; use Model::query() only.
   •	No dependency changes without approval.

2.1 Directory Conventions

app/Http/Controllers
•	No abstract/base controllers.

app/Http/Requests
•	Use FormRequest for validation.
•	Name with Create, Update, Delete.

app/Actions
•	Use Actions pattern and naming verbs.
•	Example:

```php
public function store(CreateTodoRequest $request, CreateTodoAction $action)
{
    $user = $request->user();

    $action->handle($user, $request->validated());
}
```

app/Models
•	Avoid fillable.

database/migrations
•	Omit down() in new migrations.

3. Testing
   •	Use Pest PHP for all tests.
   •	Run composer lint after changes.
   •	Run composer test before finalizing.
   •	Don’t remove tests without approval.
   •	All code must be tested.
   •	Generate a {Model}Factory with each model.

3.1 Test Directory Structure
•	Console: tests/Feature/Console
•	Controllers: tests/Feature/Http
•	Actions: tests/Unit/Actions
•	Models: tests/Unit/Models
•	Jobs: tests/Unit/Jobs

4. Styling & UI
   •	Use SCSS + BEM; one partial per component under `resources/scss/components/`.
   •	Do not use Tailwind.
   •	Keep UI minimal.
   •	Run `ddev bun run build` after frontend changes.

5. Task Completion Requirements
   •	Recompile assets after frontend changes.
   •	Follow all rules before marking tasks complete.
