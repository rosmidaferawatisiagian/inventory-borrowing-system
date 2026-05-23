# Inventory Borrowing System

Sistem peminjaman barang inventaris laboratorium D3 Teknologi Komputer.
Berbasis PHP + MySQL/MariaDB dengan dashboard modern (Bootstrap 4 + custom styling).

## Tech Stack
- **PHP** 7.4+ / 8.x
- **MariaDB** 10.4+ atau **MySQL** 5.7+
- **Bootstrap** 4.1.3 + Font Awesome 4.7

---

## Cara Menjalankan

Ada dua cara — pilih salah satu.

### Opsi A: PHP Built-in Server (paling cepat, tanpa Apache)

Cocok kalau kamu cuma mau jalankan project tanpa setup Apache/IIS.

1. **Pastikan MySQL/MariaDB jalan** di port `3306` dengan user `root` tanpa password
   (default XAMPP). Kalau pakai XAMPP, start lewat XAMPP Control Panel.

2. **Import database**:
   ```bash
   mysql -u root pa_1 < database/pa_1.sql
   ```
   Atau via phpMyAdmin: buat database `pa_1`, lalu import `database/pa_1.sql`.

3. **Cek `config.php`** — sudah diset ke `localhost`, user `root`, password kosong, db `pa_1`.
   Ubah kalau setup MySQL kamu beda.

4. **Jalankan PHP server** dari folder project:
   ```bash
   php -S localhost:8000
   ```

5. **Buka browser**: <http://localhost:8000/>

### Opsi B: XAMPP / Apache

1. Copy folder project ini ke `C:\xampp\htdocs\inventaris\` (atau nama folder bebas).
2. Start **Apache** & **MySQL** dari XAMPP Control Panel.
3. Import `database/pa_1.sql` ke database `pa_1` lewat phpMyAdmin.
4. Buka browser: <http://localhost/inventaris/>

> ⚠️ Kalau muncul error **IIS 10.0 Not Found** saat buka `localhost`,
> berarti port 80 dipakai IIS, bukan Apache. Matikan IIS dulu lewat
> `Services` (`W3SVC` / `World Wide Web Publishing Service`) atau ganti
> port Apache di `httpd.conf`.

---

## Login Default
| Role  | Username | Password |
|-------|----------|----------|
| Admin | `admin`  | `admin`  |

User biasa: daftar dulu lewat halaman **Register**.

---

## Struktur Halaman
- `index.php` — dashboard utama (katalog barang + stats + search)
- `login.php` / `register.php` — autentikasi
- `proses-pinjam.php` — form ajuan peminjaman
- `barang-dipinjam.php` — daftar barang yang sedang dipinjam user
- `barang-dikembalikan.php` — riwayat pengembalian
- `pemberitahuan.php` — notifikasi user
- `admin/` — panel admin (kelola barang, request, transaksi)

---

## Troubleshooting

**Halaman 404 di `localhost/peminjamanbarangsekolah`**
URL lama dari README sebelumnya. Pakai URL sesuai opsi yang kamu jalankan
(`localhost:8000/` untuk Opsi A, atau `localhost/<nama-folder>/` untuk Opsi B).

**MySQL access denied**
Project ini default pakai root tanpa password (XAMPP MariaDB).
Kalau pakai MySQL Server resmi, edit `config.php` dan isi password.

**Port 3306 sudah dipakai service lain**
Stop MySQL Server bawaan Windows (`Stop-Service MySQL80`) sebelum start XAMPP,
atau jalankan XAMPP MariaDB di port lain dan sesuaikan `config.php`.
