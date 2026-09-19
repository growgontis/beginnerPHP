# beginnerPHP
# PHP v 8.1+

# 📱 Latihan PHP — Buku Kontak CLI

Program CLI sederhana yang mensimulasikan aplikasi buku kontak. Program memungkinkan pengguna untuk menampilkan seluruh kontak, menambahkan kontak baru, mencari kontak berdasarkan nama, dan menghapus kontak dari daftar.

---

## 🎯 Tujuan Latihan

Latihan ini bertujuan untuk melatih:

* Penggunaan associative dan nested array.
* Membuat dan menggunakan function.
* Penggunaan parameter dan reference dengan `&`.
* Pemahaman scope variable.
* Penggunaan `global`.
* Validasi input CLI.
* Penggunaan `readline()`.
* Penggunaan perulangan dan percabangan.
* Penggunaan `switch`.
* Penggunaan `break` dan `continue`.
* Manipulasi array menggunakan `unset()`.
* Pencarian data menggunakan `strpos()`.
* Manipulasi string menggunakan `trim()`, `strtolower()`, dan `str_starts_with()`.
* Validasi angka menggunakan `is_numeric()`.
* Penggunaan `empty()`.
* Pengelolaan data sederhana menggunakan array.

---

## 🧩 Materi yang Dicakup

| Materi             | Contoh                         |
| ------------------ | ------------------------------ |
| Associative Array  | `$kontak["budi"]`              |
| Nested Array       | `["nomor", "kategori"]`        |
| Input CLI          | `readline()`                   |
| String             | `trim()`, `strtolower()`       |
| String searching   | `strpos()`                     |
| String validation  | `str_starts_with()`            |
| Number validation  | `is_numeric()`                 |
| Array              | `empty()`, `unset()`           |
| Percabangan        | `if`, `elseif`, `else`         |
| Switch             | `switch`, `case`, `default`    |
| Perulangan         | `while`, `foreach`             |
| Kontrol loop       | `break`, `continue`, `break 2` |
| Function           | `tampilKontak()`               |
| Parameter          | `$kontak`                      |
| Reference          | `&$kontak`                     |
| Global Variable    | `global $kontak`               |
| Operator           | `=`, `+=`, `!==`               |
| Array Manipulation | `unset($kontak[$nama])`        |

---

## 🔄 Alur Program

```text
Mulai
  ↓
Inisialisasi array kontak
  ↓
Tampilkan menu
  ↓
Input pilihan menu
  ↓
Input berupa angka?
  ├── Tidak → Tampilkan pesan error
  │            ↓
  │         Kembali ke menu
  │
  └── Ya
       ↓
    Proses pilihan menu
       │
       ├── 1 → Tampilkan semua kontak
       │          ↓
       │       Kembali ke menu
       │
       ├── 2 → Tambah kontak baru
       │          ↓
       │       Input nama
       │          ↓
       │       Validasi nomor
       │          ↓
       │       Input kategori
       │          ↓
       │       Simpan kontak
       │          ↓
       │       Kembali ke menu
       │
       ├── 3 → Cari kontak
       │          ↓
       │       Input nama
       │          ↓
       │       Cari menggunakan strpos()
       │          ↓
       │       Tampilkan hasil
       │          ↓
       │       Kembali ke menu
       │
       ├── 4 → Keluar
       │          ↓
       │       Selesai
       │
       └── 5 → Hapus kontak
                  ↓
              Input nama
                  ↓
              Cari kontak
                  ↓
              Hapus menggunakan unset()
                  ↓
              Kembali ke menu

```

---

## 🧠 Konsep Pemrograman yang Dilatih

### 1. Input & Validasi

Program menerima input pilihan menu menggunakan:

```php
$input = trim(readline());
```

Kemudian memvalidasi apakah input berupa angka:

```php
if (!is_numeric($input)) {
    echo "Input harus berupa angka";
    continue;
}
```

### 2. Associative & Nested Array

Data kontak disimpan menggunakan associative array dengan nested array:

```php
$kontak[$nama] = [
    "nomor" => $nomor,
    "kategori" => $kategori
];
```

Nama digunakan sebagai key, sedangkan nomor dan kategori disimpan sebagai data di dalamnya.

### 3. Function

Program membagi setiap fitur menjadi beberapa function:

```php
tampilKontak();
tambahKontak();
cariKontak();
hapusKontak();
```

Setiap function memiliki tugas yang berbeda untuk membuat program lebih terstruktur.

### 4. Reference

Function `tambahKontak()` menggunakan reference:

```php
function tambahKontak(&$kontak): void
```

Reference memungkinkan function memodifikasi array `$kontak` secara langsung sehingga perubahan tetap tersimpan setelah function selesai.

### 5. Scope Variable

Program memperkenalkan penggunaan `global` untuk mengakses variable yang berada di luar function:

```php
function tampilKontak(): void {
    global $kontak;
}
```

Konsep ini digunakan untuk memahami perbedaan scope variable di dalam dan di luar function.

### 6. String Manipulation

Program menggunakan beberapa function untuk mengolah input:

```php
trim()
strtolower()
str_starts_with()
```

`trim()` digunakan untuk menghapus spasi di awal dan akhir input, `strtolower()` untuk mengubah teks menjadi huruf kecil, dan `str_starts_with()` untuk memeriksa awalan nomor telepon.

### 7. Searching Data

Pencarian kontak menggunakan:

```php
strpos(strtolower($nama), $nama_input) !== false
```

Pengecekan menggunakan `!== false` karena `strpos()` dapat menghasilkan `0` ketika teks ditemukan di posisi awal string.

### 8. Manipulasi Data

Kontak dapat dihapus menggunakan:

```php
unset($kontak[$nama]);
```

Program mencari kontak berdasarkan nama terlebih dahulu, kemudian menghapus data yang ditemukan dari array.

### 9. Kontrol Perulangan

`continue` digunakan untuk mengulang proses ketika input tidak valid:

```php
continue;
```

Sedangkan `break` digunakan untuk menghentikan perulangan ketika kondisi yang diinginkan telah terpenuhi:

```php
break;
```

Program juga menggunakan:

```php
break 2;
```

untuk keluar dari `switch` sekaligus perulangan `while`.

---

## 📈 Tingkat Materi

**Level: Beginner → Intermediate Awal**

```text
PHP Fundamental
      ↓
Associative & Nested Array
      ↓
Input CLI
      ↓
Validasi Input
      ↓
Loop & Switch
      ↓
Function
      ↓
Parameter & Reference
      ↓
Scope Variable
      ↓
String Manipulation
      ↓
Searching Data
      ↓
Array Manipulation
```

Latihan ini merupakan pengembangan dari latihan PHP fundamental karena mulai menggabungkan **CLI input, manipulasi array, function, reference, scope variable, validasi data, pencarian string, dan penghapusan data** dalam sebuah aplikasi sederhana.

