# AutoLetter (Laravel 12)

Aplikasi otomasi surat-menyurat berbasis **Laravel 12**. Dokumen ini menjelaskan **teknologi yang digunakan**, **cara menjalankan proyek secara lokal**, dan **tautan demo** agar dapat dijalankan di lokal dengan mudah.

---

## ✨ Teknologi yang Digunakan
- **Framework**: Laravel 12 (PHP **≥ 8.2**)
- **Frontend**: Tailwind CSS (**via CDN**, tidak memerlukan proses build)
- **Database**: MySQL (disarankan versi terbaru)
- **Library utama**:
  - `barryvdh/laravel-dompdf` — untuk **membangkitkan/mengekspor PDF**.
  - `simple-qrcode` — untuk **membuat QR Code**.
  - `Quill` — untuk **rich-text editor**. Script berikut memuat Quill v2 via CDN.
  - `Apache ECharts` — untuk **grafik/chart** interaktif.
  - `sheetjs ` — untuk **preview excel**.
  - `phpspreadsheet` — untuk **mengelola inputan excel**.

---

## 🧩 Prasyarat
Pastikan terpasang di mesin lokal:
- **PHP ≥ 8.2**, **Composer**
- **MySQL** (disarankan versi terbaru)

---

## 🚀 Setup & Jalankan Secara Lokal (Langkah Demi Langkah)

### 1) Clone & instal dependensi
```bash
git clone https://github.com/Whyriez/auto-letter.git
```

```bash
cd autoletter
```
# PHP dependencies
```bash
composer install
```
### 2) Salin `.env` & generate APP_KEY
```bash
cp .env.example .env
````

```bash
php artisan key:generate
```

### 3) Konfigurasi `.env` minimal
Edit file `.env` Anda (sesuaikan sesuai lingkungan lokal):

~~~env
APP_NAME=AutoLetter
APP_ENV=local
APP_KEY= # (terisi otomatis oleh key:generate)
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

# Database (sesuaikan jika perlu)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=autoletter
DB_USERNAME=root
DB_PASSWORD=
~~~

### 4) Migrasi, seeder, dan storage link

```bash
php artisan migrate --seed
```

```bash
php artisan storage:link
```

### 5) Jalankan server lokal

```bash
php artisan serve
```

Aplikasi berjalan di **[http://127.0.0.1:8000](http://127.0.0.1:8000)** atau (port **8000** default).

---

## 🔑 Akun Demo (dari Seeder)

> Password default seluruh akun: **123**

* `admin@gmail.com` — **super\_admin**
* `mahasiswa@gmail.com` — **mahasiswa**
* `admin_jurusan@gmail.com` — **admin\_jurusan**
* `kaprodi@gmail.com` — **kaprodi**
* `kajur@gmail.com` — **kajur**

---

## 🌐 Link Akses (Opsional)

Demo online: **[https://auto-letter.limapp.my.id/](https://auto-letter.limapp.my.id/)**

---


