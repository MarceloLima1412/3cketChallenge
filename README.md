# 3cketChallenge

## Getting started

### What to  install

- Git
- Docker
- Docker-compose

### Clone repository

```
git clone <url> <folder>
cd <folder>
```

### Docker

```
docker-compose build
docker-compose up -d
```

### Install dependencies and run migrations
```
make composer-install
cp laravel/.env.example laravel/.env

```
Add this lines to .env file: 
```
DB_CONNECTION=mysql
DB_HOST=3cket_db
DB_PORT=3306
DB_DATABASE=laravel
DB_ROOT_PASSWORD=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret

make migrate
make give-permissions
make key-generate
```

### Access application

- http://localhost:8080/
- Register and log in to view the gallery
