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

Install dependencies and run migrations
```
make composer-install
make migrate
```

### Access application

- http://localhost:8080/
- Register and log in to view the gallery