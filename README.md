## Filament Laravel 🐘
[![forthebadge](http://forthebadge.com/images/badges/not-a-bug-a-feature.svg)](https://www.linkedin.com/in/drphp/)
[![forthebadge](http://forthebadge.com/images/badges/built-with-love.svg)](https://www.linkedin.com/in/drphp/)

[![Video](https://img.youtube.com/vi/YkIvt1Mcfq4/0.jpg)](https://www.youtube.com/watch?v=YkIvt1Mcfq4)  

[![Video Demo](https://img.shields.io/badge/YouTube-FF0000?style=for-the-badge&logo=youtube)](https://www.youtube.com/watch?v=YkIvt1Mcfq4)

## Descripción

PHPeitor es un panel administrativo construido con Laravel y Filament para gestionar usuarios y reuniones. Incluye un dashboard con métricas, gráficos, información del sistema y autenticación con recuperación de contraseña y verificación de correo electrónico.

## Requisitos

- PHP 8.2 o superior.
- Composer 2.x.
- Node.js y npm.
- SQL Server accesible desde el entorno de ejecución.
- Extensiones PHP `intl`, `pdo_sqlsrv` y `sqlsrv`.
- ODBC Driver 18 for SQL Server.

## Instalación

```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
```

En Linux/macOS, utiliza `cp .env.example .env` en lugar de `copy`.

Configura las variables de entorno antes de ejecutar migraciones. Nunca subas `.env` al repositorio ni escribas credenciales directamente en el código.

```dotenv
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlsrv
DB_HOST=servidor-sql
DB_PORT=1433
DB_DATABASE=BD_FILAMENT
DB_USERNAME=usuario
DB_PASSWORD=contraseña
DB_ENCRYPT=no
DB_TRUST_SERVER_CERTIFICATE=true
```

Aplica el esquema y compila los assets:

```bash
php artisan migrate
npm run build
```

## Configuración De Correo

El panel utiliza SMTP para recuperación de contraseña y verificación de correo. Para SMTP sobre SSL en el puerto 465:

```dotenv
MAIL_MAILER=smtp
MAIL_SCHEME=smtps
MAIL_HOST=servidor-smtp
MAIL_PORT=465
MAIL_USERNAME=usuario-smtp
MAIL_PASSWORD=contraseña-smtp
MAIL_FROM_ADDRESS=usuario-smtp
MAIL_FROM_NAME="PHPeitor"
```

Después de cambiar `.env`:

```bash
php artisan config:clear
```

El modelo `User` implementa `MustVerifyEmail` y el panel habilita `passwordReset()` y `emailVerification()`.

En desarrollo local se utiliza `QUEUE_CONNECTION=sync` para enviar notificaciones inmediatamente. En producción se recomienda usar una cola persistente y mantener un worker activo:

```bash
php artisan queue:work --tries=3
```

## Ejecución Local

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

Panel administrativo:

```text
http://127.0.0.1:8000/phpeitor
```

Crear el primer usuario del panel:

```bash
php artisan make:filament-user
```

También puede utilizarse el script de desarrollo definido en Composer, que inicia servidor, cola, logs y Vite:

```bash
composer run dev
```

## Funcionalidades

- Panel Filament personalizado bajo `/phpeitor`.
- Autenticación, registro, recuperación de contraseña y verificación de correo.
- Gestión de usuarios con tipo `admin` o `agent`.
- Gestión de usuarios con estado `active` o `inactive`.
- Gestión de reuniones con estados solicitada, aceptada, finalizada y cancelada.
- Dashboard con métricas dinámicas de usuarios, administradores, usuarios activos y reuniones.
- Gráficos de usuarios y distribución de reuniones por estado.
- Widget con versiones de Filament, Laravel y PHP.
- Tema oscuro personalizado, logo, favicon y footer.

## Dashboard Y Sistema

El dashboard se compone de:

- `AccountWidget`: usuario autenticado y cierre de sesión.
- `SystemInfoWidget`: versiones instaladas y estado del snapshot del sistema.
- `UserOverview`: cuatro cards con conteos de la base de datos, gráficos lineales y variación mensual.
- `MeetingOverview`: distribución de reuniones por estado.
- `UserChartOverview`: evolución anual de usuarios.

El comando siguiente genera el snapshot opcional en `storage/app/phpeitor/system-info.json`:

```bash
php artisan phpeitor:system-info
```

El widget muestra valores actuales aunque el snapshot todavía no exista.

## Comandos Operativos

```bash
php artisan about
php artisan migrate:status
php artisan route:list --path=phpeitor
php artisan optimize:clear
php artisan filament:assets
php artisan phpeitor:system-info
php artisan test
vendor/bin/pint --test
npm run build
```

## Estructura Del Proyecto

```text
app/
├── Filament/Resources       Recursos, páginas y widgets del panel
├── Filament/Widgets         Widgets globales del dashboard
├── Models                   User y Meeting
└── Providers/Filament       Configuración del panel PHPeitor
database/migrations          Evolución del esquema SQL Server
resources/css/filament        Tema visual del panel
resources/views/filament      Vistas Blade personalizadas
routes/console.php            Comandos Artisan de la aplicación
.ia-context/                  Reglas y estándares para colaboradores
```

## Verificación Antes De Entregar

Para cambios PHP o de base de datos:

```bash
php artisan test
vendor/bin/pint --test
php artisan migrate:status
```

Para cambios de vistas, Tailwind o tema:

```bash
npm run build
php artisan optimize:clear
```

Revisa también autenticación, formularios de usuarios, filtros de reuniones, recuperación de contraseña y verificación de correo cuando el cambio afecte esas áreas.

## Solución De Problemas

### El panel muestra errores de assets

```bash
php artisan filament:assets
php artisan optimize:clear
npm run build
```

### Los cambios de configuración no se reflejan

```bash
php artisan config:clear
php artisan optimize:clear
```

### El correo no llega

Verifica que el servidor SMTP sea accesible, que `MAIL_SCHEME` coincida con el puerto, que el remitente esté autorizado por el proveedor y que el correo no haya sido clasificado como spam. En producción, confirma que el worker de colas esté activo.

### El enlace de verificación apunta a una URL incorrecta

Comprueba `APP_URL` en `.env`, limpia la configuración y reinicia el proceso de Laravel:

```bash
php artisan config:clear
php artisan serve --host=127.0.0.1 --port=8000
```

### El chart de reuniones aparece vacío

Verifica que existan registros en `meetings`, que `meeting_status` utilice uno de los estados permitidos y que la aplicación esté conectada a la base configurada:

```bash
php artisan migrate:status
php artisan about
```
