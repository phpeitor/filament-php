# Reglas de Desarrollo - PHPeitor

## Contexto del proyecto

PHPeitor es una aplicación Laravel para administrar usuarios y reuniones desde un panel administrativo Filament.

- PHP 8.2+ (el README documenta PHP 8.3).
- Laravel 11.x.
- Filament 5.x y Livewire 4.x.
- Base de datos objetivo: SQL Server.
- Interfaz y mensajes de negocio en español.
- Panel autenticado en `/phpeitor`.

## Estructura principal

- `app/Models`: modelos Eloquent, actualmente `User` y `Meeting`.
- `app/Filament/Resources`: recursos, formularios, tablas, infolists y páginas Filament.
- `app/Filament/Widgets`: widgets del dashboard.
- `app/Providers/Filament/PhpeitorPanelProvider.php`: configuración central del panel.
- `database/migrations`: esquema y evolución de la base de datos.
- `resources/views/filament`: vistas personalizadas del panel.
- `resources/css/filament/phpeitor`: tema y estilos del panel.
- `routes/console.php`: comandos Artisan definidos por la aplicación.

## Reglas obligatorias

1. Antes de cambiar código, revisar el modelo, migraciones y recurso Filament relacionado.
2. Reutilizar las convenciones y APIs de Filament 5 ya presentes; no mezclar sintaxis de versiones anteriores.
3. Mantener los textos visibles al usuario en español y usar traducciones existentes cuando corresponda.
4. No modificar `.env` ni incluir credenciales, datos reales o archivos generados en los cambios.
5. Las modificaciones de esquema deben hacerse mediante migraciones reversibles y compatibles con SQL Server.
6. Validar cambios PHP con `php artisan about` y `vendor/bin/pint --test`; ejecutar las pruebas afectadas.
7. Si se modifican estilos, vistas o assets, ejecutar `npm run build`.
8. Mantener los cambios acotados al requerimiento y actualizar el README si cambia la instalación o el uso.

## Comandos útiles

```bash
php artisan optimize:clear
php artisan route:list --path=phpeitor
php artisan test
vendor/bin/pint --test
npm run build
```
