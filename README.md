SwiftRoute - Instrucciones de Migración

Este documento detalla el proceso para ejecutar las migraciones en el proyecto SwiftRoute.

Requisitos Previos

Asegúrate de que tienes instalado Laravel y configurada tu base de datos en el archivo .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

Ejecutar Migraciones

Para migrar las tablas en el orden correcto, sigue los siguientes pasos:

1. Ejecutar las migraciones base de Laravel

php artisan migrate --path=database/migrations/0001_01_01_000000_create_users_table.php
php artisan migrate --path=database/migrations/0001_01_01_000001_create_cache_table.php
php artisan migrate --path=database/migrations/0001_01_01_000002_create_jobs_table.php

2. Migrar las tablas específicas del proyecto SwiftRoute

php artisan migrate --path=database/migrations/2025_03_17_230518_create_pedidos_table.php
php artisan migrate --path=database/migrations/2025_03_17_230549_create_transportistas_table.php

Ejecutar todas las migraciones juntas (opcional)

Si deseas ejecutar todas las migraciones en un solo comando, usa:

php artisan migrate

Deshacer Migraciones (Rollback)

Si necesitas revertir las migraciones, usa el siguiente comando:

php artisan migrate:rollback

Para revertir un número específico de pasos, usa:

php artisan migrate:rollback --step=1

Sembrar la Base de Datos (Opcional)

Si tienes seeders configurados, puedes poblar la base de datos con datos iniciales ejecutando:

php artisan db:seed

Verificar Migraciones

Para ver qué migraciones se han ejecutado, usa:

php artisan migrate:status

Con esto, tu base de datos estará correctamente configurada para el funcionamiento de SwiftRoute.


