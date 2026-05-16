## Filament Laravel 🐘
[![forthebadge](http://forthebadge.com/images/badges/not-a-bug-a-feature.svg))](https://www.linkedin.com/in/drphp/)
[![forthebadge](http://forthebadge.com/images/badges/built-with-love.svg)](https://www.linkedin.com/in/drphp/)

[![Video](https://img.youtube.com/vi/YkIvt1Mcfq4/0.jpg)](https://www.youtube.com/watch?v=YkIvt1Mcfq4)  

[![Video Demo](https://img.shields.io/badge/YouTube-FF0000?style=for-the-badge&logo=youtube)](https://www.youtube.com/watch?v=YkIvt1Mcfq4)


## Stack

| Tecnología | Versión |
| --- | --- |
| PHP | 8.3 |
| Laravel | 11.x |
| Filament | 5.x |
| Livewire | 4.x |
| Base de datos | SQL Server |

## Requisitos

- PHP 8.2 o superior
- Composer
- Node.js y npm
- SQL Server configurado
- Extensiones PHP requeridas por Laravel y SQL Server

## Instalación

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Configura la conexión a base de datos en `.env` y ejecuta:

```bash
php artisan migrate
npm run build
```

## Ejecutar En Local

```bash
php artisan serve
```

Panel Filament:

```text
http://127.0.0.1:8000/phpeitor
```

Crear un usuario para ingresar al panel:

```bash
php artisan make:filament-user
```

## Funcionalidades

- Panel Filament personalizado bajo `/phpeitor`.
- Gestión de usuarios.
- Gestión de reuniones.
- Dashboard con métricas de usuarios y reuniones.
- Gráficos de usuarios y reuniones.
- Widget de información del sistema generado por comando Artisan.
- Tema personalizado, logo, favicon y footer.

## Widget Sistema

El dashboard incluye un widget propio que muestra las versiones de Filament, Laravel y PHP.

Este widget no aparece automáticamente en instalaciones nuevas. Para generarlo, ejecuta:

```bash
php artisan phpeitor:system-info
```

El comando crea o actualiza:

```text
storage/app/phpeitor/system-info.json
```

Ejecuta el comando nuevamente cuando actualices PHP, Laravel o Filament.

## Assets Filament

Si el panel muestra errores de consola por archivos faltantes como `/js/filament/...`, publica los assets:

```bash
php artisan filament:assets
php artisan optimize:clear
```

Si cambias estilos o agregas clases nuevas de Tailwind en vistas Blade:

```bash
npm run build
```

## Comandos Útiles

```bash
php artisan about
php artisan route:list --path=phpeitor
php artisan optimize:clear
php artisan filament:assets
php artisan phpeitor:system-info
npm run build
```

## Estructura Relevante

```text
app/Filament/Resources
app/Filament/Widgets
app/Providers/Filament/PhpeitorPanelProvider.php
resources/views/filament
resources/css/filament/phpeitor/theme.css
routes/console.php
```

## Reglas Desarrollo

Las reglas del proyecto están documentadas en:

```text
DEVELOPMENT_RULES.md
```

Incluyen convenciones para backend, frontend, Filament, assets y verificación mínima antes de cerrar cambios.

## Troubleshooting

### El panel no carga scripts o estilos de Filament

```bash
php artisan filament:assets
php artisan optimize:clear
```

### Cambios en vistas no aparecen

```bash
php artisan optimize:clear
```

### El widget de versiones no aparece

```bash
php artisan phpeitor:system-info
```

### Verificar versión y estado de la app

```bash
php artisan about
```
