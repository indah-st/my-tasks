# Task Management System / My Tasks

## Panduan Penggunaan (only user)

### 1. Instalasi Aplikasi

Ikuti langkah-langkah berikut untuk menginstal aplikasi Task Management System:

1. **Clone repository**
   ```sh
   git clone https://github.com/indah-st/my-tasks.git
   ```
2. **Masuk ke direktori proyek**
   ```sh
   cd my-tasks
   ```
3. **Install dependensi dengan Composer**
   ```sh
   composer install
   ```
4. **Buat file `.env` dari template**
   ```sh
   cp .env.example .env
   ```
5. **Atur konfigurasi database** di file `.env`, lalu jalankan perintah berikut:
   ```sh
   php artisan migrate
   ```
6. **Jalankan server lokal**
   ```sh
   php artisan serve
   ```

### 2. Cara Menggunakan Aplikasi

#### a. Login
1. Akses halaman login di `http://localhost:8000/user/login`.
2. Masukkan email dan password yang sudah terdaftar.
3. Klik tombol **Login** untuk masuk ke dashboard.

#### b. Menambah Tugas
1. Masuk ke halaman **Dashboard** setelah login.
2. Klik tombol **Add task**.
3. Isi form tugas dengan:
   - **Title**
   - **Description**
   - **Due date**
   - **Image**
4. Klik **Simpan** untuk menambahkan tugas baru.

#### c. Melihat Riwayat Tugas
1. Masuk ke menu **Task history**.
2. Halaman akan menampilkan daftar tugas yang sudah selesai.

#### d. Menyelesaikan dan Menghapus Tugas
1. Pilih tugas yang telah selesai.
2. Klik tombol **Finish** untuk menandai tugas sebagai selesai.
3. Jika ingin menghapus tugas secara permanen, masuk ke halaman **Task history**.
4. Pilih tugas yang ingin dihapus permanen dan klik **Hapus Permanen**.

### 3. Struktur Direktori Penting

- **Controller**: `app/Http/Controllers/TaskHistoryController.php`
- **Migration**: 
  - `database/migrations/add_deleted_to_task_table.php`
  - `database/migrations/create_tasks_history_table.php`
  - `database/migrations/create_personal_access_token_table.php`
- **View**:
  - `resources/views/user/history.blade.php`
  - `resources/views/user/login.blade.php`

### 4. Nama database My Tasks
- **tasks**
