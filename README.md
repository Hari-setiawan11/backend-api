## Installation Web App 📌

- Lakukan Kloning Aplikasi ke Lokal Proyek Anda :
```bash
  https://github.com/Hari-setiawan11/backend-api.git

```

Install Paket :
- Instal Paket Composer :
```bash
  composer install

```
- Instal Paket Spatie 1 :
```bash
  composer require spatie/laravel-permission
```
- Instal Paket Spatie :
```bash
    php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```
- Instal Paket :
```bash
    php artisan migrate
```







- Instal Paket Install Dompdf via Composer :
```bash
    composer require barryvdh/laravel-dompdf
```

- Tambahkan baris berikut ke array providers di config/app.php: :
```bash
    Barryvdh\DomPDF\ServiceProvider::class,
```

- Publikasikan Konfigurasi dompdf:
```bash
    php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
```
