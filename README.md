## Filament Laravel 🐘
[![forthebadge](http://forthebadge.com/images/badges/not-a-bug-a-feature.svg))](https://www.linkedin.com/in/drphp/)
[![forthebadge](http://forthebadge.com/images/badges/built-with-love.svg)](https://www.linkedin.com/in/drphp/)

[![Video](https://img.youtube.com/vi/YkIvt1Mcfq4/0.jpg)](https://www.youtube.com/watch?v=YkIvt1Mcfq4)  

[![Video Demo](https://img.shields.io/badge/YouTube-FF0000?style=for-the-badge&logo=youtube)](https://www.youtube.com/watch?v=YkIvt1Mcfq4)

## Stack

- PHP `8.3`
- Laravel `11.x`
- Filament `5.x`
- Livewire `4.x`
- SQL Server como conexión principal del proyecto

## Instalación

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run build
```

## Panel Filament

URL local:

```text
http://127.0.0.1:8000/phpeitor
```

Crear usuario Filament:

```bash
php artisan make:filament-user
```

Publicar assets de Filament cuando falten archivos JS/CSS o fuentes:

```bash
php artisan filament:assets
php artisan optimize:clear
```

## Widget De Información Del Sistema

El dashboard incluye un widget propio que muestra versiones de Filament, Laravel y PHP.

El widget no aparece hasta que se genere el archivo de información con:

```bash
php artisan phpeitor:system-info
```

Ese comando crea o actualiza:

```text
storage/app/phpeitor/system-info.json
```

Ejecuta el comando otra vez cuando actualices PHP, Laravel o Filament.

## Comandos Útiles

```bash
php artisan about
php artisan optimize:clear
php artisan route:list --path=phpeitor
npm run build
```

## Desarrollo

Las reglas de desarrollo del proyecto están en:

```text
DEVELOPMENT_RULES.md
```
