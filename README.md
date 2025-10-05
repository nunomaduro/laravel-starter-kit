<p align="center">
    <a href="https://youtu.be/VhzP0XWGTC4" target="_blank">
        <img src="/art/banner.png" alt="Overview Laravel Starter Kit" style="width:70%;">
    </a>
</p>

<p>
    <a href="https://github.com/nunomaduro/laravel-starter-kit/actions"><img src="https://github.com/nunomaduro/laravel-starter-kit/actions/workflows/tests.yml/badge.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/nunomaduro/laravel-starter-kit"><img src="https://img.shields.io/packagist/dt/nunomaduro/laravel-starter-kit" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/nunomaduro/laravel-starter-kit"><img src="https://img.shields.io/packagist/v/nunomaduro/laravel-starter-kit" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/nunomaduro/laravel-starter-kit"><img src="https://img.shields.io/packagist/l/nunomaduro/laravel-starter-kit" alt="License"></a>
</p>

**Laravel Starter Kit** is an ultra-strict, type-safe [Laravel](https://laravel.com) skeleton engineered for developers who refuse to compromise on code quality. This opinionated starter kit enforces rigorous development standards through meticulous tooling configuration and architectural decisions that prioritize type safety, immutability, and fail-fast principles.

## Why This Starter Kit?

Modern PHP has evolved into a mature, type-safe language, yet many Laravel projects still operate with loose conventions and optional typing. This starter kit changes that paradigm by enforcing:

- **100% Type Coverage**: Every method, property, and parameter is explicitly typed
- **Zero Tolerance for Code Smells**: Rector and PHPStan at maximum strictness catch issues before they become bugs
- **Immutable-First Architecture**: Data structures favor immutability to prevent unexpected mutations
- **Fail-Fast Philosophy**: Errors are caught at compile-time, not runtime
- **Automated Code Quality**: Pre-configured tools ensure consistent, pristine code across your entire team
- **Just Better Laravel Defaults**: Thanks to **[Essentials](https://github.com/nunomaduro/essentials)** / strict models, auto eager loading, immutable dates, and more...

This isn't just another Laravel boilerplate—it's a statement that PHP applications can and should be built with the same rigor as strongly-typed languages like Rust or TypeScript.

## Getting Started

> **Requires [PHP 8.4+](https://php.net/releases/)**.

Create your type-safe Laravel application using [Composer](https://getcomposer.org):

```bash
composer create-project nunomaduro/laravel-starter-kit --prefer-dist example-app
```

### Initial Setup

Navigate to your project and complete the setup:

```bash
cd example-app

# Install PHP dependencies with optimized autoloader
composer install

# Install and build frontend assets
npm install
npm run build

# Configure your environment
cp .env.example .env
php artisan key:generate

# Run database migrations
php artisan migrate

# Start the development server
composer dev
```

### Optional: Browser Testing Setup

If you plan to use Pest's browser testing capabilities:

```bash
npm install playwright
npx playwright install
```

### Verify Installation

Run the test suite to ensure everything is configured correctly:

```bash
composer test
```

You should see 100% test coverage and all quality checks passing.

## Available Tooling

### Development
- `composer dev` - Starts Laravel server, queue worker, log monitoring, and Vite dev server concurrently

### Code Quality
- `composer lint` - Runs Rector (refactoring), Pint (PHP formatting), and Prettier (JS/TS formatting)
- `composer test:lint` - Dry-run mode for CI/CD pipelines

### Testing
- `composer test:type-coverage` - Ensures 100% type coverage with Pest
- `composer test:types` - Runs PHPStan at level 9 (maximum strictness)
- `composer test:unit` - Runs Pest tests with 100% code coverage requirement
- `composer test` - Runs the complete test suite (type coverage, unit tests, linting, static analysis)

### Maintenance
- `composer update:requirements` - Updates all PHP and NPM dependencies to latest versions

## 🤖 Claude Code Super Wizard

This starter kit includes a powerful **Claude Code Super Wizard** setup system that transforms Claude Code into a project-specific AI assistant tailored to your exact needs.

### What It Does

The setup wizard intelligently configures Claude Code to:
- ✅ Understand your exact Laravel version and installed packages
- ✅ Follow your architectural patterns (Actions, Repositories, DDD, etc.)
- ✅ Enforce your team's coding standards automatically
- ✅ Generate code that matches your project structure
- ✅ Provide version-specific documentation and examples
- ✅ Prevent common mistakes through automated validators

### Quick Start

1. **Install Required MCPs** (Model Context Protocol servers):
```bash
npm install -g @modelcontextprotocol/cli
npx @modelcontextprotocol/create-server context7
npx @modelcontextprotocol/create-server sequential-thinking
npx @modelcontextprotocol/create-server laravel-boost
```

2. **Run the Setup Wizard**:
   - Open `.claude/commands/SETUP-PROJECT.md`
   - Copy the entire content
   - Paste it into Claude Code
   - Follow the interactive wizard

3. **Start Building**:
```bash
# Create a complete feature with tests
/new-feature [feature-name]

# Debug issues systematically
/fix-bug [description]

# Generate API endpoints
/new-api [endpoint]

# Run targeted tests
/quick-test [filter]
```

### Features Included

**📁 Configuration Files:**
- Project-specific guidelines and coding standards
- Laravel Boost curated rules for Laravel 12
- Custom rules tailored to your needs

**🤖 Specialized Agents:**
- Backend Architect (Laravel patterns, database design)
- Testing Champion (Pest tests, coverage optimization)
- Code Quality Enforcer (PHPStan, Pint, Rector)
- Performance Optimizer (query optimization, caching)
- Boilerplate Generator (CRUD, scaffolding)
- Documentation Master (PHPDoc, API docs)

**⚡ Custom Commands:**
- `/new-feature` - Scaffold complete features with tests
- `/new-action` - Create Action classes with validation
- `/new-api` - Generate API endpoints with resources
- `/fix-bug` - Systematic bug debugging
- `/optimize` - Performance analysis and fixes
- `/quick-test` - Run targeted tests
- `/document` - Generate comprehensive docs

**🛡️ Automated Validators:**
- Type safety enforcement (100% type coverage)
- Test coverage validation
- Clean code checks
- Inline style prevention

### Documentation

**Complete documentation available in the wiki:**

📚 **[Read the Full Documentation →](./wiki/claude-code/README.md)**

- [Quick Start Guide](./wiki/claude-code/QUICK-START.md) - Get setup in under 10 minutes
- [Rules & Guidelines](./wiki/claude-code/RULES.md) - All enforced rules explained
- [Real Project Examples](./wiki/claude-code/EXAMPLES.md) - See it in action

### Benefits

**Before Setup:**
- Generic Laravel advice
- Doesn't match your project structure
- Requires constant manual corrections
- Tests are an afterthought

**After Setup:**
- Project expert that knows YOUR architecture
- Code matches your structure perfectly
- Tests generated automatically
- Conventions followed automatically
- Proactive quality enforcement

### Time Savings

- **Feature Development:** 45 min → 10 min (35 min saved)
- **Bug Debugging:** 2 hours → 30 min (90 min saved)
- **Test Writing:** 1 hour → 15 min (45 min saved)

---

## License

**Laravel Starter Kit** was created by **[Nuno Maduro](https://x.com/enunomaduro)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
