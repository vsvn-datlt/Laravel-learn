# Laravel learn

## Environment

- OS: Windows 10 Pro - 21H2
- [Nodejs](https://nodejs.org/dist/v19.8.1/node-v19.8.1-x64.msi) - v18.15.0
- [Composer](https://getcomposer.org/Composer-Setup.exe) version 2.5.5 2023-03-21 11:50:05
- [Xampp](https://udomain.dl.sourceforge.net/project/xampp/XAMPP%20Windows/8.0.25/xampp-windows-x64-8.0.25-0-VS16-installer.exe) version 8.0.25
- PHP 8.0.25 (cli) (built: Oct 25 2022 10:49:29) ( ZTS Visual C++ 2019 x64 )
- Laravel Installer 4.5.0

## Install laravel project

1. Download Laravel Installer using Composer

    ```bash
    composer global require laravel/installer 
    ```


1. Create project

    ```bash
    composer create-project --prefer-dist laravel/laravel <project_name>
    # or
    cd <project_dir>
    laravel new <project_name>
    ```

1. Once u're in Laravel proj, fire up the Laravel Dev Server to make app run by:

    ```bash
    php artisan serve 
    php artisan serve --port=8080
    php artisan serve --port=8080 --host=0.0.0.0
    ```

1. Laravel project structure

    - `app` dir: place the business logic of app, Laravel follow `MVC` pattern -> M, and C part are placed in this dir.

    - `config` dir: put the configuration of app.

    - `database` dir: some files working with DB, e.g: defining table schema, defining fake data.

    - `lang` dir: language files for inernationalization.

    - `public` dir: stores files that can be accessed publicly, you can put you images, `CSS` and `JS` files inside.

    - `resources` dir: contains views or files used to build app interface. -> V part of `MVC` is stores in views folder. this dir cũng chứa code JS, CSS đã compiled mà KHÔNG truy cập trực tiếp từ browser

    - `roots` dir: contains all the root definition for app

    - `storage` dir: contains logs, compile blade templates, file based session, file caches, and other file gen by framwork.

    - `test` dir: contains files for automated test.

    - `vendor` dir: all dependencies installed by the composer.

    - `.env` file: contains configs for env

1. Tinker

    ```bash
    php artisan tinker
    ```

1. List all of the roots that are defined by app

    ```bash
    php artisan route:list
    php artisan route:list --except-vendor
    php artisan route:list --only-vendor
    php artisan route:list --path=contacts
    php artisan route:list --path=contacts -
    ```

1. [Setup a Laravel project](https://devmarketer.io/learn/setup-laravel-project-cloned-github-com/)

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
