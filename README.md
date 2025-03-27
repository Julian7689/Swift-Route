# 🌿 SwiftRoute - Instrucciones de Migración

Este documento detalla el proceso para ejecutar las migraciones en el proyecto SwiftRoute.

---

## 📌 Requisitos Previos

Asegúrate de que tienes Laravel instalado y que tu base de datos está configurada en el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

🚀 Ejecutar Migraciones

Para migrar las tablas en el orden correcto, sigue estos pasos:

1️⃣ Migraciones Base de Laravel

php artisan migrate --path=database/migrations/0001_01_01_000000_create_users_table.php
php artisan migrate --path=database/migrations/0001_01_01_000001_create_cache_table.php
php artisan migrate --path=database/migrations/0001_01_01_000002_create_jobs_table.php

2️⃣ Migrar Tablas Específicas de SwiftRoute

php artisan migrate --path=database/migrations/2025_03_17_230518_create_pedidos_table.php
php artisan migrate --path=database/migrations/2025_03_17_230549_create_transportistas_table.php

🌟 Opcional: Ejecutar Todas las Migraciones Juntas

php artisan migrate

🔄 Deshacer Migraciones

Para revertir migraciones:

# Deshacer la última migración
php artisan migrate:rollback

# Deshacer un número específico de pasos
php artisan migrate:rollback --step=1

🌱 Sembrar la Base de Datos (Opcional)

Si tienes seeders configurados, puedes poblar la base de datos con datos iniciales:

php artisan db:seed

🔍 Verificar Estado de Migraciones

Para ver qué migraciones se han ejecutado:

php artisan migrate:status

✨ Con estos pasos, tu base de datos estará correctamente configurada para el funcionamiento de SwiftRoute. 🚛💨
