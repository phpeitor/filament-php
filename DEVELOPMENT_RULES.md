# Reglas De Desarrollo

## Backend

- Usar PHP `8.2+` compatible con Laravel `11`.
- Mantener recursos Filament en `app/Filament/Resources` y widgets globales en `app/Filament/Widgets`.
- En Filament `5`, usar acciones desde `Filament\Actions`, no desde `Filament\Tables\Actions`.
- En widgets `StatsOverviewWidget`, usar `Filament\Widgets\StatsOverviewWidget\Stat`; no usar `Card`.
- Evitar valores hardcodeados en dashboard si existe un modelo o consulta real.
- Usar nombres y labels en español para UI visible al usuario.
- Ejecutar `php artisan about` después de cambios estructurales en providers, widgets o recursos.
- Ejecutar `php artisan optimize:clear` cuando se modifiquen vistas, configuración o assets de Filament.

## Frontend

- Respetar el diseño base de Filament y evitar CSS global innecesario.
- Si se agregan clases nuevas de Tailwind en vistas Blade, ejecutar `npm run build`.
- Para estilos críticos en widgets pequeños, preferir clases existentes del tema; usar estilos inline solo cuando se quiera evitar depender del build.
- Verificar el panel en desktop y mobile cuando se cambien widgets, navegación o acciones.
- Si faltan scripts, estilos o fuentes de Filament, ejecutar `php artisan filament:assets`.

## Filament

- Registrar widgets globales en `app/Providers/Filament/PhpeitorPanelProvider.php`.
- Los widgets que dependan de archivos generados deben implementar `canView()` para no mostrar bloques vacíos.
- Mantener el menú de usuario en topbar con `UserMenuPosition::Topbar`.
- Después de actualizar Filament, revisar namespaces de acciones, widgets y componentes.

## Verificación Mínima

Antes de cerrar un cambio, ejecutar según corresponda:

```bash
php artisan about
php artisan route:list --path=phpeitor
npm run build
```
