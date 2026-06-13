<p align="center">
    <a href="https://www.pkdev.dev" target="_blank"><img src="https://pks3.nyc3.cdn.digitaloceanspaces.com/pkdev_logo_elephant_long.png" width="400" alt="PkDev Logo"></a>
</p>

<p align="center">

![Tests](https://github.com/pkdev-labs/pkdev-traits/actions/workflows/phpunit-tests.yml/badge.svg)
![Code Quality](https://github.com/pkdev-labs/pkdev-traits/actions/workflows/quality.yml/badge.svg)
[![codecov](https://codecov.io/gh/pkdev-labs/pkdev-traits/branch/master/graph/badge.svg)](https://codecov.io/gh/pkdev-labs/pkdev-traits)
[![Latest Stable Version](https://poser.pugx.org/pkdev/traits/v)](https://packagist.org/packages/pkdev/traits)
[![License](https://poser.pugx.org/pkdev/traits/license)](https://packagist.org/packages/pkdev/traits)

</p>

## About Project

**PkDev Traits** is an open-source collection of small, dependency-free PHP traits that centralize the reusable helpers used across PkDev projects — validation, sanitization, dates, strings, arrays, numbers, encryption, hashing, UUIDs, and JSON. Every method is `public static`, so you can either `use` a trait into a class or call it directly.

The library is built test-first: the suite runs at **100% code coverage**, is statically analyzed by **PHPStan at the maximum level**, and is checked against **PSR-12** on every push.

## Requirements

- **PHP 8.3+**
- `ext-openssl` (used by `EncryptionTrait`)

## Installation

```bash
composer require pkdev/traits
```

## Available Traits

All traits live under the `PkDev\Traits` namespace.

| Trait | Purpose | Methods |
|-------|---------|---------|
| `ValidationTrait` | Validate untrusted input | `validateRequired`, `validateEmail`, `validateNumeric`, `validateInteger`, `validateFloat`, `validateMaxLength`, `validateMinLength` |
| `SanitizeTrait` | Clean untrusted input | `sanitizeString`, `sanitizeEmail`, `sanitizeInteger`, `sanitizeFloat`, `sanitizeURL` |
| `StringTrait` | String manipulation | `slugify`, `truncate`, `limitWords`, `mask`, `toCamelCase`, `toSnakeCase`, `toTitleCase`, `startsWith`, `endsWith`, `contains` |
| `ArrayTrait` | Array access & shaping | `get`, `has`, `set` (dot-notation), `pluck`, `first`, `last`, `flatten`, `only`, `except`, `groupBy` |
| `NumberTrait` | Number formatting | `formatCurrency`, `percentage`, `ordinal`, `clamp`, `humanReadableBytes`, `abbreviate` |
| `DateTrait` | Date helpers | `formatDate`, `addDaysToDate`, `isFutureDate`, `isPastDate`, `getDaysDifference`, `areDatesEqual`, `isWeekend` |
| `EncryptionTrait` | AES-256 encryption | `getEncryptionKey`, `generateEncryptionKey`, `encryptData`, `decryptData` |
| `HashTrait` | Password & HMAC hashing | `hashPassword`, `verifyPassword`, `hmac` |
| `UuidTrait` | UUID generation & validation | `uuid4`, `isUuid` |
| `JsonTrait` | Safe JSON encode/decode | `encode`, `decode`, `isValidJson` |
| `HelperTrait` | Misc utilities | `generateRandomString` |

## Usage

```php
use PkDev\Traits\ValidationTrait;

class SignupForm
{
    use ValidationTrait;

    public function isValid(string $email): bool
    {
        return self::validateEmail($email);
    }
}
```

A taste of each trait:

```php
use PkDev\Traits\StringTrait;
use PkDev\Traits\ArrayTrait;
use PkDev\Traits\NumberTrait;
use PkDev\Traits\SanitizeTrait;
use PkDev\Traits\DateTrait;
use PkDev\Traits\UuidTrait;
use PkDev\Traits\JsonTrait;
use PkDev\Traits\HashTrait;

class Demo
{
    use StringTrait, ArrayTrait, NumberTrait, SanitizeTrait, DateTrait, UuidTrait, JsonTrait, HashTrait;

    public function examples(): void
    {
        // StringTrait
        self::slugify('Hello World!');            // "hello-world"
        self::mask('4111111111111111');           // "************1111"
        self::toSnakeCase('helloWorld');           // "hello_world"

        // ArrayTrait — dot notation
        $data = ['user' => ['profile' => ['name' => 'Phil']]];
        self::get($data, 'user.profile.name');     // "Phil"
        self::pluck([['id' => 1], ['id' => 2]], 'id'); // [1, 2]

        // NumberTrait
        self::formatCurrency(1234.5);              // "$1,234.50"
        self::ordinal(22);                          // "22nd"
        self::humanReadableBytes(1268777);          // "1.21 MB"

        // SanitizeTrait
        self::sanitizeEmail('  user@example.com '); // "user@example.com"

        // DateTrait
        self::addDaysToDate('2024-01-01', 5);       // "2024-01-06"
        self::isWeekend('2024-01-20');              // true

        // UuidTrait
        self::uuid4();                              // "b1e8...-4...-..."
        self::isUuid('not-a-uuid');                 // false

        // JsonTrait (throws JsonException on failure)
        self::encode(['ok' => true]);               // '{"ok":true}'
        self::isValidJson('{bad}');                 // false

        // HashTrait
        $hash = self::hashPassword('secret');
        self::verifyPassword('secret', $hash);      // true
    }
}
```

## Development

```bash
git clone https://github.com/pkdev-labs/pkdev-traits.git
cd pkdev-traits
composer install
```

Quality tooling:

```bash
composer test            # PHPUnit (100% coverage enforced in CI)
composer analyse         # PHPStan, level max
composer check           # test + analyse

# Coding standards run as a standalone PHAR (not a Composer dependency):
php php-cs-fixer.phar fix --dry-run --diff   # check
php php-cs-fixer.phar fix                      # apply
```

Coverage and PHP-CS-Fixer require a coverage driver (`pcov` recommended). PHP-CS-Fixer is intentionally run as a PHAR to keep the dependency tree clean.

## Releasing

Versions are derived from **git tags** (not a `composer.json` field). To cut a release, tag the merged commit on `master` and push the tag — Packagist updates automatically:

```bash
git tag v2.0.0
git push origin v2.0.0
```

## Contributing

Issues and pull requests are welcome. Please keep the suite green (`composer check`), maintain 100% coverage, and run PHP-CS-Fixer before opening a PR.

## License

Released under the [MIT License](LICENSE).

## Contact

Questions or just want to say hello? Reach out at pkdevop01@gmail.com.
