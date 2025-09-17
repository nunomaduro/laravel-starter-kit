# Laravel Starter Kit

<p>
    <a href="https://github.com/nunomaduro/laravel-starter-kit/actions"><img src="https://github.com/nunomaduro/laravel-starter-kit/actions/workflows/tests.yml/badge.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/nunomaduro/laravel-starter-kit"><img src="https://img.shields.io/packagist/dt/nunomaduro/laravel-starter-kit" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/nunomaduro/laravel-starter-kit"><img src="https://img.shields.io/packagist/v/nunomaduro/laravel-starter-kit" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/nunomaduro/laravel-starter-kit"><img src="https://img.shields.io/packagist/l/nunomaduro/laravel-starter-kit" alt="License"></a>
</p>

**Laravel Starter Kit** is my strict [Laravel](https://laravel.com) skeleton - for those who demand meticulous precision in their projects.

Tools like **PHPStan**, **Pest**, **Rector**, **Pint**, and **Prettier** are pre-configured to be as strict as possible. E.g: 100% type and code coverage, PHPStan level max, Rector with max privatization, and more...

> **Requires [PHP 8.4+](https://php.net/releases/)**.

## Create Project

⚡️ Create your project using [Composer](https://getcomposer.org):

```bash
composer create-project nunomaduro/laravel-starter-kit --prefer-dist example-app

cd example-app

composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate

php artisan serve # serve the application...
```

## Features

🥃 Comes with Laravel [Essentials](https://github.com/nunomaduro/essentials), changes defaults in Laravel for more strict usage:
- Strict Models
- Auto Eager Loading
- Immutable Dates
- Force HTTPS
- Safe Console
- Asset Prefetching
- and more...

🧹 Keep a modern codebase with **Pint**, **Rector**, and **Prettier**:

> Every single rule in these tools is customized so they are most strict as possible.

```bash
composer lint
composer test:lint # on ci...
```

🧨 Check type coverage with **Pest**:
```bash
composer test:type-coverage # 100% type coverage...
```

⚗️ Run static analysis using **PHPStan**:
```bash
composer test:types # level max by default
```

✅ Run unit tests using **PEST**
```bash
composer test:unit # 100% test coverage...
```

🚀 Run the entire test suite:
```bash
composer test # the entire test suite...
```

⚙️ Better defaults for testing, including:
- Fake sleeps
- Stray http requests
- Browser testing
- and more...

💭 Different application structure with:
- `app/Actions` - for application actions
- `app/Enums` - for enumerations
- and more...

🤖 Agent coding style rules with **Laravel Boost**, with support for:
- PHPStorm Junie
- Claude AI
- and more...

## License

**Laravel Starter Kit** was created by **[Nuno Maduro](https://x.com/enunomaduro)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
