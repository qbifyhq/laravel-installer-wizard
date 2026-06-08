# 🚀 Laravel Installer Wizard

<p align="center">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTSRqymTtnKP-LUAIWH2H81D0-Jfa2u8CifA&s" alt="Laravel Installer Wizard" width="320">
</p>

<p align="center">
  <a href="https://github.com/qbifyhq/laravel-installer-wizard/releases">
    <img src="https://img.shields.io/github/v/release/qbifyhq/laravel-installer-wizard?include_prereleases&style=for-the-badge" alt="Latest Release">
  </a>

  <a href="LICENSE">
    <img src="https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge" alt="MIT License">
  </a>

  <a href="#">
    <img src="https://img.shields.io/badge/Laravel-13.x-FF2D20.svg?style=for-the-badge&logo=laravel" alt="Laravel 13">
  </a>

  <a href="#">
    <img src="https://img.shields.io/badge/Livewire-4.x-4E56A6.svg?style=for-the-badge" alt="Livewire 4">
  </a>

  <a href="#">
    <img src="https://img.shields.io/badge/PHP-8.4+-777BB4.svg?style=for-the-badge&logo=php" alt="PHP 8.4">
  </a>
</p>

Laravel Installer Wizard is an open-source installation system for Laravel applications.

Built with Laravel 13 and Livewire 4, it provides a complete installation experience including license verification, environment configuration, requirement checking, database setup, connection testing, and one-click migration execution.

Instead of asking users to manually edit environment files or run terminal commands, Laravel Installer Wizard guides them through a professional installation workflow similar to commercial SaaS products.

---

## Why Laravel Installer Wizard Exists

Many Laravel applications require users to:

* Edit `.env` files manually
* Configure database credentials
* Verify system requirements
* Run migrations from the command line
* Activate licenses

These steps can be confusing for non-technical users.

Laravel Installer Wizard simplifies the entire process into a clean, guided setup experience.

---

## Features

### Installation Wizard

* Modern step-by-step installation flow
* Responsive user interface
* Livewire-powered experience

### Environment Configuration

* Automatic `.env` generation
* Environment variable management
* Safe configuration updates

### Database Support

* MySQL
* MariaDB
* PostgreSQL
* SQLite
* SQL Server

### Database Validation

* Live connection testing
* Credential verification before installation
* Database import workflow

### License Verification

* External API license validation
* Purchase code verification
* Domain activation support
* Fully customizable implementation

### Installation Protection

* Installation lock system
* Prevents accidental reinstallation
* Secure deployment workflow

### Developer Friendly

* PSR-12 compliant
* Laravel 13 ready
* Livewire 4 ready
* Easy customization
* Modular architecture

---

## Installation Flow

1. Welcome Screen
2. License Verification
3. Requirements Check
4. Database Configuration
5. Database Connection Validation
6. Migration Import
7. Installation Complete

---

## Requirements

* PHP 8.4+
* Laravel 13.x
* Livewire 4.x

---

## Screenshots

### Welcome

<img src="https://raw.githubusercontent.com/qbifyhq/laravel-installer-wizard/refs/heads/main/Screenshot/1.png">

### License Verification

<img src="https://raw.githubusercontent.com/qbifyhq/laravel-installer-wizard/refs/heads/main/Screenshot/2.png">

### Requirements Check

<img src="https://raw.githubusercontent.com/qbifyhq/laravel-installer-wizard/refs/heads/main/Screenshot/3.png">

### Database Setup

<img src="https://raw.githubusercontent.com/qbifyhq/laravel-installer-wizard/refs/heads/main/Screenshot/4.png">

### Database Import

### Installation Complete

---


## Configuration Checklist

Before running the installer, review the following configuration options to ensure the installer matches your application's requirements.

### Configure Requirements

Open:

```php
config/installer-info.php
```

Adjust the minimum and recommended PHP versions according to your project:

```php
'minPhpVersion' => '8.4.0',
'recPhpVersion' => '8.5.0',
```

### Configure Required PHP Extensions

Update the extensions list to match your application's dependencies:

```php
'requirements' => [
    'ctype',
    'curl',
    'dom',
    'fileinfo',
    'mbstring',
    'openssl',
    'pdo',
    'xml',
    'bcmath',
    'json',
    'intl',
    'gd',
    'sodium',
],
```

Any missing extension will be displayed to the user during the Requirements Check step.

### Configure Support Information

Set your support email address:

```php
'support_email' => 'hello@example.com',
```

This information can be displayed throughout the installer to help users contact your support team.

### Configure License Verification

Set your license server endpoint:

```php
'license_server_url' => 'https://your-domain.com/license-api',
```

The installer will send license verification requests to this endpoint during the License Verification step.

### Customize Installation Steps

All installer screens are located in:

```text
resources/views/livewire/install/
```

You may customize:

* Branding
* Colors
* Layout
* Content
* Help text
* Form fields

to match your application.

### Customize Installer Layout

The main installer layout is located at:

```text
resources/views/layouts/install.blade.php
```

You can modify:

* Logo
* Typography
* Sidebar content
* Header
* Footer
* Theme styling

without affecting installer functionality.

### Configure Notifications

QbifyInstaller uses:

```text
devrabiul/laravel-toaster-magic
```

for success, warning, and error notifications.

You may replace it with any Laravel-compatible notification or toast package by updating the relevant Livewire components.

### Review Route URLs

By default, the installer is available at:

```text
/install
```

You may change the installation URL structure inside:

```php
routes/web.php
```

Example:

```php
Route::get('/setup', Welcome::class)->name('install.welcome');
```

### Review Installation Lock Logic

The installation status is determined by:

```text
storage/app/installed.json
```

You may modify the lock file location or implementation inside:

```php
app/Http/Middleware/CheckInstallation.php
```

if your application requires a custom installation verification workflow.

## License Server Integration

The installer can connect to any custom licensing API.

Example request:

```php
[
    'license_key' => 'XXXX-XXXX-XXXX',
    'domain' => 'example.com',
]
```

Example response:

```json
{
    "status": "valid",
    "message": "License verified successfully"
}
```

You have complete control over how licensing works.

---

## Contributing

Contributions are welcome.

Whether you want to improve the user interface, add support for additional databases, improve the installation workflow, or enhance documentation, your contributions are appreciated.

Please open an issue before submitting major changes.

---

## Roadmap

* Update Manager
* Auto Upgrade System
* Multi-Language Support
* Installation Themes
* Additional License Providers
* Docker Environment Detection

---

## Star History

<a href="https://www.star-history.com/?repos=qbifyhq%2Flaravel-installer-wizard&type=date&legend=top-left">
 <picture>
   <source media="(prefers-color-scheme: dark)" srcset="https://api.star-history.com/chart?repos=qbifyhq/laravel-installer-wizard&type=date&theme=dark&legend=top-left" />
   <source media="(prefers-color-scheme: light)" srcset="https://api.star-history.com/chart?repos=qbifyhq/laravel-installer-wizard&type=date&legend=top-left" />
   <img alt="Star History Chart" src="https://api.star-history.com/chart?repos=qbifyhq/laravel-installer-wizard&type=date&legend=top-left" />
 </picture>
</a>

---

## License

MIT License

You are free to use, modify, distribute, and integrate Laravel Installer Wizard into personal and commercial projects.

See the LICENSE file for complete details.

---

## Built for the Laravel Community

Laravel Installer Wizard is an open-source project focused on making Laravel deployments easier, faster, and more accessible for developers and end users.
