# Gantolin - Platform E-Commerce

Gantolin adalah aplikasi e-commerce modern yang dibangun dengan **Laravel 12** dan **Tailwind CSS**. Platform ini menyediakan pengalaman berbelanja yang mulus untuk pelanggan dan panel manajemen yang komprehensif untuk administrator.

## 📋 Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Prasyarat](#prasyarat)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Struktur Proyek](#struktur-proyek)
- [API & Routes](#api--routes)
- [Database](#database)
- [Testing](#testing)
- [Troubleshooting](#troubleshooting)
- [Kontribusi](#kontribusi)

---

## ✨ Fitur Utama

### Untuk Pelanggan

<<<<<<< HEAD

- **Browsing Produk**: Jelajahi katalog produk dengan kategori yang terorganisir
- **Sistem Keranjang**: Tambah, hapus, dan perbarui jumlah produk di keranjang
- **Checkout**: Proses pembelian yang aman dan cepat
- **Manajemen Pesanan**: Lihat, lacak, dan batalkan pesanan
- **Autentikasi**: Pendaftaran dan login pengguna yang aman
- **Buy Now**: Pembelian cepat tanpa perlu menambah ke keranjang terlebih dahulu

### Untuk Administrator

- **Dashboard**: Ringkasan statistik penjualan dan performa
- **Manajemen Produk**:
    - Membuat produk baru
    - Mengedit informasi produk
    - Menghapus produk
    - Mengelola kategori
- **Manajemen Pesanan**:
    - Melihat semua pesanan
    - Memperbarui status pesanan
    - Menghapus pesanan
- **Laporan**: Analisis penjualan dan revenue
- **Login Admin**: Akses kontrol berbasis autentikasi

---

## 🔧 Prasyarat

Pastikan sistem Anda memiliki:

- **PHP** 8.2 atau lebih tinggi
- **Composer** (untuk manajemen dependency PHP)
- **Node.js** 16+ dan **npm** (untuk build frontend)
- **Database** (SQLite default, dapat diubah ke MySQL/PostgreSQL)
- **Git** (opsional, untuk version control)

### Cara Memverifikasi Instalasi

```bash
php --version
composer --version
node --version
npm --version
```

---

## 📦 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/kaito205/gantolin.git
cd gantolin
```

### 2. Setup Otomatis (Rekomendasi)

Jalankan script setup yang telah dikonfigurasi:

=======

- **Browsing Produk**: Jelajahi katalog produk dengan kategori yang terorganisir
- **Sistem Keranjang**: Tambah, hapus, dan perbarui jumlah produk di keranjang
- **Checkout**: Proses pembelian yang aman dan cepat
- **Manajemen Pesanan**: Lihat, lacak, dan batalkan pesanan
- **Autentikasi**: Pendaftaran dan login pengguna yang aman
- **Buy Now**: Pembelian cepat tanpa perlu menambah ke keranjang terlebih dahulu

### Untuk Administrator

- **Dashboard**: Ringkasan statistik penjualan dan performa
- **Manajemen Produk**:
    - Membuat produk baru
    - Mengedit informasi produk
    - Menghapus produk
    - Mengelola kategori
- **Manajemen Pesanan**:
    - Melihat semua pesanan
    - Memperbarui status pesanan
    - Menghapus pesanan
- **Laporan**: Analisis penjualan dan revenue
- **Login Admin**: Akses kontrol berbasis autentikasi

---

## 🔧 Prasyarat

Pastikan sistem Anda memiliki:

- **PHP** 8.2 atau lebih tinggi
- **Composer** (untuk manajemen dependency PHP)
- **Node.js** 16+ dan **npm** (untuk build frontend)
- **Database** (SQLite default, dapat diubah ke MySQL/PostgreSQL)
- **Git** (opsional, untuk version control)

### Cara Memverifikasi Instalasi

```bash
php --version
composer --version
node --version
npm --version
```

---

## 📦 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/kaito205/gatolin.git
cd gatolin
```

### 2. Setup Otomatis (Rekomendasi)

Jalankan script setup yang telah dikonfigurasi:

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
composer setup
```

Script ini akan secara otomatis:
<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

- Menginstal dependency PHP dengan Composer
- Menyalin file `.env.example` ke `.env`
- Mengenerate kunci aplikasi
- Menjalankan migrasi database
- Menginstal dependency Node.js
- Build frontend assets

### 3. Setup Manual

Jika Anda lebih suka melakukan setup secara manual:

#### a. Instalasi Dependency PHP

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
composer install
```

#### b. Konfigurasi Environment

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
cp .env.example .env
php artisan key:generate
```

#### c. Setup Database

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
php artisan migrate
```

#### d. Instalasi Dependency Frontend

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
npm install
```

#### e. Build Frontend Assets

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
npm run build
```

---

## ⚙️ Konfigurasi

### File `.env`

File `.env` berisi konfigurasi aplikasi. Edit file ini sesuai kebutuhan:

```env
# Informasi Aplikasi
APP_NAME=Gantolin
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database Configuration
DB_CONNECTION=sqlite
# Untuk MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=gantolin
# DB_USERNAME=root
# DB_PASSWORD=

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Cache & Queue
CACHE_STORE=database
QUEUE_CONNECTION=database

# Mail Configuration
MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_FROM_ADDRESS="noreply@gantolin.com"
```

### Mengubah Database (Optional)

**Default**: SQLite (file database/database.sqlite)

**Untuk MySQL**:
<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gantolin
DB_USERNAME=root
DB_PASSWORD=your_password
```

Kemudian jalankan migrasi:
<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
php artisan migrate
```

---

## 🚀 Menjalankan Aplikasi

### Development Mode (Recommended)

Menjalankan semua service secara bersamaan (server PHP, queue, logs, dan vite):

```bash
composer dev
```

Ini akan membuka:
<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

- **PHP Development Server**: http://localhost:8000
- **Vite HMR**: Hot reload untuk frontend assets

### Production Build

```bash
npm run build
php artisan serve
```

### Server Terpisah

Jika Anda ingin menjalankan service secara terpisah:

```bash
# Terminal 1: PHP Server
php artisan serve

# Terminal 2: Queue Listener
php artisan queue:listen

# Terminal 3: Logs
php artisan pail

# Terminal 4: Vite Dev Server
npm run dev
```

---

## 📁 Struktur Proyek

```
gantolin/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php       # Autentikasi pengguna
│   │   │   ├── AdminController.php      # Panel admin
│   │   │   ├── ProdukController.php     # Manajemen produk
│   │   │   ├── CartController.php       # Keranjang belanja
│   │   │   └── OrderController.php      # Manajemen pesanan
│   │   └── Middleware/                  # HTTP Middleware
│   ├── Models/
│   │   ├── User.php                     # Model pengguna
│   │   ├── Product.php                  # Model produk
│   │   ├── Category.php                 # Model kategori
│   │   ├── Order.php                    # Model pesanan
│   │   └── CartItem.php                 # Model item keranjang
│   └── ...
├── resources/
│   ├── views/
│   │   ├── welcome.blade.php            # Halaman utama
│   │   ├── produk/                      # Views produk
│   │   ├── keranjang/                   # Views keranjang
│   │   ├── pesanan/                     # Views pesanan
│   │   ├── auth/                        # Views autentikasi
│   │   └── admin/                       # Views admin
│   ├── css/
│   │   └── app.css                      # Tailwind CSS
│   └── js/
│       └── app.js                       # JavaScript utama
├── routes/
│   ├── web.php                          # Web routes
│   └── console.php                      # Console commands
├── database/
│   ├── migrations/                      # Database migrations
│   ├── factories/                       # Model factories
│   ├── seeders/                         # Database seeders
│   └── database.sqlite                  # SQLite database
├── public/
│   ├── index.php                        # Entry point aplikasi
│   ├── css/                             # Built CSS assets
│   └── js/                              # Built JS assets
├── config/
│   ├── app.php                          # Konfigurasi aplikasi
│   ├── database.php                     # Konfigurasi database
│   ├── auth.php                         # Konfigurasi autentikasi
│   └── ...
├── tests/                               # Test cases
├── storage/                             # File uploads & logs
├── vendor/                              # Dependency PHP (Composer)
├── node_modules/                        # Dependency Node (npm)
├── .env                                 # Environment variables
├── .env.example                         # Template environment
├── composer.json                        # PHP dependencies
├── package.json                         # Node dependencies
├── vite.config.js                       # Vite configuration
└── README.md                            # File dokumentasi ini
```

---

## 🛣️ API & Routes

### Routes Publik (Tanpa Autentikasi)

<<<<<<< HEAD
| Method | Route | Controller | Deskripsi |
| ------ | ------------------- | --------------------------- | -------------------------------- |
| GET | `/` | - | Halaman utama dengan produk acak |
| GET | `/produk` | ProdukController@index | Daftar semua produk |
| GET | `/produk/{id}` | ProdukController@show | Detail produk |
| GET | `/keranjang` | CartController@index | Lihat keranjang |
| GET | `/add-to-cart/{id}` | CartController@add | Tambah ke keranjang |
| GET | `/buy-now/{id}` | CartController@buyNow | Beli langsung |
| PATCH | `/update-cart` | CartController@update | Update jumlah produk |
| DELETE | `/remove-from-cart` | CartController@remove | Hapus dari keranjang |
| GET | `/login` | AuthController@showLogin | Halaman login |
| POST | `/login` | AuthController@login | Proses login |
| GET | `/register` | AuthController@showRegister | Halaman registrasi |
| POST | `/register` | AuthController@register | Proses registrasi |

### Routes Dengan Autentikasi (User)

| Method | Route                  | Controller              | Deskripsi           |
| ------ | ---------------------- | ----------------------- | ------------------- |
| POST   | `/logout`              | AuthController@logout   | Logout pengguna     |
| POST   | `/checkout`            | CartController@checkout | Checkout pesanan    |
| GET    | `/pesanan`             | OrderController@index   | Daftar pesanan user |
| POST   | `/pesanan/{id}/cancel` | OrderController@cancel  | Batalkan pesanan    |
| DELETE | `/pesanan/{id}`        | OrderController@destroy | Hapus pesanan       |

### Routes Admin

| Method | Route                         | Controller                        | Deskripsi             |
| ------ | ----------------------------- | --------------------------------- | --------------------- |
| GET    | `/admin/login`                | -                                 | Halaman login admin   |
| GET    | `/admin/dashboard`            | AdminController@dashboard         | Dashboard admin       |
| GET    | `/admin/orders`               | AdminController@orders            | Daftar pesanan        |
| POST   | `/admin/orders/{id}/status`   | AdminController@updateOrderStatus | Update status pesanan |
| DELETE | `/admin/orders/{id}`          | AdminController@deleteOrder       | Hapus pesanan         |
| GET    | `/admin/reports`              | AdminController@reports           | Laporan penjualan     |
| GET    | `/admin/products/create`      | AdminController@createProduct     | Form buat produk      |
| POST   | `/admin/products`             | AdminController@storeProduct      | Simpan produk baru    |
| GET    | `/admin/products/{id}/edit`   | AdminController@editProduct       | Form edit produk      |
| POST   | `/admin/products/{id}/update` | AdminController@updateProduct     | Update produk         |
| DELETE | `/admin/products/{id}`        | AdminController@deleteProduct     | Hapus produk          |

=======
| Method | Route | Controller | Deskripsi |
|--------|-------|-----------|-----------|
| GET | `/` | - | Halaman utama dengan produk acak |
| GET | `/produk` | ProdukController@index | Daftar semua produk |
| GET | `/produk/{id}` | ProdukController@show | Detail produk |
| GET | `/keranjang` | CartController@index | Lihat keranjang |
| GET | `/add-to-cart/{id}` | CartController@add | Tambah ke keranjang |
| GET | `/buy-now/{id}` | CartController@buyNow | Beli langsung |
| PATCH | `/update-cart` | CartController@update | Update jumlah produk |
| DELETE | `/remove-from-cart` | CartController@remove | Hapus dari keranjang |
| GET | `/login` | AuthController@showLogin | Halaman login |
| POST | `/login` | AuthController@login | Proses login |
| GET | `/register` | AuthController@showRegister | Halaman registrasi |
| POST | `/register` | AuthController@register | Proses registrasi |

### Routes Dengan Autentikasi (User)

| Method | Route                  | Controller              | Deskripsi           |
| ------ | ---------------------- | ----------------------- | ------------------- |
| POST   | `/logout`              | AuthController@logout   | Logout pengguna     |
| POST   | `/checkout`            | CartController@checkout | Checkout pesanan    |
| GET    | `/pesanan`             | OrderController@index   | Daftar pesanan user |
| POST   | `/pesanan/{id}/cancel` | OrderController@cancel  | Batalkan pesanan    |
| DELETE | `/pesanan/{id}`        | OrderController@destroy | Hapus pesanan       |

### Routes Admin

| Method | Route                         | Controller                        | Deskripsi             |
| ------ | ----------------------------- | --------------------------------- | --------------------- |
| GET    | `/admin/login`                | -                                 | Halaman login admin   |
| GET    | `/admin/dashboard`            | AdminController@dashboard         | Dashboard admin       |
| GET    | `/admin/orders`               | AdminController@orders            | Daftar pesanan        |
| POST   | `/admin/orders/{id}/status`   | AdminController@updateOrderStatus | Update status pesanan |
| DELETE | `/admin/orders/{id}`          | AdminController@deleteOrder       | Hapus pesanan         |
| GET    | `/admin/reports`              | AdminController@reports           | Laporan penjualan     |
| GET    | `/admin/products/create`      | AdminController@createProduct     | Form buat produk      |
| POST   | `/admin/products`             | AdminController@storeProduct      | Simpan produk baru    |
| GET    | `/admin/products/{id}/edit`   | AdminController@editProduct       | Form edit produk      |
| POST   | `/admin/products/{id}/update` | AdminController@updateProduct     | Update produk         |
| DELETE | `/admin/products/{id}`        | AdminController@deleteProduct     | Hapus produk          |

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

---

## 🗄️ Database

### Models Utama

#### User

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

- id
- name
- email
- password
- email_verified_at
- is_admin
- created_at
- updated_at

#### Product

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

- id
- name
- description
- price
- quantity
- category_id
- image_path
- created_at
- updated_at

#### Category

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

- id
- name
- description
- created_at
- updated_at

#### Order

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

- id
- user_id
- total_price
- status (pending, processing, completed, cancelled)
- created_at
- updated_at

#### OrderItem

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

- id
- order_id
- product_id
- quantity
- price
- created_at
- updated_at

#### Cart (Session-based)

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

- Disimpan di session database
- user_id
- product_id
- quantity

### Menjalankan Migrasi

```bash
# Migrasi forward
php artisan migrate

# Rollback terakhir
php artisan migrate:rollback

# Rollback semua
php artisan migrate:reset

# Migrasi ulang
php artisan migrate:refresh

# Migrasi dengan seeder
php artisan migrate:fresh --seed
```

### Seeding Data

Untuk mengisi database dengan data dummy:

```bash
php artisan db:seed
```

---

## ✅ Testing

### Menjalankan Test Suite

```bash
composer test
```

Ini akan menjalankan semua test di direktori `tests/`.

### Menulis Test Baru

1. Buat file test di `tests/Feature/` atau `tests/Unit/`
2. Extend `TestCase`
3. Tulis test methods yang dimulai dengan `test`

Contoh:
<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```php
public function test_user_can_login()
{
    $response = $this->post('/login', [
        'email' => 'user@example.com',
        'password' => 'password'
    ]);
<<<<<<< HEAD

=======

>>>>>>> 1f3e6ef188719f822113f40e7b344326c57c4fda
    $response->assertRedirect('/');
}
```

---

## 🔍 Troubleshooting

### 1. Error: "No such file or directory" pada migration

**Solusi:**
<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
php artisan migrate:fresh
```

### 2. Vite assets tidak load

**Solusi:**
<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
npm run build
# atau untuk development
npm run dev
```

### 3. Database permission denied

**Solusi:**
<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
chmod 666 database/database.sqlite
chmod 755 database/
```

### 4. Composer "out of memory"

**Solusi:**
<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
php -d memory_limit=-1 composer install
```

### 5. Node modules conflict

**Solusi:**
<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
rm -rf node_modules
rm package-lock.json
npm install
```

### 6. Laravel key not set

**Solusi:**
<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
php artisan key:generate
```

### 7. Queue jobs tidak dijalankan

**Pastikan running:**
<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

```bash
php artisan queue:listen
```

---

## 📋 Teknologi yang Digunakan

### Backend

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

- **Laravel 12**: Framework PHP modern
- **PHP 8.2+**: Bahasa pemrograman
- **SQLite/MySQL**: Database
- **Composer**: Dependency manager PHP

### Frontend

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

- **Tailwind CSS 4.0**: Utility-first CSS framework
- **Vite 7.0**: Build tool & dev server
- **JavaScript ES6+**: Bahasa pemrograman
- **Axios**: HTTP client

### Development & Testing

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

- **PHPUnit**: Framework testing PHP
- **Laravel Pint**: Code formatter PHP
- **Faker**: Generate data dummy
- **Mockery**: Mocking library

---

## 🤝 Kontribusi

Kami menerima kontribusi! Berikut langkah-langkahnya:

1. **Fork** repository
2. **Buat branch** feature Anda (`git checkout -b feature/AmazingFeature`)
3. **Commit** perubahan Anda (`git commit -m 'Add some AmazingFeature'`)
4. **Push** ke branch (`git push origin feature/AmazingFeature`)
5. **Buka Pull Request**

### Guidelines

<<<<<<< HEAD

=======

> > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda

- Ikuti PSR-12 code style
- Tambahkan test untuk fitur baru
- Update README jika ada perubahan
- Gunakan commit messages yang deskriptif

---

## 📄 Lisensi

Aplikasi ini dilisensikan di bawah [MIT License](LICENSE).

---

## 👨‍💻 Author

<<<<<<< HEAD

- # **Repository**: https://github.com/kaito205/gantolin
- **Repository**: https://github.com/kaito205/gatolin
    > > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda
- **Maintainer**: kaito205

---

## 📞 Support

Jika Anda memiliki pertanyaan atau masalah:

<<<<<<< HEAD

1. # Periksa [Issues](https://github.com/kaito205/gantolin/issues) yang ada
1. Periksa [Issues](https://github.com/kaito205/gatolin/issues) yang ada
    > > > > > > > 1f3e6ef188719f822113f40e7b344326c57c4fda
1. Buat issue baru dengan detail yang jelas
1. Sertakan error messages dan langkah reproduksi

---

## 🗺️ Roadmap

- [ ] Integrasi payment gateway (Stripe, MIDTRANS)
- [ ] Sistem notifikasi email
- [ ] Wishlist produk
- [ ] Review & rating produk
- [ ] Advanced search & filter
- [ ] Multi-language support
- [ ] Mobile app dengan React Native
- [ ] Analytics dashboard

---

**Happy Coding! 🚀**
