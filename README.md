<p>
    <a href="https://github.com/laravolt/laravel-starter-kit/actions"><img src="https://github.com/laravolt/laravel-starter-kit/actions/workflows/tests.yml/badge.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/laravolt/laravel-starter-kit"><img src="https://img.shields.io/packagist/dt/laravolt/laravel-starter-kit" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/laravolt/laravel-starter-kit"><img src="https://img.shields.io/packagist/v/laravolt/laravel-starter-kit" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/laravolt/laravel-starter-kit"><img src="https://img.shields.io/packagist/l/laravolt/laravel-starter-kit" alt="License"></a>
</p>

# Laravolt Starter Kit

Official Laravel starter kit with strict type-safety and code quality tools for [Laravolt](https://github.com/laravolt/laravolt) in Agentic era.

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
composer create-project laravolt/laravel-starter-kit --prefer-dist example-app
```

### Initial Setup

Navigate to your project and complete the setup:

```bash
cd example-app

# Setup project
composer setup

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

---

Based on the original work by **[Nuno Maduro](https://x.com/enunomaduro)**.
