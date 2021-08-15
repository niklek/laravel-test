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
### Get active users, filtered by country
```
GET http://localhost:8000/api/users
GET http://localhost:8000/api/users?country=at
GET http://localhost:8000/api/users?country=ru
```

### Update user details
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


