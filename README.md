# ADMIN

## require

- php
- composer

## install

- git clone git@github.com:huoding-fullstack/admin.git
- cd admin
- composer update
- ... modify database config in .env file ...
- php artisan migrate
- php artisan db:seed
- ... email: test@test.test / password: secret ...