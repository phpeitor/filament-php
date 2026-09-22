# Database Standards - PHPeitor

## Objetivo

Mantener un esquema SQL Server consistente con la gestión de usuarios y reuniones del panel PHPeitor.

## Esquema actual

- `users`: usuarios autenticables de Laravel, con nombre, correo, contraseña y verificación de correo.
- `meetings`: reuniones asociadas a `users` mediante `user_id`.
- `meetings.meeting_date`: fecha y hora de la reunión.
- `meetings.meeting_status`: `requested`, `accepted`, `finished` o `cancelled`; por defecto `requested`.
- `meetings.details`, `url`, `client_name` y `client_email`: datos de la reunión y del cliente.
- `meetings.user_session`: identificador del usuario autenticado que creó el registro.

## Migraciones

- Toda modificación de esquema debe hacerse con una nueva migración; no editar migraciones ya ejecutadas.
- Incluir `up` y `down` funcionales siempre que el motor y el cambio lo permitan.
- Usar tipos y operaciones compatibles con SQL Server configurado en el proyecto.
- Mantener claves foráneas e índices coherentes con las relaciones y filtros del panel.
- Considerar datos existentes antes de agregar columnas obligatorias, restricciones o cambios de tipo.

## Consultas y datos

- Usar relaciones Eloquent y scopes para consultas reutilizables.
- Evitar N+1 en tablas, widgets y reportes; cargar relaciones necesarias explícitamente.
- No guardar secretos ni información sensible en columnas de reuniones, logs o archivos generados.
- Verificar migraciones con `php artisan migrate:status` y pruebas sobre una base de datos de desarrollo.
