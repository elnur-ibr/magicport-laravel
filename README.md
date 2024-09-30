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
 - run `php artisan key:generate`
 - run `php artisan migrate --seed`

You will have test user with following credentials.
 - test@example.com
 - password

# Test
To run tests run `php artisan test`

# Notes
Completed
- Wrote tests
- Using Laravel PINT for code styling. 
- Implemented github actions for code styling.
- Used policies so implementing permission would be much easier.
- Implemented Service Pattern for business logic
- Implemented Factory Pattern


There couple thing that I would like to finish but my 5 days finished.
 - Wish to have time to dockerize whole thing
 - Wish to have time to implement permission system
 - Wish to have time to implement web socket
 - Wish to have time to run test automatically on github
 - Wish to have time to use phpstan

# Frontend

Just initialized react project. Could you start working on it during this 5 days. 




