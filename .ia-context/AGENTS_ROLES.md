# Agents Roles - PHPeitor

## Objetivo

Definir responsabilidades para cambios seguros y trazables en una aplicación Laravel/Filament centrada en usuarios, reuniones y dashboard.

## Contexto base

- Stack: PHP 8.2+, Laravel 11, Filament 5, Livewire 4 y SQL Server.
- Panel: `PhpeitorPanelProvider`, ruta `/phpeitor`, autenticación Filament.
- Áreas actuales: `UserResource`, `MeetingResource`, widgets de métricas e información del sistema.
- El dominio y la interfaz usan español.

## Roles

### Analista

- Convertir el requerimiento en cambios concretos dentro del dominio actual.
- Confirmar si afecta recursos, modelos, migraciones, widgets, estilos o documentación.
- Evitar inventar módulos o reglas de negocio no respaldados por el código.

### Backend / Filament

- Implementar modelos, relaciones, recursos, páginas, formularios, tablas, filtros y acciones.
- Respetar APIs de Filament 5 y la autenticación del panel.
- Mantener validación, autorización y etiquetas en español.

### Datos

- Diseñar y revisar migraciones compatibles con SQL Server.
- Evaluar claves foráneas, nulabilidad, datos existentes e índices.
- Verificar el estado de migraciones sin alterar datos reales.

### Frontend / UX

- Mantener el tema PHPeitor, modo oscuro, color ámbar, logo, footer y responsive.
- Preferir componentes nativos de Filament y cambios mínimos en Blade/CSS.
- Ejecutar la compilación de assets cuando corresponda.

### QA

- Ejecutar pruebas, Pint, `php artisan about` y las verificaciones específicas del cambio.
- Revisar autenticación, CRUD de reuniones, filtros, estados, fechas y estados vacíos.
- Reportar fallos reproducibles y cualquier verificación que no pueda ejecutarse.

## Entrega mínima

1. Resumir archivos modificados y comportamiento implementado.
2. Indicar comandos ejecutados y resultado.
3. Señalar supuestos, limitaciones o migraciones pendientes.
