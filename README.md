# Laravel learn

## Environment

- OS: Windows 10 Pro - 21H2
- Nodejs - v18.15.0
- Composer version 2.5.5 2023-03-21 11:50:05
- PHP 8.0.25 (cli) (built: Oct 25 2022 10:49:29) ( ZTS Visual C++ 2019 x64 )
- Laravel Installer 4.5.0

## Install laravel project

1. Create project

```bash
laravel new <project_name>
```

2. [Setup a Laravel project](https://devmarketer.io/learn/setup-laravel-project-cloned-github-com/)

- Install Composer Dependencies

    ```bash
    composer install
    ```

- Install NPM Dependencies

    ```bash
    npm install
    ```

- Create a copy of your .env file

    ```bash
    cp .env.example .env
    ```

- Generate an app encryption key

    ```bash
    php artisan key:generate
    ```

- In the .env file, add database information to allow Laravel to connect to the database

    In the .env file fill in the `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` options to match the credentials of the database you just created. This will allow us to run migrations and seed the database in the next step.

- Migrate the database

    ```bash
    php artisan migrate
    ```

- Seed the database

    ```bash
    php artisan db:seed
    ```

## Note

- `routes\web.php`: define routes.
- `resources\views`: V part in MVC pattern.
