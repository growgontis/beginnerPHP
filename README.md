# beginnerPHP
# PHP v 8.1+

# 📚 Latihan PHP — Parser Log Akses Server & Pembersih Data Pelanggan

Program CLI untuk melakukan parsing data log server (memotong string, menyamarkan IP, menghitung error & durasi) serta melakukan pembersihan data teks pelanggan berformat CSV (cleaning nama dari gelar, standardisasi nomor telepon, dan formatting angka).

---

## 🎯 Tujuan Latihan

Latihan ini bertujuan untuk melatih:
* Penggunaan fungsi `explode()` untuk memecah string berdasarkan delimiter.
* Manipulasi string lanjutan menggunakan `substr()`, `strpos()`, dan `trim()`.
* Pencarian dan penggantian string menggunakan `str_replace()`, `str_contains()`, dan `str_starts_with()`.
* Analisis teks dan pencarian frekuensi kemunculan menggunakan `substr_count()`.
* Pembersihan data mentah (*Data Cleaning*) dari format CSV sederhana.
* Standardisasi format nomor telepon (awalan +62/62 menjadi 0).
* Formatting angka dan pembuatan laporan berbasis teks terformat (`printf`).

---

## 🧩 Materi yang Dicakup

| Materi               | Contoh                                      |
| -------------------- | ------------------------------------------- |
| Heredoc String       | `<<<LOG ... LOG;`                           |
| Memecah String       | `explode("|", $b)`                          |
| Posisi & Potong      | `strpos()`, `substr()`                      |
| Menggabungkan String | `implode(".", $oktet)`                      |
| Cek Karakter String  | `str_contains()`, `str_starts_with()`       |
| Hitung Kemunculan    | `substr_count()`                            |
| Penggantian Teks     | `str_replace()`                             |
| Kalkulasi & Statistik| `count()`, `array_sum()`, `array_unique()`  |
| Formatting Output    | `printf()`, `number_format()`               |

---

## 🔄 Alur Program

```text
Mulai
  ↓
[BAGIAN A - Parser Log Akses]
  ↓
Pecah Log Mentah per Baris (explode)
  ↓
Iterasi Setiap Baris Log:
  ├── Ambil & Pisahkan Waktu (Tanggal & Jam)
  ├── Ambil IP, Samarkan Oktet Terakhir (***)
  ├── Ambil Method & Endpoint Request
  ├── Ambil Status HTTP & Durasi Eksekusi
  └── Akumulasi Total Request, Error (4xx/5xx), & Cek Durasi Terlama
  ↓
Cetak Tabel Rekapitulasi Log & Statistik Rata-rata
  ↓
Uji Analisis Teks Tambahan (str_contains, substr_count, dll)
  ↓
[BAGIAN B - Pembersih Data Pelanggan]
  ↓
Pecah Data CSV Pelanggan per Baris
  ↓
Iterasi Setiap Baris Data Pelanggan:
  ├── Pisahkan Atribut (Nama, Telepon, Email, Total Belanja)
  ├── Bersihkan Nama dari Berbagai Gelar (dr., H., S.Kom, dll)
  ├── Standardisasi Format Telepon (+62 / 62 → 0)
  └── Format Nominal Uang & Cetak Baris Tabel
  ↓
Cetak Total Keseluruhan Belanja
  ↓
  Selesai
```

---

## 🧠 Konsep Pemrograman yang Dilatih

### 1. Parser Log & Penyamaran IP (Data Anonymization)
Memecah baris log menggunakan delimiter `|` dan memodifikasi oktet IP terakhir untuk menjaga privasi.
```php
$oktet = explode(".", $ip);
$oktet[3] = "***";
$ip_aman = implode(".", $oktet);
```

### 2. Analisis Kode Status & Durasi Maksimum
Mendeteksi error HTTP (status 4xx/5xx) serta mencari request endpoint yang paling lambat diproses.
```php
if (strpos($status, "5") === 0 || strpos($status, "4") === 0) $error++;
if ($paling_lambat["durasi"] < (float)$durasi) {
    $paling_lambat = ["endpoint" => $endpoint, "durasi" => (float)$durasi];
}
```

### 3. String Function untuk Analisis Teks
Menggunakan fungsi built-in PHP untuk memeriksa keberadaan string, menghitung frekuensi, dan posisi awal.
```php
str_contains($log_mentah, "/checkout");
substr_count($log_mentah, "/produk");
str_starts_with($log_mentah, "2026");
```

### 4. Membersihkan Gelar pada Nama Pelanggan
Melakukan *looping* array gelar untuk menghapus atribut akademik atau kehormatan dari string nama secara bersih.
```php
foreach ($gelar as $g) {
    $nama = trim(str_replace($g, "", $nama));
}
```

### 5. Standardisasi Nomor Telepon Internasional
Mengonversi awalan nomor telepon dari kode negara (`+62` atau `62`) menjadi format lokal (`0`).
```php
if (str_starts_with($telepon, "+62")) {
    $telepon = "0" . substr($telepon, 3);
} elseif (str_starts_with($telepon, "62")) {
    $telepon = "0" . substr($telepon, 2);
}
```

---

## 📈 Tingkat Materi

**Level: Intermediate**

```text
String Manipulation & Delimiter
      ↓
Sub-string & Position Extraction
      ↓
Data Anonymization & Masking
      ↓
String Search & Validation Functions
      ↓
CSV Cleaning & Normalization Pipeline
      ↓
Formatted CLI Reports
```

Latihan ini memperdalam pemahaman **pengolahan dan pembersihan data string (*string manipulation & cleaning*)** yang sangat krusial dalam pengembangan backend, pemrosesan log sistem (*log auditing*), dan normalisasi data dari input pengguna atau file eksternal.