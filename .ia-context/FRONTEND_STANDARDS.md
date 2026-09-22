# Frontend Standards - PHPeitor

## Objetivo

Mantener una interfaz administrativa clara, accesible y coherente con el panel Filament personalizado.

## Panel y componentes

- El panel principal está en `/phpeitor`, usa modo oscuro habilitado, color primario ámbar, logo y footer personalizados.
- Preferir componentes nativos de Filament: formularios, tablas, filtros, acciones, badges, infolists y widgets.
- Mantener los labels, estados y mensajes visibles en español.
- Usar badges y colores semánticos para estados de reuniones: solicitada, aceptada, finalizada y cancelada.
- Mantener formularios y tablas adaptables a escritorio y móvil; no depender de anchos fijos innecesarios.
- Para personalizaciones visuales, usar `resources/css/filament/phpeitor/theme.css` y vistas en `resources/views/filament`.

## Widgets y dashboard

- Registrar widgets mediante el `PhpeitorPanelProvider` o el descubrimiento configurado, siguiendo el patrón existente.
- Los widgets de métricas deben consultar datos de forma eficiente y mostrar estados vacíos comprensibles.
- El widget de información del sistema depende de `storage/app/phpeitor/system-info.json`, generado por `php artisan phpeitor:system-info`.

## Assets y frontend

- Respetar el pipeline Vite y la configuración Tailwind existente; no introducir otra estrategia de compilación.
- Después de cambiar CSS, vistas Blade o clases Tailwind, ejecutar `npm run build`.
- Si faltan archivos publicados de Filament, ejecutar `php artisan filament:assets` y `php artisan optimize:clear`.
- Evitar JavaScript personalizado cuando una interacción de Filament/Livewire resuelva el caso.
