# Laravel learn

## Environment

- OS: Windows 10 Pro - 21H2
- [Nodejs](https://nodejs.org/dist/v19.8.1/node-v19.8.1-x64.msi) - v18.15.0
- [Composer](https://getcomposer.org/Composer-Setup.exe) version 2.5.5 2023-03-21 11:50:05
- [Xampp](https://udomain.dl.sourceforge.net/project/xampp/XAMPP%20Windows/8.0.25/xampp-windows-x64-8.0.25-0-VS16-installer.exe) version 8.0.25
- PHP 8.0.25 (cli) (built: Oct 25 2022 10:49:29) ( ZTS Visual C++ 2019 x64 )
- Laravel Installer 4.5.0
- Mysql  Ver 15.1 Distrib 10.4.27-MariaDB, for Win64 (AMD64),


- [Docker image](https://hub.docker.com/r/hienanh/laravel-env)

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
    php artisan serve --port=8000
    php artisan serve --port=8000 --host=0.0.0.0
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

    - Generate JS, CSS, image for system

        ```bash
        npm run dev
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

    - Recompile blade template

        ```bash
        php artisan view:cache
        ```

## Database

1. `CREATE DATABASE` - create a new SQL database

    ```sql
    CREATE DATABASE contact_app;
    ```

1. `SHOW DATABASE` - list all exist database

    ```sql
    SHOW DATABASE;
    ```

1. `DESCRIBE` - show table's information

    ```sql
    DESCRIBE migrations
    ```

1. `ALTER DATABASE` - change the characteristics of a database

    ```sql
    ALTER DATABASE database_name [COLLATE collation_name]
    ```

1. `USE` - select a database to work with

    ```sql
    USE contact_app;
    ```

1. `CREATE TABLE` - create a new table in the database

    ```sql
    CREATE TABLE table_name (
        column_1 datatype,
        column_2 datatype,
        column_3 datatype
    );
    ```

1. `SHOW TABLES` - list all exist tables in database 

    ```sql
    SHOW TABLES;
    ```

1. `ALTER TABLE` - add, delete, or modify columns in an existing table.

    ```sql
    ALTER TABLE table_name ADD column_name datatype;
    ```

1. `DROP TABLE` - delete an existing table in a database

    ```sql
    DROP TABLE table_name;
    ```

1. `SELECT` - fetch data from a database

    ```sql
    SELECT column_name FROM table_name;
    ```

1. `UPDATE` - edit rows in a table

    ```sql
    UPDATE table_name SET some_column = some_value WHERE some_column = some_value;
    ```

1. `DELETE` - remove rows from a table

    ```sql
    DELETE FROM table_name WHERE some_column = some_value;
    ```

1. `INSERT INTO` - add a new row to a table

    ```sql
    INSERT INTO table_name (column_1, column_2, column_3) VALUES (value_1, ‘value_2’, value_3);
    ```

1. `CREATE INDEX` - create an index

    ```sql
    CREATE INDEX index_name ON table_name (column_name1, column_name2…);
    ```

1. `DROP INDEX` - delete an index

    ```sql
    ALTER TABLE table_name DROP INDEX index_name;
    ```

## Note

- `routes\web.php`: define routes.
- `resources\views`: V part in MVC pattern.
