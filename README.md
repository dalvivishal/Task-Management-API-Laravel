# Task-Management-System-Laravel
# @author Vishal Dalvi

Task Management API

## Getting Started

Clone the project repository by running the command below if you use SSH

```bash
git clone git@github.com:dalvivishal/Task-Management-API-Laravel.git
```

If you use https, use this instead

```bash
git clone https://github.com/dalvivishal/Task-Management-API-Laravel.git
```

After cloning, run:

```bash
cd task_management
```

Install all dependencies using composer:

```bash
composer install
```

Duplicate `.env.example` and rename it `.env`

Then run:

### Prerequisites

Be sure to fill in your database details in your `.env` file before running the migrations:

This will create all necessary tables for our application.
```bash
php artisan migrate
```

This will insert fake data in tables
```bash
php artisan db:seed
```

And finally, start the application:

```bash
php artisan serve
```

I have also added postman collection it must be run on localhost

[Postman Collection] -> `Task Management API.postman_collection.json`

``` Import this file in postman and run the collection`

## Built With

* [Laravel](https://laravel.com) - The PHP Framework For Web Artisans
