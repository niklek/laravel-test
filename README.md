# Laravel test

## Setup Mysql db
### Pull docker image and run a container
```
docker pull mysql:8.0.1
docker run --name mysql-local -e MYSQL_ROOT_PASSWORD={ROOT PASSWORD} -p 3306:3306 -d mysql:8.0.1
#docker ps -a
#docker exec -it mysql-local bash
```
### Setup PhpMyAdmin (optional)
```
docker pull phpmyadmin/phpmyadmin:latest
docker run --name phpmyadmin-local -d --link mysql-local:db -p 8081:80 phpmyadmin/phpmyadmin
http://localhost:8081/
```
### Update db credentials in `.env` file

## Seed database
Put sql files in `database/seeders/sql` and run
```
php artisan db:seed
```

## Usage
```
php artisan serve
```
### Get active users, filtered by country
* API queries and returns only active users
* Accepts GET param `country` which is two-letter country code, by default `AT`
* Loads relationships: user detail and country
```
GET http://localhost:8000/api/users
GET http://localhost:8000/api/users?country=at
GET http://localhost:8000/api/users?country=ru
```

### Update user detail
* API validates the payload
* Checks user if exists
* Checks user detail if exists
* Checks if user detail id belongs for the user
```
PUT http://localhost:8000/api/users/6/details/5
{
    "id": 5,
    "user_id": 6,
    "citizenship_country_id": 1,
    "first_name": "Max",
    "last_name": "Mustermann",
    "phone_number": "00436645555555"
}
```

### Delete user
* API check if user exists and if the user has detail
* API returns 409 HTTP Response code if the user has detail

To run tests:
```
vendor/bin/phpunit --filter test_user_is_deleted_when_user_detail_does_not_exist
vendor/bin/phpunit --filter test_user_is_not_deleted_when_user_detail_exist
```


