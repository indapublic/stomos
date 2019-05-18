stomos
==============

###Start

```bash
$ docker-compose up -d
```

###Install

```bash
$ docker-compose exec php composer install
```

###Database

```bash
$ docker-compose exec php bin/console doctrine:database:create
```

###Migrations
```bash
$ docker-compose exec php bin/console doctrine:migrations:migrate
```

###Development 

```bash
$ docker-compose exec node npm run watch
```

###Production

```bash
$ docker-compose exec node npm run build
```

###Create admin user

```bash
$ docker-compose exec php bin/console app:create-admin
```

###Add host to etc/hosts

`127.0.0.1 stomos.localhost`

###Open in browser

`http://stomos.localhost:10080`