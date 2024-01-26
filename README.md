<p align="center">
    <a href="https://www.pkdev.dev" target="_blank"><img src="https://pks3.nyc3.cdn.digitaloceanspaces.com/pkdev_logo_elephant_long.png" width="400" alt="Laravel Logo"></a>
</p>

<p align="center">

![CircleCI](https://github.com/pkdev-labs/pkdev-traits/actions/workflows/phpunit-tests.yml/badge.svg)

</p>

## About Project

### Project Overview

Welcome to PkDev Traits – an open-source initiative designed to streamline and centralize the management of traits used across various projects. In software development, reusability is a key factor for efficiency, and this project aims to provide a centralized repository for managing and accessing traits efficiently.

### Technologies Used

- **Backend:** PHP

### Installation & Usage

To explore and run this project locally:

1. Use the repository:
   ```bash
   composer require pkdev/traits
    ```
2. Use the repository:
   ```bash
   use PkDev\Traits\ValidationTrait;
   
   class foo {
      use ValidationTrait;
   
      $isValidEmail = self::validateEmail('invalid-email'); // returns false
   }
    ```

### Key Features

- **Trait Storage:** Store and manage all your project traits in one central location, making it easy to organize and access them whenever needed.
- **Test Suite with 100% Code Coverage:** Our commitment to quality is reflected in our comprehensive test suite that achieves 100% code coverage. This ensures the reliability and stability of the traits stored in this project.

### Why Traits?

Traits are fundamental building blocks in software development. They encapsulate reusable pieces of code that can be easily integrated into various projects, promoting code consistency and reducing redundancy. This project serves as a dedicated space to manage and share these valuable traits.

### Test-Driven Development

Ensuring the reliability of our codebase is a top priority. Our extensive test suite covers every aspect of the project, achieving 100% code coverage. This commitment to test-driven development (TDD) guarantees that the traits stored here are robust, dependable, and ready for seamless integration into your projects.

### Contact

For any inquiries or just to say hello, feel free to reach out at pkdevop01@gmail.com.
