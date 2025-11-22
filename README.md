# E-Commerce Modern

<div align="center">

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

**Pengalaman belanja modern yang lengkap dengan performa dan estetika terbaik.**

</div>

---

## 📋 Tentang Proyek

Aplikasi ini adalah platform E-Commerce yang robust yang dirancang untuk memberikan pengalaman belanja yang mulus. Dibangun dengan framework **Laravel 12** yang powerful dan di-styling dengan **TailwindCSS**, menawarkan antarmuka yang responsif, cepat, dan user-friendly untuk pelanggan maupun administrator.

### ✨ Fitur Utama

-   🛍️ **Jelajahi Produk**: Grid produk yang intuitif dengan tampilan detail lengkap.
-   🛒 **Keranjang Belanja**: Manajemen keranjang secara real-time.
-   📦 **Proses Pesanan**: Siklus pesanan lengkap dari pembuatan hingga penyelesaian.
-   👥 **Akses Berbasis Role**: Panel terpisah untuk **Admin** (manajemen) dan **User** (belanja).
-   💳 **Integrasi Pembayaran**: Dukungan untuk berbagai status dan metode pembayaran.
-   📱 **Desain Responsif**: Dioptimalkan untuk mobile, tablet, dan desktop.

---

## 📸 Screenshot

<div align="center">

| **Beranda** | **Detail Produk** |
|:---:|:---:|
| <img src="public/screenshots/home.png" alt="Beranda" width="400"/> | <img src="public/screenshots/product-detail.png" alt="Detail Produk" width="400"/> |
| **Halaman Login** | **Halaman Daftar** |
| <img src="public/screenshots/login.png" alt="Login" width="400"/> | <img src="public/screenshots/register.png" alt="Daftar" width="400"/> |

</div>

---

## 🚀 Memulai

Ikuti langkah-langkah sederhana ini untuk menjalankan proyek secara lokal.

### Prasyarat

Pastikan Anda telah menginstal:
*   **PHP** >= 8.2
*   **Composer**
*   **Node.js** & **NPM**
*   **MySQL**

### 💿 Instalasi

1.  **Clone repository**
    ```bash
    git clone https://github.com/SanDiv-eL/SanDiv-eL.git
    cd SanDiv-eL
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    ```bash
    cp .env.example .env
    ```
    Buka `.env` dan update kredensial database Anda:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ecommerce
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate Key & Setup Database**
    ```bash
    php artisan key:generate
    php artisan migrate --seed
    ```
    > **Catatan**: Perintah `--seed` akan mengisi database dengan data demo dan akun default.

5.  **Jalankan Aplikasi**
    Jalankan server development di dua terminal terpisah:
    ```bash
    # Terminal 1
    npm run dev

    # Terminal 2
    php artisan serve
    ```
    Akses aplikasi di `http://localhost:8000`.

---

## 🔐 Kredensial Login

Gunakan akun yang telah dikonfigurasi untuk menguji berbagai role.

| Role | Email | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **👑 Admin** | `admin@ex.com` | `12345678` | Akses dasbor, Manajemen produk, Pengawasan pesanan. |
| **👤 User** | `user@ex.com` | `12345678` | Jelajahi produk, Tambah ke keranjang, Buat pesanan. |

---

## 🗄️ Struktur Database

Data aplikasi diorganisir dalam tabel-tabel inti berikut:

### 👤 `users`
| Kolom | Tipe | Deskripsi |
| :--- | :--- | :--- |
| `id` | PK | Unique identifier |
| `name` | String | Nama lengkap pengguna |
| `email` | String | Alamat email unik |
| `email_verified_at` | Timestamp | Timestamp verifikasi email (Nullable) |
| `password` | String | Password ter-hash |
| `role` | String | `admin` atau `user` (Default: `user`) |
| `remember_token` | String | Token "Remember me" |
| `created_at` | Timestamp | Timestamp pembuatan |
| `updated_at` | Timestamp | Timestamp update terakhir |

### 🏷️ `categories`
| Kolom | Tipe | Deskripsi |
| :--- | :--- | :--- |
| `id` | PK | Unique identifier |
| `name` | String | Nama kategori |
| `slug` | String | Nama ramah URL (Unique) |
| `description` | Text | Deskripsi kategori (Nullable) |
| `created_at` | Timestamp | Timestamp pembuatan |
| `updated_at` | Timestamp | Timestamp update terakhir |

### 📦 `products`
| Kolom | Tipe | Deskripsi |
| :--- | :--- | :--- |
| `id` | PK | Unique identifier |
| `category_id` | FK | Kategori terhubung |
| `name` | String | Nama produk |
| `slug` | String | Nama ramah URL (Unique) |
| `description` | Text | Deskripsi produk |
| `price` | BigInt | Harga dalam Rupiah (Unsigned) |
| `stock` | Integer | Jumlah tersedia (Default: 0) |
| `rating` | Decimal | Rating produk (3,2) (Default: 0.00) |
| `sold_count` | Integer | Jumlah unit terjual (Default: 0) |
| `image` | String | Path ke gambar produk (Nullable) |
| `specifications` | JSON | Spesifikasi teknis (CPU, RAM, dll.) |
| `created_at` | Timestamp | Timestamp pembuatan |
| `updated_at` | Timestamp | Timestamp update terakhir |

### 🧾 `orders`
| Kolom | Tipe | Deskripsi |
| :--- | :--- | :--- |
| `id` | PK | Unique identifier |
| `user_id` | FK | Pelanggan |
| `total_price` | BigInt | Total keseluruhan (Unsigned) |
| `status` | String | `pending`, `processing`, `completed`, `cancelled` |
| `payment_status`| String | `unpaid`, `paid` |
| `payment_method`| String | Metode pembayaran yang digunakan (Nullable) |
| `shipping_address`| Text | Alamat pengiriman lengkap |
| `created_at` | Timestamp | Timestamp pembuatan |
| `updated_at` | Timestamp | Timestamp update terakhir |

### 🛒 `order_items`
| Kolom | Tipe | Deskripsi |
| :--- | :--- | :--- |
| `id` | PK | Unique identifier |
| `order_id` | FK | Pesanan terhubung |
| `product_id` | FK | Produk terhubung |
| `quantity` | Integer | Jumlah yang dibeli |
| `price` | BigInt | Harga saat pembelian (Unsigned) |
| `created_at` | Timestamp | Timestamp pembuatan |
| `updated_at` | Timestamp | Timestamp update terakhir |

---

## 🛠️ Tech Stack

*   **Framework:** [Laravel 12](https://laravel.com)
*   **Styling:** [TailwindCSS](https://tailwindcss.com)
*   **Templating:** Blade
*   **Database:** MySQL