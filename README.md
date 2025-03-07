<a href="https://www.instagram.com/amvsoft.tech/" target="_blank">
  <img src="https://github.com/filamentphp/filament/assets/41773797/8d5a0b12-4643-4b5c-964a-56f0db91b90a" />
</a>

<p align="center">
    <a href="https://github.com/filamentphp/filament/actions"><img alt="Tests passing" src="https://img.shields.io/badge/Tests-passing-green?style=for-the-badge&logo=github"></a>
    <a href="https://laravel.com"><img alt="Laravel v11.x" src="https://img.shields.io/badge/Laravel-v11.x-FF2D20?style=for-the-badge&logo=laravel"></a>
    <a href="https://livewire.laravel.com"><img alt="Livewire v3.x" src="https://img.shields.io/badge/Livewire-v3.x-FB70A9?style=for-the-badge"></a>
    <a href="https://filamentphp.com"><img alt="Filament v3.x" src="https://img.shields.io/badge/Filament-v3.x-d97706?style=for-the-badge"></a>
    <a href="https://php.net"><img alt="PHP 8.3" src="https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php"></a>
</p>

Crear un nuevo proyecto Laravel
```
    composer create-project --prefer-dist laravel/laravel .
```
Instalar Filament
```
    composer require filament/filament:"^3.2" -W
    php artisan filament:install --panels
```
Ejecutar migraciones
```
    php artisan migrate
```
Crear migraciones y recursos Filament
```
    php artisan make:migration add_fields_to_meetings_table
    php artisan make:filament-user
    php artisan make:model Meeting -m
    php artisan make:filament-resource Meeting --view
    php artisan make:filament-resource User --generate
```
Limpiar la caché y la configuración de Laravel
```
    php artisan config:clear
    php artisan optimize:clear
```
Instalar idioma español para Laravel
```
    composer require laraveles/spanish
    php artisan laraveles:install-lang
```
Logo & Favicon
```php
    ->brandName(name: 'PHPeitor')
    ->brandLogo(fn(): View => view('filament.logo'))
    ->brandLogoHeight(fn() => auth()->check() ? '1.6rem' : '2rem')
    ->favicon(asset('images/favicon-32x32.png'))
```
Footer
```php
    ->renderHook(
        'panels::body.end',
        fn (): View => view('filament.footer')
    )
    ->viteTheme('resources/css/filament/phpeitor/theme.css')
```
[![Video](https://img.youtube.com/vi/YkIvt1Mcfq4/0.jpg)](https://www.youtube.com/watch?v=YkIvt1Mcfq4)  
[Ver demo](https://www.youtube.com/watch?v=YkIvt1Mcfq4)
