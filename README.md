# Development Setup

## Prerequisites

* Working [`docker`](https://www.docker.com/) installation
* [`OpenLDAP`](https://www.openldap.org/) installed

Install Laravel Passport:

```bash
composer require laravel/passport
```

---

## Peripheral Services

The **Verwaltungssystem** requires access to a MySQL database and an LDAP instance. For development, you can start them via Docker:

```bash
# Start containers
docker compose -f docker-compose-dev.yaml up -d

# Stop containers
docker compose -f docker-compose-dev.yaml down
```

---

## Generate a Custom Encryption Key

Some database data is encrypted to ensure privacy. Generate a new encryption key locally:

```bash
php artisan key:custom
php artisan key:generate

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

> **Warning:** Only do this in a production environment with extreme caution.

---

## Initialize Database and LDAP

Before logging in, the database and LDAP must be prepared. This step may need to be repeated when peripheral services are restarted.

```bash
# Import LDAP data
ldapadd -D cn=admin,dc=newman-net,dc=de -w ldap_passwd -f aktiveBewohner.ldif
ldapadd -D cn=admin,dc=newman-net,dc=de -w ldap_passwd -f alleBewohner.ldif

# Reset and initialize database
php artisan db:reset
```

---

## Starting Your Local Instance

Run the following commands in **two separate terminal sessions**:

```bash
php artisan serve
npm run dev
```

---

## Seed Database (Optional)

Generate artificial data for development:

```bash
php artisan db:seed --class=FakingDatabaseSeeder
```

---

# Important Files

| Path                   | Description                            |
| ---------------------- | -------------------------------------- |
| `/routes/web`          | HTTP endpoints for web requests        |
| `/routes/api`          | HTTP endpoints for API requests        |
| `/app/Console`         | Console commands (can be scheduled)    |
| `/app/Http`            | Controllers, Middleware, Requests      |
| `/app/Ldap`            | LDAP contact synchronization           |
| `/app/Models`          | Eloquent model classes                 |
| `/app/Policies`        | Model access policies                  |
| `/app/Util`            | Utility classes (e.g., PDF generation) |
| `/database/migrations` | Database table definitions             |
| `/database/seeders`    | Seeders for test or imported data      |
| `/lang`                | Translation files                      |
| `resources/js`         | Frontend Vue.js code                   |
| `resources/js/Pages`   | Pages rendered via Inertia.js          |

---

# Important Commands

| Command         | Description                                                                                   |
| --------------- | --------------------------------------------------------------------------------------------- |
| `key:custom`    | Create a custom database encryption key. Re-encrypts all data if a previous key exists.       |
| `db:reset`      | Reset the database and LDAP.                                                                  |
| `ldap:active`   | Updates active inhabitants in LDAP (scheduled daily).                                         |
| `radius:active` | Disables network accounts of recently moved-out inhabitants (scheduled daily).                |
| `radius:users`  | Re-generates the `users` file and restarts the authentication server after important changes. |

---

# Laravel

## About Laravel

Laravel is a web framework with expressive syntax that simplifies development tasks, including:

* Fast and simple [routing](https://laravel.com/docs/routing)
* Dependency injection container
* Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage
* [ORM (Eloquent)](https://laravel.com/docs/eloquent) for database management
* Database agnostic [migrations](https://laravel.com/docs/migrations)
* Background job processing ([queues](https://laravel.com/docs/queues))
* Real-time event broadcasting ([broadcasting](https://laravel.com/docs/broadcasting))

## Learning Laravel

Comprehensive [documentation](https://laravel.com/docs) and video tutorials make it easy to get started.

---

# Updating Laravel

When updating Laravel:

1. Check the [Laravel upgrade guide](https://laravel.com/docs/11.x/upgrade) for the target version.
2. Update the packages in `composer.json` to match the upgrade requirements.
3. Follow the guide to complete the update.

