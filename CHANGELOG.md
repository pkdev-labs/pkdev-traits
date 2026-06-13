# Changelog

All notable changes to this project are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-06-12

### Added
- `StringTrait` — `slugify`, `truncate`, `limitWords`, `mask`, `toCamelCase`,
  `toSnakeCase`, `toTitleCase`, `startsWith`, `endsWith`, `contains`.
- `ArrayTrait` — dot-notation `get`/`has`/`set`, `pluck`, `first`, `last`,
  `flatten`, `only`, `except`, `groupBy`.
- `NumberTrait` — `formatCurrency`, `percentage`, `ordinal`, `clamp`,
  `humanReadableBytes`, `abbreviate`.
- `HashTrait` — `hashPassword`, `verifyPassword`, `hmac`.
- `UuidTrait` — `uuid4` (RFC-4122 v4), `isUuid`.
- `JsonTrait` — `encode`, `decode` (both throw `JsonException` on failure),
  `isValidJson`.
- `EncryptionTrait` (introduced in 1.1.x) — AES-256-CBC encrypt/decrypt with
  session-stored keys.

### Changed
- **BREAKING:** minimum PHP raised from `^8.1` to `^8.3`.
- Upgraded the test toolchain to PHPUnit 13, resolving
  [CVE-2026-41570](https://github.com/advisories/GHSA-qrr6-mg7r-m243)
  (argument injection via newline in PHP INI values). No patched release exists
  on the 10.x/11.x lines, so a major bump was required.
- CI now pins PHP via `shivammathur/setup-php` and runs a matrix across PHP 8.4
  and 8.5.
- Version is now derived from git tags rather than a hardcoded `composer.json`
  field.

### Fixed
- `ValidationTrait::validateMaxLength()` / `validateMinLength()` no longer pass
  `null` to `strlen()` (deprecated on PHP 8.4+); `null` is treated as length 0,
  preserving prior behavior.
- Removed a dead constructor override in `DateTraitTest` that broke under
  PHPUnit 13's now-`final` `TestCase::__construct()`.

[2.0.0]: https://github.com/pkdev-labs/pkdev-traits/releases/tag/v2.0.0
