# aisle
This website is intended to demonstrate API Authentication using Laravel Passport as described in 
[this post](https://medium.com/@asjamsuri/api-authentication-dengan-menggunakan-laravel-passport-d2d4c12828a6)

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites
You need to install composer, XAMPP/WAMP/LAMP/Apache Server if you want to run it locally, and Postman (or any preferrable rest client) to test the API.

## Installing the dependencies
```
composer install
```

## Update database configuration in `.env`
```
DB_DATABASE={database_name}
DB_USERNAME={username}
DB_PASSWORD={password}
```

## Running the database migration
```
php artisan migrate
```

## Passport Configuration
#### 1. Create clients
```
php artisan passport:install
```
#### 2. Generate Keys
```
php artisan passport:keys
```

## Running the application
```
php artisan serve
```

## Dependencies
* [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
* [Laravel Passport](https://laravel.com/docs/passport) - A full OAuth2 server implementation for your Laravel application