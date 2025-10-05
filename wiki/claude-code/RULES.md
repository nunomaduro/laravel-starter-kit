# 📋 Rules & Guidelines Reference

This document explains all the rules and guidelines that Claude Code follows after setup. These are organized by technology and concern.

---

## Table of Contents

1. [Foundation Rules](#foundation-rules)
2. [Laravel Core Rules](#laravel-core-rules)
3. [Laravel 12 Specific Rules](#laravel-12-specific-rules)
4. [PHP Standards](#php-standards)
5. [Testing with Pest](#testing-with-pest)
6. [Pest 4 Advanced Features](#pest-4-advanced-features)
7. [Frontend with Tailwind CSS](#frontend-with-tailwind-css)
8. [Code Quality Tools](#code-quality-tools)
9. [Laravel Boost MCP](#laravel-boost-mcp)
10. [Custom Project Rules](#custom-project-rules)

---

## Foundation Rules

### Conventions

**Always follow existing code conventions**
- Check sibling files for structure, approach, and naming before creating new files
- Use descriptive names: `isRegisteredForDiscounts` not `discount()`
- Check for existing components to reuse before writing new ones

**Directory Structure**
- ❌ **DO NOT** create new base folders without approval
- ✅ Stick to the existing directory structure
- ❌ **DO NOT** change application dependencies without approval

**Documentation**
- ❌ **DO NOT** create documentation files unless explicitly requested
- ✅ Only create docs when the user asks for them

**Verification Scripts**
- ❌ **DO NOT** create verification scripts when tests already cover functionality
- ✅ Prefer unit and feature tests over tinker scripts

**Replies**
- ✅ Be concise in explanations
- ✅ Focus on what's important rather than obvious details

---

## Laravel Core Rules

### Do Things the Laravel Way

**File Generation**
- ✅ Use `php artisan make:*` commands to create new files
- ✅ Use `artisan make:class` for generic PHP classes
- ✅ Pass `--no-interaction` to all Artisan commands
- ✅ Pass correct `--options` for desired behavior

### Database & Eloquent

**Prefer Eloquent Over Raw Queries**
- ✅ Use proper Eloquent relationship methods with return type hints
- ✅ Use `Model::query()` instead of `DB::`
- ❌ Avoid bypassing Laravel's ORM
- ✅ Prevent N+1 query problems with eager loading
- ✅ Use query builder only for very complex operations

**Model Creation**
- ✅ Create factories when creating models
- ✅ Create seeders when creating models
- ✅ Ask user about additional needs using `list-artisan-commands`

### APIs & Resources

**API Development**
- ✅ Default to Eloquent API Resources
- ✅ Use API versioning
- ⚠️ Unless existing routes don't follow this pattern (then follow existing convention)

### Controllers & Validation

**Form Requests for Validation**
- ✅ **ALWAYS** create FormRequest classes instead of inline validation
- ✅ Include both validation rules AND custom error messages
- ✅ Check sibling FormRequests to match array vs string rule style

**Example:**
```php
// ❌ BAD - Inline validation
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
    ]);
}

// ✅ GOOD - FormRequest
public function store(CreateTodoRequest $request, CreateTodoAction $action)
{
    $user = $request->user();
    $action->handle($user, $request->validated());
}
```

### Queues

**Time-Consuming Operations**
- ✅ Use queued jobs with `ShouldQueue` interface for long-running tasks

### Authentication & Authorization

**Built-in Features**
- ✅ Use Laravel's authentication (gates, policies, Sanctum, etc.)

### URL Generation

**Named Routes**
- ✅ Prefer `route()` function with named routes for links

### Configuration

**Environment Variables**
- ✅ Use env variables **ONLY in config files**
- ❌ **NEVER** use `env()` function outside of config files
- ✅ Use `config('app.name')` not `env('APP_NAME')`

### Testing Conventions

**Model Factories**
- ✅ Use factories when creating models for tests
- ✅ Check if factory has custom states before manual setup

**Faker**
- ✅ Use `$this->faker->word()` or `fake()->randomDigit()`
- ✅ Follow existing convention (`$this->faker` vs `fake()`)

**Test Creation**
- ✅ Use `php artisan make:test <name>` for feature tests
- ✅ Use `--unit` flag for unit tests
- ✅ Most tests should be feature tests

### Vite Error Handling

**Manifest Errors**
- If you see: `Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest`
- Solution: Run `npm run build` or ask user to run `npm run dev` / `composer run dev`

---

## Laravel 12 Specific Rules

### Version-Specific Documentation

**Always use version-specific docs**
- ✅ Use `search-docs` tool for Laravel 12 documentation
- ❌ Don't rely on outdated Laravel patterns

### Streamlined File Structure

**Since Laravel 11, structure has changed:**

**Middleware**
- ❌ No middleware files in `app/Http/Middleware/`
- ✅ Use `bootstrap/app.php` to register middleware

**Service Providers**
- ❌ No `app/Providers/` directory in many cases
- ✅ Use `bootstrap/providers.php` for app-specific providers

**Console Kernel**
- ❌ **NO** `app/Console/Kernel.php`
- ✅ Use `bootstrap/app.php` or `routes/console.php` for console configuration

**Command Auto-Registration**
- ✅ Files in `app/Console/Commands/` automatically register
- ❌ No manual registration needed

### Database Migrations

**Column Modifications**
- ⚠️ When modifying a column, include **ALL previously defined attributes**
- ❌ Missing attributes will be dropped and lost

**Eager Loading Limits**
- ✅ Laravel 11+ allows limiting eagerly loaded records natively:
  ```php
  $query->latest()->limit(10);
  ```
- ❌ No external packages needed

### Models

**Casts Method**
- ✅ Casts **should** be set in `casts()` method
- ⚠️ Not the `$casts` property
- ✅ Follow existing conventions from other models

**Example:**
```php
// ✅ MODERN (Laravel 12)
protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];
}

// ❌ OLD (Still works but not preferred)
protected $casts = [
    'email_verified_at' => 'datetime',
];
```

---

## PHP Standards

### Control Structures

**Curly Braces Always**
- ✅ Always use curly braces, even for single-line statements

```php
// ❌ BAD
if ($condition)
    doSomething();

// ✅ GOOD
if ($condition) {
    doSomething();
}
```

### Constructors

**Property Promotion**
- ✅ Use PHP 8 constructor property promotion

```php
// ✅ GOOD
public function __construct(
    public GitHub $github,
    public Cache $cache
) {}

// ❌ BAD
private GitHub $github;
private Cache $cache;

public function __construct(GitHub $github, Cache $cache)
{
    $this->github = $github;
    $this->cache = $cache;
}
```

**Empty Constructors**
- ❌ **DO NOT** allow empty `__construct()` with zero parameters

### Type Declarations

**Explicit Return Types**
- ✅ **ALWAYS** use explicit return type declarations

```php
// ✅ GOOD
protected function isAccessible(User $user, ?string $path = null): bool
{
    return $user->hasAccessTo($path);
}

// ❌ BAD (missing return type)
protected function isAccessible(User $user, ?string $path = null)
{
    return $user->hasAccessTo($path);
}
```

**Method Parameters**
- ✅ Use appropriate PHP type hints for all parameters

### Comments & Documentation

**PHPDoc Over Comments**
- ✅ Prefer PHPDoc blocks over inline comments
- ❌ **NEVER** use comments within code unless very complex

**Array Shapes**
- ✅ Add useful array shape type definitions when appropriate

```php
/**
 * @param array{id: int, name: string, email: string} $userData
 */
public function createUser(array $userData): User
{
    // ...
}
```

### Enums

**TitleCase Keys**
- ✅ Enum keys should be TitleCase

```php
// ✅ GOOD
enum FavoriteLake: string
{
    case Superior = 'superior';
    case Michigan = 'michigan';
    case Huron = 'huron';
}

// ❌ BAD
enum FavoriteLake: string
{
    case SUPERIOR = 'superior';
    case michigan = 'michigan';
}
```

---

## Testing with Pest

### Test Requirements

**Everything Must Be Tested**
- ✅ If you need to verify a feature, write or update a test
- ❌ **DO NOT** remove tests or test files without approval
- ✅ Tests are **core to the application**, not temporary files

### Pest Syntax

**Use Pest, Not PHPUnit**
- ✅ All tests must use Pest syntax
- ✅ Use `php artisan make:test --pest <name>`

```php
// ✅ GOOD (Pest)
it('is true', function () {
    expect(true)->toBeTrue();
});

// ❌ BAD (PHPUnit)
public function testIsTrue()
{
    $this->assertTrue(true);
}
```

### Test Coverage

**Test All Paths**
- ✅ Test happy paths
- ✅ Test failure paths
- ✅ Test weird/edge cases

### Test Location

**Directory Structure**
- ✅ Feature tests: `tests/Feature/`
- ✅ Unit tests: `tests/Unit/`

**Specific Conventions**
- Console commands: `tests/Feature/Console/`
- Controllers: `tests/Feature/Http/`
- Actions: `tests/Unit/Actions/`
- Models: `tests/Unit/Models/`
- Jobs: `tests/Unit/Jobs/`

### Running Tests

**Minimal Test Runs**
- ✅ Run minimal number of tests using filters
- ✅ `php artisan test` - all tests
- ✅ `php artisan test tests/Feature/ExampleTest.php` - specific file
- ✅ `php artisan test --filter=testName` - specific test (recommended after changes)

### Pest Assertions

**Specific Assertion Methods**
- ✅ Use specific methods like `assertForbidden`, `assertNotFound`
- ❌ Avoid generic `assertStatus(403)`

```php
// ✅ GOOD
it('returns all items', function () {
    $response = $this->postJson('/api/docs', []);
    $response->assertSuccessful();
});

// ❌ BAD
it('returns all items', function () {
    $response = $this->postJson('/api/docs', []);
    $response->assertStatus(200);
});
```

### Mocking

**Import Pest Functions**
- ✅ Use `use function Pest\Laravel\mock;` before using `mock()`
- ✅ Or use `$this->mock()` if existing tests do

```php
use function Pest\Laravel\mock;

it('mocks the service', function () {
    $mock = mock(PaymentService::class);
    $mock->shouldReceive('process')->andReturn(true);
});
```

### Datasets

**Simplify Repeated Data**
- ✅ Use datasets for tests with duplicated data
- ✅ Especially useful for validation rule testing

```php
it('has emails', function (string $email) {
    expect($email)->not->toBeEmpty();
})->with([
    'james' => 'james@laravel.com',
    'taylor' => 'taylor@laravel.com',
]);
```

---

## Pest 4 Advanced Features

### New Capabilities

**Pest v4 Features**
- ✅ Browser testing
- ✅ Smoke testing
- ✅ Visual regression testing
- ✅ Test sharding
- ✅ Faster type coverage

### Browser Testing

**Location**
- ✅ Browser tests live in `tests/Browser/`

**Laravel Integration**
- ✅ Can use `Event::fake()` in browser tests
- ✅ Can use `assertAuthenticated()` in browser tests
- ✅ Can use model factories in browser tests
- ✅ Can use `RefreshDatabase` when needed

**Browser Interactions**
- ✅ Click, type, scroll, select, submit
- ✅ Drag-and-drop
- ✅ Touch gestures
- ✅ Multi-browser testing (Chrome, Firefox, Safari)
- ✅ Device/viewport testing (iPhone, tablets, custom breakpoints)
- ✅ Light/dark mode switching
- ✅ Screenshots and debugging pauses

**Example:**
```php
it('may reset the password', function () {
    Notification::fake();

    $this->actingAs(User::factory()->create());

    $page = visit('/sign-in');

    $page->assertSee('Sign In')
        ->assertNoJavascriptErrors()
        ->click('Forgot Password?')
        ->fill('email', 'nuno@laravel.com')
        ->click('Send Reset Link')
        ->assertSee('We have emailed your password reset link!');

    Notification::assertSent(ResetPassword::class);
});
```

### Smoke Testing

**Multiple Pages at Once**
```php
$pages = visit(['/', '/about', '/contact']);

$pages->assertNoJavascriptErrors()
      ->assertNoConsoleLogs();
```

---

## Frontend with Tailwind CSS

### Core Principles

**Use Tailwind Classes**
- ✅ Use Tailwind CSS classes for all styling
- ✅ Check existing conventions before writing new styles
- ✅ Extract repeated patterns into components

**Component Organization**
- ✅ Remove redundant classes
- ✅ Add classes to parent or child carefully
- ✅ Group elements logically
- ✅ Think through class placement, order, and priority

### Spacing

**Use Gap, Not Margin**
- ✅ Use `gap` utilities for spacing in flex/grid
- ❌ Don't use margins

```html
<!-- ✅ GOOD -->
<div class="flex gap-8">
    <div>Superior</div>
    <div>Michigan</div>
    <div>Erie</div>
</div>

<!-- ❌ BAD -->
<div class="flex">
    <div class="mr-8">Superior</div>
    <div class="mr-8">Michigan</div>
    <div>Erie</div>
</div>
```

### Dark Mode

**Consistency**
- ✅ If existing pages support dark mode, new pages **must** support it
- ✅ Use `dark:` prefix for dark mode classes

```html
<div class="bg-white dark:bg-gray-900 text-black dark:text-white">
    Content
</div>
```

### Tailwind 4 Specific

**Modern Import**
- ✅ Use `@import "tailwindcss";`
- ❌ **DON'T** use old `@tailwind` directives

```css
/* ✅ GOOD (Tailwind v4) */
@import "tailwindcss";

/* ❌ BAD (Tailwind v3) */
@tailwind base;
@tailwind components;
@tailwind utilities;
```

**Replaced Utilities**
- ❌ Don't use deprecated utilities
- ✅ Use replacements

| ❌ Deprecated | ✅ Replacement |
|---------------|----------------|
| `bg-opacity-*` | `bg-black/*` |
| `text-opacity-*` | `text-black/*` |
| `flex-shrink-*` | `shrink-*` |
| `flex-grow-*` | `grow-*` |
| `overflow-ellipsis` | `text-ellipsis` |

**Core Plugins**
- ❌ `corePlugins` is **NOT** supported in Tailwind v4

---

## Code Quality Tools

### Laravel Pint

**Auto-Formatting**
- ✅ **MUST** run `vendor/bin/pint --dirty` before finalizing changes
- ❌ **DON'T** run `vendor/bin/pint --test`
- ✅ Just run `vendor/bin/pint` to fix formatting

### Composer Scripts

**Development**
- `composer dev` - Starts server, queue, logs, Vite dev server

**Code Quality**
- `composer lint` - Runs Rector, Pint, Prettier
- `composer test:lint` - Dry-run for CI/CD

**Testing**
- `composer test:type-coverage` - Ensures 100% type coverage
- `composer test:types` - Runs PHPStan level 9
- `composer test:unit` - Runs Pest with 100% coverage requirement
- `composer test` - Complete test suite

**Maintenance**
- `composer update:requirements` - Updates all dependencies

---

## Laravel Boost MCP

### Artisan Commands

**Check Available Parameters**
- ✅ Use `list-artisan-commands` tool before calling Artisan
- ✅ Double-check available parameters

### URLs

**Absolute URLs**
- ✅ Use `get-absolute-url` tool for project URLs
- ✅ Ensures correct scheme, domain/IP, and port

### Debugging

**Tinker Tool**
- ✅ Use `tinker` tool for executing PHP to debug
- ✅ Use `tinker` to query Eloquent models directly

**Database Query Tool**
- ✅ Use `database-query` tool when only reading from database
- ✅ Read-only queries preferred over tinker

### Browser Logs

**Frontend Debugging**
- ✅ Use `browser-logs` tool to read browser logs, errors, exceptions
- ⚠️ Only recent browser logs are useful (ignore old logs)

### Documentation Search

**Critical: Use search-docs First**
- ✅ **MUST** use `search-docs` tool before other approaches
- ✅ Returns version-specific docs for YOUR packages
- ✅ Perfect for Laravel, Inertia, Livewire, Filament, Tailwind, Pest, Nova
- ✅ Search docs **BEFORE** making code changes

**Search Strategy**
- ✅ Use multiple, broad, simple, topic-based queries
- ✅ Example: `['rate limiting', 'routing rate limiting', 'routing']`
- ❌ Don't add package names (automatically included)
- ❌ Don't use: `filament 4 test resource table`
- ✅ Use: `test resource table`

**Search Syntax**
1. **Simple Word Search** - `authentication` (finds 'authenticate', 'auth')
2. **Multiple Words (AND)** - `rate limit` (finds both "rate" AND "limit")
3. **Quoted Phrases** - `"infinite scroll"` (exact phrase, adjacent words)
4. **Mixed Queries** - `middleware "rate limit"` (middleware AND exact phrase)
5. **Multiple Queries** - `["authentication", "middleware"]` (ANY of these)

---

## Custom Project Rules

During the setup wizard, you can add **custom rules** specific to your project.

### Absolute Rules

Rules that must **NEVER** be broken:

**Example:**
- "NEVER use jQuery"
- "NEVER skip tests"
- "NEVER use DB:: facade, always use Eloquent"
- "NEVER commit directly to main branch"

### Forbidden Practices

Practices that are **NOT ALLOWED** in the project:

**Example:**
- "NEVER commit .env files"
- "NEVER hardcode API keys"
- "NEVER use var_dump() or dd() in production code"
- "NEVER create controllers with more than 7 methods"

### How They Work

**Enforcement**
- ✅ Claude Code will refuse to violate absolute rules
- ✅ Will warn you if you ask for forbidden practices
- ✅ Will suggest alternatives that comply with rules

**Example Interaction:**
```
You: "Use DB::table('users')->get() to fetch all users"

Claude Code:
⚠️ Validation Failed:
Your project rules state: "NEVER use DB:: facade, always use Eloquent"

I'll use User::query()->get() instead, which follows your rule.

Would you like me to proceed with the Eloquent approach?
```

---

## Rule Priority

When rules conflict, this is the priority order:

1. **Custom Project Rules** (highest priority)
2. **Laravel 12 Specific Rules**
3. **Laravel Boost MCP Guidelines**
4. **Framework-Specific Rules** (Pest, Tailwind, etc.)
5. **PHP Standards**
6. **Foundation Rules** (lowest priority)

**Example:**
- If your custom rule says "Use repositories", Claude will use repositories
- Even though the default Laravel pattern is Eloquent in controllers
- Your custom rules always win

---

## Validating Rules

### Automated Validation

The setup includes **validators** that automatically check:

1. **Type Safety** - `type-safety-check.sh`
   - Enforces 100% type coverage
   - Checks all methods have return types
   - Validates parameter types

2. **Test Coverage** - `test-coverage-check.sh`
   - Ensures minimum coverage thresholds
   - Validates tests exist for new code

3. **Clean Code** - `clean-code-check.sh`
   - Prevents code smells
   - Blocks anti-patterns
   - Enforces architectural rules

4. **Inline Styles** - `inline-style-check.sh`
   - Prevents inline CSS in components
   - Enforces Tailwind usage

### Manual Validation

**Before Finalizing Code**
```bash
# Run formatter
vendor/bin/pint

# Run tests
composer test

# Check types
composer test:types

# Check coverage
composer test:type-coverage
```

---

## Updating Rules

### During Development

You can ask Claude Code to:
- Add new rules
- Modify existing rules
- Remove outdated rules
- Clarify ambiguous rules

**Example:**
```
You: "Add a new rule: Never use inline styles in Vue components"

Claude Code:
✓ Added to .claude/rules.md under "Forbidden Practices"
✓ Created validator: inline-style-check.sh
✓ Rule is now enforced

Would you like me to scan existing components for violations?
```

### Re-running Setup

To completely reconfigure:
```bash
/setup-project
```

Then choose:
- Option 2: Update configuration (keeps as defaults)
- Option 3: Start fresh (delete and recreate)

---

## Summary

### Essential Rules to Remember

1. ✅ **ALWAYS** use version-specific documentation (`search-docs`)
2. ✅ **ALWAYS** create tests for all code
3. ✅ **ALWAYS** use FormRequests for validation
4. ✅ **ALWAYS** run Pint before finalizing
5. ❌ **NEVER** use `DB::` facade (use Eloquent)
6. ❌ **NEVER** skip return type declarations
7. ❌ **NEVER** remove tests without approval
8. ❌ **NEVER** create new folders without approval

### Quick Reference

- **Laravel way**: Artisan commands, Eloquent, FormRequests
- **PHP way**: Type hints, property promotion, curly braces
- **Testing way**: Pest syntax, specific assertions, datasets
- **Styling way**: Tailwind v4, gap not margin, dark mode support
- **Quality way**: Pint before commit, tests before merge

---

**Need help with a specific rule?**

Ask Claude Code: "Explain the rule about [topic]"
