# Naranja -Frontend QNAPI

Aplicación para mostrar la documentacion.

## Documentación técnica

https://docs.google.com/document/d/18R-bS2P1ANiSteolXOE-Skpg5uZBHhVDEUfor290xSE

## Instrucciones de configuración

### Variables de entorno

Crear un archivo `docker.env` con las siguientes variables de entorno:

```
SERVER_NAME=":80, caddy:80"
HTTP_PORT=9899
HTTPS_PORT=444
HTTP3_PORT=444
SYMFONY_VERSION=6.2.*
APP_SECRET=d9d4e1157795b1d04f224c68aeecf65e
APP_DOMAIN=10.10.100.16
APP_URL=http://10.10.100.16:9899
SYNERGY_DATABASE_USER=informatica
SYNERGY_DATABASE_PASS=Exact2o2o
SYNERGY_DATABASE_HOST=10.10.154.154
SYNERGY_DATABASE_PORT=1433
SYNERGY_DATABASE_NAME=apsynergy
MARIADB_VERSION=10.6.11
MARIADB_TZ=UTC
MARIADB_DATABASE=naranja
MARIADB_ROOT_PASSWORD=fTEeKs0qS2pqGDl9ybqU
MARIADB_USER=userNaranja
MARIADB_PASSWORD=naranjaexprimida45
MARIADB_PORT=3308
CORS_ALLOW_ORIGIN="^https?://(localhost|127.0.0.1)(:[0-9]+)?$"
CADDY_MERCURE_JWT_SECRET=6w9y(B&E_H@McQfTjWnZr4u7x!A%C*F/
MESSENGER_TRANSPORT_DSN=doctrine://default
ROLE_ADMIN='["administrador", "isaac", "iago.moreda"]'
```

La aplicación permite alguna configuración más,
que depende de la plantilla de [Symfony Docker](https://github.com/dunglas/symfony-docker)
que se usa como base. Están detalladas en la [documentación de dicha plantilla](README.md).

También hay que crear un archivo `client.env` para las variables de entorno del cliente:

```
APP_URL=(Dominio de la aplicación, con protocolo y puerto. Por ejemplo: https://xn--pia-8ma.org)
MERCURE_PUBLIC_URL=(Dominio de la aplicación, con protocolo y puerto, añadiendo /.well-known/mercure. Por ejemplo: https://xn--pia-8ma.org/.well-known/mercure)
```

### Contenedores

La aplicación se puede compilar en modo desarrollo o en modo producción. El modo desarrollo permite editar
los archivos y ver los cambios directamente. ***El modo producción no permite editar los archivos
directamente, lo que obliga a compilar de nuevo en modo producción para ver los cambios***.

#### Desarrollo

    docker-compose --env-file=docker.env up -d --build

Atajo del [Makefile](Makefile):

    make start-dev

#### Producción

    docker-compose --env-file=docker.env -f docker-compose.yml -f docker-compose.prod.yml up -d --build

Atajo del [Makefile](Makefile):

    make start

### Migración de la base de datos

Crear y ejecutar las migraciones de la base de datos, si fuesen necesarias.

    docker-compose exec php php bin/console doctrine:migrations:migrate

#### Producción

Atajo del [Makefile](Makefile):

    make client
