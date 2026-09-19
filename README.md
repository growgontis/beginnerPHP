# beginnerPHP
# PHP v 8.1+

# 📝 Latihan PHP — Validasi Data Peserta

Program CLI sederhana yang mensimulasikan proses pendaftaran peserta workshop. Program membersihkan dan mengonversi data formulir ke tipe data yang sesuai, memvalidasi data peserta, menghitung status pembayaran, kemudian menampilkan kartu peserta beserta informasi kuota.

---

## 🎯 Tujuan Latihan

Latihan ini bertujuan untuk melatih:

* Penggunaan associative array.
* Penggunaan constant dengan `define()` dan `const`.
* Pembersihan data menggunakan `trim()`.
* Konversi tipe data menggunakan type casting.
* Penggunaan `filter_var()`.
* Pengecekan tipe data menggunakan `gettype()`.
* Pengecekan tipe data menggunakan `is_string()`, `is_int()`, `is_float()`, `is_bool()`, dan `is_null()`.
* Validasi email menggunakan `FILTER_VALIDATE_EMAIL`.
* Validasi integer menggunakan `FILTER_VALIDATE_INT`.
* Validasi boolean menggunakan `FILTER_VALIDATE_BOOLEAN`.
* Validasi string menggunakan `str_starts_with()`.
* Penggunaan `null`.
* Penggunaan array untuk menampung error.
* Penggunaan perulangan `foreach`.
* Penggunaan percabangan `if`, `elseif`, dan `else`.
* Penggunaan operator perbandingan dan logika.
* Perhitungan selisih pembayaran.
* Penggunaan `abs()`.
* Formatting angka menggunakan `number_format()`.
* Formatting output menggunakan `printf()`.
* Manipulasi string menggunakan `str_repeat()`, `str_pad()`, dan `strtoupper()`.
* Penggunaan ternary operator.

---

## 🧩 Materi yang Dicakup

| Materi            | Contoh                                   |
| ----------------- | ---------------------------------------- |
| Associative Array | `$form["nama"]`                          |
| Constant          | `define("NAMA_EVENT", "...")`            |
| Constant          | `const TAHUN = 2026`                     |
| String            | `trim()`, `ucwords()`, `strtoupper()`    |
| Type Casting      | `(int)`, `(float)`                       |
| Type Validation   | `gettype()`                              |
| Type Checking     | `is_string()`, `is_int()`, `is_float()`  |
| Null Checking     | `is_null()`                              |
| Filter            | `filter_var()`                           |
| Filter Constant   | `FILTER_VALIDATE_INT`                    |
| Filter Constant   | `FILTER_VALIDATE_EMAIL`                  |
| Filter Constant   | `FILTER_VALIDATE_BOOLEAN`                |
| String Validation | `str_starts_with()`                      |
| Array             | `[]`, `count()`                          |
| Perulangan        | `foreach`                                |
| Percabangan       | `if`, `elseif`, `else`                   |
| Operator          | `>`, `<`, `===`, `!==`, `<=`, `&&`       |
| Absolute Value    | `abs()`                                  |
| Number Formatting | `number_format()`                        |
| Output Formatting | `printf()`                               |
| String Repetition | `str_repeat()`                           |
| String Padding    | `str_pad()`                              |
| Ternary Operator  | `kondisi ? nilai1 : nilai2`              |
| Variable Type     | `string`, `int`, `float`, `bool`, `null` |

---

## 🔄 Alur Program

```text
Mulai
  ↓
Inisialisasi data formulir
  ↓
Buat constant
  ↓
Bersihkan & konversi data
  ↓
Tampilkan data dan tipe data
  ↓
Cek tipe data
  ↓
Validasi data peserta
  ↓
Ada error?
  ├── Ya → Tampilkan daftar error
  │
  └── Tidak → Tampilkan data valid
        ↓
    Hitung selisih pembayaran
        ↓
    Tentukan status pembayaran
        ↓
    Tentukan status lunas
        ↓
    Buat kartu peserta
        ↓
    Hitung sisa kuota
        ↓
      Selesai

```

---

## 🧠 Konsep Pemrograman yang Dilatih

### 1. Associative Array

Data formulir disimpan menggunakan associative array:

```php
$form = [
    "nama"    => "  budi SANTOSO  ",
    "umur"    => "25",
    "email"   => "budi@example.com",
    "telepon" => "081234567890",
    "bayar"   => "150000.5",
    "setuju"  => "true",
];
```

Setiap data memiliki key yang digunakan untuk mengambil nilai:

```php
$form["nama"];
$form["umur"];
$form["email"];
```

### 2. Constant

Program menggunakan dua cara untuk membuat constant:

```php
define("NAMA_EVENT", "Workshop PHP Fundamental");
define("BIAYA_DASAR", 150000);

const TAHUN = 2026;
const KUOTA = 40;
```

Constant digunakan untuk menyimpan nilai yang tidak berubah selama program berjalan, seperti nama event, biaya dasar, tahun, dan kuota peserta.

### 3. Pembersihan & Konversi Data

Data dari formulir awalnya berbentuk string sehingga perlu dibersihkan dan dikonversi:

```php
$nama = ucwords(trim($form["nama"]));
$umur = (int)$form["umur"];
$telepon = trim($form["telepon"]);
$bayar = (float)$form["bayar"];
```

Program juga mengubah string `"true"` menjadi boolean menggunakan:

```php
$setuju = filter_var(
    $form["setuju"],
    FILTER_VALIDATE_BOOLEAN
);
```

### 4. Pengecekan Tipe Data

Program menggunakan `gettype()` untuk mengetahui tipe data setiap variable:

```php
gettype($nama);
gettype($umur);
gettype($bayar);
gettype($setuju);
```

Program juga menggunakan function khusus untuk memeriksa tipe data:

```php
is_string($nama);
is_int($umur);
is_float($bayar);
is_bool($setuju);
is_null($catatan);
```

### 5. Validasi Data

Program melakukan beberapa validasi terhadap data peserta:

```text
Nama tidak kosong
      ↓
Umur berupa integer
      ↓
Umur minimal 17 tahun
      ↓
Email valid
      ↓
Nomor telepon diawali 08
      ↓
Peserta menyetujui syarat
```

Error yang ditemukan disimpan ke dalam array:

```php
$error = [];

if ($nama === "") {
    $error[] = "Nama tidak boleh kosong";
}
```

Dengan cara ini, beberapa error dapat dikumpulkan sebelum ditampilkan.

### 6. Array Error

Array `$error` digunakan untuk menyimpan seluruh kesalahan validasi:

```php
$error[] = "Nama tidak boleh kosong";
$error[] = "Email tidak valid";
```

Kemudian seluruh error ditampilkan menggunakan `foreach`:

```php
foreach ($error as $i => $e) {
    echo "[" . $i + 1 . "] " . $e;
}
```

### 7. Perhitungan Pembayaran

Program menghitung selisih antara biaya dasar dan jumlah pembayaran:

```php
$selisih = BIAYA_DASAR - $bayar;
```

Hasilnya digunakan untuk menentukan apakah pembayaran:

```text
Selisih > 0
    ↓
KURANG

Selisih < 0
    ↓
LEBIH

Selisih = 0
    ↓
PAS
```

### 8. Operator Perbandingan

Program menggunakan operator perbandingan untuk menentukan kondisi:

```php
$selisih > 0
$selisih < 0
$selisih <= 0
```

Status lunas ditentukan dengan:

```php
$lunas = ($selisih <= 0);
```

### 9. Formatting Angka

Nilai pembayaran diformat menggunakan:

```php
number_format($bayar, 2, ',', '.');
```

Formatting tersebut digunakan agar angka lebih mudah dibaca dalam format mata uang:

```text
150000.50
      ↓
150.000,50
```

### 10. Formatting Output

`printf()` digunakan untuk membuat tampilan data lebih terstruktur:

```php
printf("%-13s : %s\n", "Nama", $nama);
```

Placeholder seperti `%s` dan `%d` digunakan untuk memasukkan nilai ke dalam format output.

### 11. Manipulasi String

Program menggunakan beberapa function untuk membentuk kartu peserta:

```php
str_repeat()
str_pad()
strtoupper()
```

`str_repeat()` digunakan untuk membuat garis:

```php
str_repeat("=", $lebar);
```

`str_pad()` digunakan untuk membuat teks berada di tengah atau memiliki panjang tertentu:

```php
str_pad($text, $lebar, " ", STR_PAD_BOTH);
```

`strtoupper()` digunakan untuk mengubah nama event menjadi huruf kapital.

### 12. Ternary Operator

Program menggunakan ternary operator untuk menentukan email yang ditampilkan:

```php
$email !== false ? $email : "-"
```

Ternary operator juga digunakan untuk menentukan status verifikasi:

```php
($lunas && count($error) === 0) ? "YA" : "BELUM"
```

---

## 📈 Tingkat Materi

**Level: Beginner → Intermediate Awal**

```text
PHP Fundamental
      ↓
Associative Array
      ↓
Constant
      ↓
String Manipulation
      ↓
Type Casting
      ↓
Type Checking
      ↓
filter_var()
      ↓
Data Validation
      ↓
Array Error Handling
      ↓
Conditional Logic
      ↓
Data Processing
      ↓
Number Formatting
      ↓
Output Formatting
```

Latihan ini merupakan pengembangan dari latihan PHP fundamental karena mulai menggabungkan **constant, konversi tipe data, pengecekan tipe, validasi menggunakan `filter_var()`, pengumpulan error, perhitungan pembayaran, manipulasi string, dan formatting output** dalam sebuah simulasi proses pendaftaran peserta.
