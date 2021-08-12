# Laravel test

## Installation
```
mkdir laravel-test
cd laravel-test
composer create-project laravel/laravel .
```

## Setup Mysql db
Pull docker image and run a container
```
docker pull mysql:8.0.1
docker run --name mysql-local -e MYSQL_ROOT_PASSWORD={ROOT PASSWORD} -p 3306:3306 -d mysql:8.0.1
#docker ps -a
#docker exec -it mysql-local bash
```
Optionally setup PhpMyAdmin
```
docker pull phpmyadmin/phpmyadmin:latest
docker run --name phpmyadmin-local -d --link mysql-local:db -p 8081:80 phpmyadmin/phpmyadmin
http://localhost:8081/
```
Update db credentials in `.env` file

## Seed database
```
#php artisan make:seeder UsersSeeder
php artisan db:seed
```

## Usage
Get active users, filtered by country
http://localhost:8000/api/user
http://localhost:8000/api/user?country=at
http://localhost:8000/api/user?country=ru

