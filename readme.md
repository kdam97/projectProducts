----------

# Getting started

## Installation

Consulte la guía de instalación oficial de laravel para conocer los requisitos del servidor antes de comenzar. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clonar el repositorio

    git clone https://github.com/kdam97/projectProducts.git

Ingresar a la carpeta del proyecto

    cd projectProducts

Instalar las dependencias usando composer

    composer install

Copiar el archivo .env.example  a un nuevo archivo llamado .env

    cp .env.example .env

Ejecutar las migraciones de la base de datos (**Configurar la conexion de la base de datos en el archivo .env antes de las migraciones**)

    php artisan migrate

Ejecutar los seeds de la base de datos (**Estos contienen los registros de categorias para el funcionamiento**)

    php artisan db:seed
    
Iniciar el servidor de desarrollo local

    php artisan serve

Ya puedes acceder al servidor local con la siguiente url http://localhost:8000

**TL;DR command list**

    git clone https://github.com/kdam97/projectProducts
    cd projectProducts
    composer install
    cp .env.example .env
    
**Asegúrese de configurar la información de conexión de la base de datos correcta antes de ejecutar las migraciones** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan db:seed
    php artisan serve

Ejecutar las pruebas unitarias

    php vendor/phpunit/phpunit/phpunit --filter ProductosTest
----------


# Code overview

## Folders

- `app` - Contiene todos los modelos de  Eloquent
- `app/Http/Controllers/Api` - Contiene todos los api controllers
- `database/migrations` - Contiene todas las migraciones de la base de datos
- `database/seeds` - Contiene los seeder de la base de datos
- `routes` - Contiene todas las rutas del proyecto

## Environment variables

- `.env` - Las variables de entorno se pueden establecer en este archivo

***Nota*** : Las tablas se pueden evidenciar en el momento de despliegue del proyecto, al ejecutar las migraciones, recuerde que antes debe crear la base de datos.


