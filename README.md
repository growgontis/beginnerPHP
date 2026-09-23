# beginnerPHP

# PHP v 8.1+

# 📚 Latihan PHP — Simulasi Unduhan & Scope

Program CLI sederhana yang mensimulasikan proses unduhan file/materi dengan batas kuota per sesi. Program mencatat aktivitas unduhan, menghitung total unduhan berhasil, serta mendemonstrasikan konsep `global`, `static`, local scope, superglobal, object `stdClass`, dan reference counting pada PHP.

---

## 🎯 Tujuan Latihan

Latihan ini bertujuan untuk melatih:

* Penggunaan variable dan tipe data.
* Penggunaan array untuk menyimpan data.
* Pembuatan dan penggunaan function.
* Penggunaan parameter dan return type.
* Pemahaman **local scope** dan **global scope**.
* Penggunaan keyword `global`.
* Penggunaan keyword `static` pada function.
* Penggunaan `foreach` dan `for`.
* Penggunaan kondisi untuk membatasi proses.
* Pencatatan aktivitas menggunakan array.
* Formatting output menggunakan `str_pad()`.
* Penggunaan `PHP_EOL`.
* Penggunaan superglobal `$_SERVER`.
* Mendeteksi mode eksekusi CLI atau Web menggunakan `PHP_SAPI`.
* Memahami object sederhana menggunakan `stdClass`.
* Memahami reference counting pada object PHP.
* Memahami penggunaan `unset()` untuk menghapus reference variable.

---

## 🧩 Materi yang Dicakup

| Materi             | Contoh                                 |
| ------------------ | -------------------------------------- |
| Variable           | `$log_aktivitas`, `$total_unduhan`     |
| Array              | `$daftar_unduh`, `$log_aktivitas`      |
| Associative array  | `$sesi->id`, `$sesi->user`             |
| Function           | `catatLog()`, `unduh()`, `resetSesi()` |
| Parameter          | `unduh(string $judul)`                 |
| Return type        | `:void`, `:string`, `:int`             |
| Global scope       | `$log_aktivitas`, `$total_unduhan`     |
| Local scope        | `$variabel_lokal`                      |
| `global`           | `global $log_aktivitas`                |
| `static`           | `static $kuota = 3`                    |
| Conditional        | `if ($kuota == 0)`                     |
| Perulangan         | `foreach`, `for`                       |
| Kontrol data       | `$kuota--`, `$total_unduhan++`         |
| Built-in function  | `count()`, `isset()`, `basename()`     |
| Formatting         | `str_pad()`                            |
| String             | Interpolasi string dan concatenation   |
| Konstanta bawaan   | `PHP_EOL`, `__FILE__`                  |
| Superglobal        | `$_SERVER`                             |
| SAPI               | `PHP_SAPI`                             |
| Object             | `new stdClass()`                       |
| Object property    | `$sesi->id`, `$sesi->user`             |
| Reference counting | `$backup = $sesi`                      |
| Menghapus variable | `unset()`                              |

---

## 🔄 Alur Program

```text
Mulai

  ↓

Inisialisasi log aktivitas
dan total unduhan

  ↓

Inisialisasi daftar materi

  ↓

Panggil unduh("Pemrograman PHP Dasar")

  ↓

Cek kuota

  ├── Kuota habis → Tolak unduhan
  │
  └── Kuota tersedia
          ↓
      Kurangi kuota
          ↓
      Tambah total unduhan
          ↓
      Catat log
          ↓
      Berhasil

  ↓

Ulangi proses unduhan
untuk beberapa materi

  ↓

Unduhan ke-4

  ↓

Kuota habis?

  └── Ya → Tolak unduhan

  ↓

Tampilkan log aktivitas

  ↓

Tampilkan total unduhan berhasil

  ↓

Panggil resetSesi()

  ↓

Reset log dan total unduhan

  ↓

Tampilkan kondisi setelah reset

  ↓

Panggil unduh() kembali

  ↓

Buktikan kuota static
tidak ikut ter-reset

  ↓

Eksperimen Scope

  ↓

Eksperimen Static vs Variable Biasa

  ↓

Tampilkan informasi eksekusi
melalui $_SERVER dan PHP_SAPI

  ↓

Eksperimen Reference Counting
menggunakan stdClass

  ↓

Selesai
```

---

## 🧠 Konsep Pemrograman yang Dilatih

### 1. Function

Program menggunakan beberapa function untuk memisahkan tugas.

```php
function catatLog(string $pesan): void
{
    ...
}
```

Function `catatLog()` bertugas menyimpan pesan aktivitas ke dalam `$log_aktivitas`.

Function lain:

```php
function unduh(string $judul): string
{
    ...
}
```

digunakan untuk melakukan simulasi proses unduhan.

---

### 2. Parameter & Return Type

Function `unduh()` menerima parameter:

```php
function unduh(string $judul): string
```

Artinya:

* `$judul` harus berupa `string`.
* Function harus mengembalikan `string`.

Sedangkan:

```php
function catatLog(string $pesan): void
```

memiliki return type `void`, yang berarti function tersebut tidak mengembalikan nilai.

---

### 3. Global Scope

Program memiliki variable yang dibuat di luar function:

```php
$log_aktivitas = [];
$total_unduhan = 0;
```

Variable tersebut berada pada **global scope**.

Secara normal, variable global tidak dapat langsung diakses dari dalam function.

Contohnya:

```php
function catatLog(string $pesan): void
{
    global $log_aktivitas;

    $log_aktivitas[] = $pesan;
}
```

Keyword `global` membuat function dapat mengakses variable `$log_aktivitas` yang berada di luar function.

---

### 4. Local Scope

Variable yang dibuat di dalam function memiliki local scope.

Contohnya:

```php
function cekScope(): void
{
    $variabel_lokal = "tes";

    echo $variabel_lokal;
}
```

Variable:

```php
$variabel_lokal
```

hanya tersedia di dalam function `cekScope()`.

Variable tersebut tidak dapat digunakan secara langsung di luar function.

---

### 5. Static Variable

Pada function `unduh()` terdapat:

```php
static $kuota = 3;
```

Berbeda dengan variable biasa, variable `static` **mempertahankan nilainya antar-pemanggilan function**.

Contohnya:

```php
function pakaiStatic(): int
{
    static $n = 0;
    $n++;

    return $n;
}
```

Jika dipanggil tiga kali:

```text
Panggilan pertama  → 1
Panggilan kedua    → 2
Panggilan ketiga   → 3
```

Sedangkan variable biasa:

```php
function pakaiBiasa(): int
{
    $n = 0;
    $n++;

    return $n;
}
```

akan selalu menghasilkan:

```text
Panggilan pertama  → 1
Panggilan kedua    → 1
Panggilan ketiga   → 1
```

Karena `$n` dibuat kembali setiap function dipanggil.

---

### 6. Static Tidak Ikut Ter-reset oleh `resetSesi()`

Function:

```php
function resetSesi(): void
{
    global $log_aktivitas, $total_unduhan;

    $log_aktivitas = [];
    $total_unduhan = 0;
}
```

mengosongkan:

```php
$log_aktivitas
```

dan:

```php
$total_unduhan
```

Tetapi tidak mengubah:

```php
static $kuota = 3;
```

yang berada di dalam function `unduh()`.

Karena itu setelah `resetSesi()`, kuota tetap melanjutkan nilai sebelumnya.

Ini menunjukkan perbedaan antara **variable global** dan **static local variable**.

---

### 7. Conditional / Decision

Function `unduh()` memeriksa apakah kuota masih tersedia:

```php
if ($kuota == 0) {
    catatLog("DITOLAK — kuota unduh sesi ini sudah habis");

    return "DITOLAK — kuota unduh sesi ini sudah habis" . PHP_EOL;
}
```

Jika kuota `0`, proses unduhan ditolak.

Jika kuota masih tersedia, program melanjutkan proses:

```php
$kuota--;
$total_unduhan++;
```

---

### 8. Storage Menggunakan Array

Aktivitas disimpan dalam:

```php
$log_aktivitas = [];
```

Kemudian function `catatLog()` menambahkan data:

```php
$log_aktivitas[] = $pesan;
```

Misalnya setelah beberapa aktivitas:

```text
[
    "BERHASIL — Pemrograman PHP Dasar diunduh",
    "BERHASIL — Algoritma dan Struktur Data diunduh",
    "DITOLAK — kuota unduh sesi ini sudah habis"
]
```

---

### 9. Iterasi Array

Log ditampilkan menggunakan `foreach`:

```php
foreach ($log_aktivitas as $i => $baris) {
    echo "  " . str_pad(
        (string)($i + 1),
        2,
        "0",
        STR_PAD_LEFT
    ) . ". $baris\n";
}
```

`$i` merupakan index array, sedangkan `$baris` berisi isi log.

`$i + 1` digunakan supaya nomor log dimulai dari `1`, bukan `0`.

---

### 10. Formatting dengan `str_pad()`

Bagian:

```php
str_pad((string)($i + 1), 2, "0", STR_PAD_LEFT)
```

digunakan untuk membuat nomor memiliki dua digit.

Contohnya:

```text
1  → 01
2  → 02
3  → 03
```

Sehingga output menjadi:

```text
01. BERHASIL — ...
02. BERHASIL — ...
03. BERHASIL — ...
```

---

### 11. Superglobal `$_SERVER`

Program juga mengambil informasi eksekusi melalui:

```php
$_SERVER['SCRIPT_FILENAME']
```

Contohnya:

```php
basename($_SERVER['SCRIPT_FILENAME'] ?? __FILE__)
```

digunakan untuk mendapatkan nama file script yang sedang dieksekusi.

`$_SERVER` merupakan salah satu **superglobal PHP**.

---

### 12. Mendeteksi CLI atau Web

Program menggunakan:

```php
PHP_SAPI === 'cli' ? 'CLI' : 'Web'
```

Jika program dijalankan melalui terminal:

```bash
php program.php
```

hasilnya:

```text
CLI
```

Jika dijalankan melalui web server, hasilnya:

```text
Web
```

---

### 13. Object dengan `stdClass`

Program membuat object sederhana:

```php
$sesi = new stdClass();
```

Kemudian menambahkan property:

```php
$sesi->id = "SES-2026-0091";
$sesi->user = "deni";
$sesi->mulai = "08:14:22";
```

`stdClass` adalah class kosong bawaan PHP yang dapat digunakan untuk membuat object sederhana tanpa mendefinisikan class sendiri.

---

### 14. Reference Counting

Kemudian dibuat:

```php
$backup = $sesi;
```

Ini tidak membuat object baru.

Kedua variable mengacu pada object yang sama:

```text
$sesi ─────┐
           ↓
        [ Object ]
           ↑
$backup ───┘
```

Karena itu:

```php
$backup->user = "deni_p";
```

juga menyebabkan:

```php
$sesi->user
```

berubah menjadi:

```text
deni_p
```

---

### 15. `unset()`

Program kemudian menghapus variable:

```php
unset($sesi);
```

Object masih dapat digunakan karena `$backup` masih mengacu pada object tersebut.

Setelah:

```php
unset($backup);
```

tidak ada lagi variable dari contoh tersebut yang mengacu pada object.

Konsep ini digunakan untuk menunjukkan bagaimana **reference counting** berkaitan dengan pengelolaan memory object PHP.

---

## 📊 Contoh Output

```text
=== SIMULASI UNDUHAN ===
BERHASIL — Pemrograman PHP Dasar diunduh (sisa kuota: 2)

BERHASIL — Algoritma dan Struktur Data diunduh (sisa kuota: 1)

BERHASIL — Basis Data Relasional diunduh (sisa kuota: 0)

DITOLAK — kuota unduh sesi ini sudah habis


=== LOG AKTIVITAS ===
  01. BERHASIL — Pemrograman PHP Dasar diunduh (sisa kuota: 2)
  02. BERHASIL — Algoritma dan Struktur Data diunduh (sisa kuota: 1)
  03. BERHASIL — Basis Data Relasional diunduh (sisa kuota: 0)
  04. DITOLAK — kuota unduh sesi ini sudah habis
  Total unduhan berhasil: 3
```

> Catatan: output aktual dapat berbeda pada bagian informasi eksekusi karena nama file dan environment PHP bergantung pada tempat program dijalankan.

---

## 📈 Tingkat Materi

**Level: Beginner → Intermediate Awal**

```text
PHP Fundamental

      ↓

Variable & Data Type

      ↓

Array

      ↓

Function

      ↓

Parameter & Return Type

      ↓

Scope

      ↓

global & static

      ↓

Control Flow

      ↓

Data Processing

      ↓

Object stdClass

      ↓

Superglobal

      ↓

Reference Counting

      ↓

Memory Management
```

Latihan ini memperluas fundamental PHP dari sekadar input dan pengolahan data menjadi pemahaman tentang **scope variable, lifetime variable, state function, object, superglobal, dan pengelolaan memory** dalam PHP.
