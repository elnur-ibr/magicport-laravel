# Installation

Configure laravel .env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=magic_port_laravel
DB_USERNAME=root
DB_PASSWORD=
```

 - run `composer install`
 - run `php artisan migrate --seed`

You will have test user with following credentials.
 - test@example.com
 - password

# Test
To run tests run `php artisan test`
