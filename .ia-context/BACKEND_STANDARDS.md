# Backend Standards - PHPeitor

## Objetivo

Mantener una aplicación Laravel segura, simple y consistente con Filament 5, Eloquent y el dominio de usuarios y reuniones.

## Modelos y dominio

- Usar Eloquent para persistencia y relaciones; evitar consultas SQL directas salvo necesidad justificada.
- `Meeting` pertenece a `User` mediante `user_id` y convierte `meeting_date` a `datetime`.
- Los estados válidos de una reunión son `requested`, `accepted`, `finished` y `cancelled`.
- `Meeting` conserva `user_session` al crear el registro usando el usuario autenticado; mantener este comportamiento al modificar el flujo.
- Definir explícitamente `$fillable`, `$hidden` y `$casts` cuando se agreguen atributos.
- Validar datos en los formularios Filament y, cuando el dato se use fuera del panel, reforzar la validación en la capa correspondiente.

## Filament

- La configuración global vive en `PhpeitorPanelProvider` y el panel usa el identificador/ruta `phpeitor`.
- Implementar CRUD mediante `Resource`, páginas y componentes Filament existentes antes de crear controladores adicionales.
- Mantener separados formulario (`form`), tabla (`table`) e información de detalle (`infolist`).
- Usar acciones, filtros, etiquetas y colores consistentes con los recursos actuales.
- Proteger nuevas páginas y acciones con la autenticación del panel; no exponer información administrativa en rutas públicas.

## Validación y calidad

- Aplicar reglas de longitud, formato, URL, correo y obligatoriedad en los campos correspondientes.
- Preferir enums o constantes compartidas si el conjunto de estados crece, evitando repetir valores sin control.
- No ocultar errores con `try/catch` genéricos; registrar o presentar un error útil según el contexto.
- Verificar con `php artisan test`, `vendor/bin/pint --test` y `php artisan about`.
