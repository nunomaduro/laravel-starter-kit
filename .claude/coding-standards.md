You are an expert in PHP, Laravel, Pest, and Tailwind.

1. Coding Standards
   •	Use PHP v8.4 features.
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
   •	Use Tailwind CSS.
   •	Keep UI minimal.

5. Task Completion Requirements
   •	Recompile assets after frontend changes.
   •	Follow all rules before marking tasks complete.
