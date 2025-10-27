# 👥 Aplikasi Manajemen Data Pekerja

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.35.1-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.4.13-777BB4?style=for-the-badge&logo=php&logoColor=white)
![AdminLTE](https://img.shields.io/badge/AdminLTE-3.2-3C8DBC?style=for-the-badge&logo=admin&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)

**Sistem manajemen data pekerja modern dengan antarmuka AdminLTE yang elegan dan responsif**

[Demo](#-preview) • [Fitur](#-fitur) • [Instalasi](#-instalasi) • [Dokumentasi](#-dokumentasi)

</div>

---

## 📋 Deskripsi

Aplikasi Manajemen Data Pekerja adalah sistem CRUD (Create, Read, Update, Delete) berbasis web yang dibangun menggunakan Laravel 12 dan AdminLTE 3. Aplikasi ini memudahkan pengelolaan informasi pekerja dengan antarmuka yang intuitif dan modern.

## ✨ Fitur

- 📝 **CRUD Lengkap** - Tambah, lihat, edit, dan hapus data pekerja
- 🎨 **AdminLTE Template** - Antarmuka admin yang modern dan responsif
- 📱 **Responsive Design** - Tampil sempurna di semua perangkat
- 🔍 **Pagination** - Navigasi data yang mudah
- 🎯 **User-Friendly** - Interface yang intuitif dan mudah digunakan
- ⚡ **Fast Performance** - Performa cepat dengan Laravel framework
- 🔐 **Secure** - Built-in security features dari Laravel

## 🖼️ Preview

### Dashboard
![Dashboard Preview](https://via.placeholder.com/800x400/3C8DBC/FFFFFF?text=Dashboard+Preview)

### Data Pekerja
![Data Pekerja Preview](https://via.placeholder.com/800x400/3C8DBC/FFFFFF?text=Data+Pekerja+Preview)

## 🛠️ Tech Stack

| Technology | Version | Description |
|-----------|---------|-------------|
| Laravel | 12.35.1 | PHP Framework |
| PHP | 8.4.13 | Programming Language |
| AdminLTE | 3.2 | Admin Template |
| Bootstrap | 4.6 | CSS Framework |
| Font Awesome | 6.4.0 | Icon Library |
| MySQL | 8.0+ | Database |

## 📦 Instalasi

### Prasyarat

Pastikan sistem Anda sudah terinstal:
- PHP >= 8.4
- Composer
- MySQL >= 8.0
- Node.js & NPM (opsional)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/Dialius/admin-laravel.git
   cd admin-laravel
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Copy Environment File**
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Konfigurasi Database**
   
   Edit file `.env` dan sesuaikan dengan konfigurasi database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=username_database
   DB_PASSWORD=password_database
   ```

6. **Jalankan Migration**
   ```bash
   php artisan migrate
   ```

7. **Seed Database (Opsional)**
   ```bash
   php artisan db:seed
   ```

8. **Jalankan Server Development**
   ```bash
   php artisan serve
   ```

9. **Akses Aplikasi**
   
   Buka browser dan akses: `http://127.0.0.1:8000`

## 🗂️ Struktur Project

```
admin-laravel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── PekerjaController.php
│   └── Models/
│       └── Pekerja.php
├── database/
│   └── migrations/
│       └── create_pekerja_table.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       └── pekerja/
│           ├── index.blade.php
│           ├── create.blade.php
│           ├── edit.blade.php
│           └── show.blade.php
├── routes/
│   └── web.php
└── public/
```

## 📚 Dokumentasi

### Model Pekerja

```php
// Struktur tabel pekerja
Schema::create('pekerja', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('email')->unique();
    $table->string('skill');
    $table->timestamps();
});
```

### Routes

| Method | URI | Action | Route Name |
|--------|-----|--------|------------|
| GET | /pekerja | index | pekerja.index |
| GET | /pekerja/create | create | pekerja.create |
| POST | /pekerja | store | pekerja.store |
| GET | /pekerja/{id} | show | pekerja.show |
| GET | /pekerja/{id}/edit | edit | pekerja.edit |
| PUT/PATCH | /pekerja/{id} | update | pekerja.update |
| DELETE | /pekerja/{id} | destroy | pekerja.destroy |

## 🚀 Penggunaan

### Menambah Data Pekerja

1. Klik tombol **"Tambah Pekerja"**
2. Isi form dengan data pekerja
3. Klik **"Simpan"**

### Mengedit Data Pekerja

1. Klik tombol **"Edit"** pada baris data yang ingin diubah
2. Update informasi yang diperlukan
3. Klik **"Update"**

### Menghapus Data Pekerja

1. Klik tombol **"Hapus"** pada baris data yang ingin dihapus
2. Konfirmasi penghapusan
3. Data akan terhapus permanent

## 🤝 Kontribusi

Kontribusi selalu diterima! Jika Anda ingin berkontribusi:

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan Anda (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 🐛 Bug Reports & Feature Requests

Jika Anda menemukan bug atau ingin request fitur baru, silakan buat [issue baru](https://github.com/Dialius/admin-laravel/issues).

## 📝 License

Project ini dilisensikan di bawah [MIT License](LICENSE).

## 👨‍💻 Author

**Dialius**

- GitHub: [@Dialius](https://github.com/Dialius)
- Repository: [admin-laravel](https://github.com/Dialius/admin-laravel)

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - Framework PHP terbaik
- [AdminLTE](https://adminlte.io) - Template admin yang elegan
- [Bootstrap](https://getbootstrap.com) - CSS framework
- [Font Awesome](https://fontawesome.com) - Icon library

---

<div align="center">

**⭐ Jangan lupa beri star jika project ini membantu Anda! ⭐**

Made with ❤️ by [Dialius](https://github.com/Dialius)

</div>