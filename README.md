# beginnerPHP
# PHP v 8.1+

# 📚 Latihan PHP — Sistem Perhitungan Tarif Parkir Berlapis

Program CLI sederhana yang mensimulasikan sistem perhitungan tarif parkir mall dengan berbagai aturan kondisional bersarang. Latihan ini fokus pada implementasi logika penagihan yang bertahap (jenis kendaraan, hari libur, status member, denda, hingga metode pembayaran).

---

## 🎯 Tujuan Latihan

Latihan ini bertujuan untuk melatih:

* Penggunaan *Control Flow* tingkat lanjut seperti `switch-case` (dengan fitur *fall-through*) dan `match` expression (PHP 8.0+).
* Logika perhitungan bertahap (*step-by-step mutation*) pada sebuah variabel tagihan.
* Penggunaan batas maksimum (*capping*) pada perhitungan matematis.
* Destrukturisasi array (*Array Destructuring*) untuk mengekstrak nilai dengan rapi.
* Penggunaan fungsi bawaan PHP untuk *formatting output* CLI agar terlihat seperti struk cetak yang rapi (`printf`, `str_pad`, `str_repeat`, `number_format`).
* Penanganan *error* dasar atau validasi (contoh: jam keluar lebih kecil dari jam masuk).

---

## 🧩 Materi yang Dicakup

| Materi               | Contoh                                      |
| -------------------- | ------------------------------------------- |
| Konstanta & Variable | `const MAXIMUM_HARIAN = 50000;`             |
| Iterasi Array        | `foreach($kendaraan as $i => $k)`           |
| Aritmatika & Logika  | `$lama_parkir = $keluar - $masuk;`, `/=`, `*=` |
| Kondisi Dasar        | `if ($lama_parkir > 1)`, `elseif`           |
| Switch Case          | `switch($hari) { case "Senin": ... }`       |
| Fall-through Switch  | Penumpukan `case` tanpa `break`             |
| Match Expression     | `$metode = match($k["metode"]) { ... }`     |
| Array Destructuring  | `[$nama_metode, $biaya_admin] = $metode;`   |
| String Repeat        | `str_repeat("=", 40)`                       |
| String Padding       | `str_pad($masuk, 2, "0", STR_PAD_LEFT)`     |
| Formatted Output     | `printf("%-18s: %s\n", "Plat", $plat);`     |
| Number Formatting    | `number_format($tagihan, 2, ",", ".")`      |
| Loop Control         | `break;` (menghentikan proses cetak struk)  |

---

## 🔄 Alur Program

```text
Mulai
  ↓
Definisi Konstanta Aturan Tarif
  ↓
Iterasi Data Kendaraan (foreach)
  ↓
Hitung Lama Parkir & Tarif Jam-jaman (Batas Max Rp50.000)
  ↓
Penyesuaian Tarif Berdasarkan Jenis (Motor /2, Truk *2)
  ↓
Pengecekan Hari (Switch Case)
  ├── Hari Kerja → Lanjut
  └── Hari Libur → Tambah Flat Rp2.000
        ↓
Pengecekan Member
  ├── Ya → Hitung dan potong diskon 20%
  └── Tidak → Lanjut
        ↓
Pengecekan Tiket Hilang
  ├── Ya → Tambah Denda Rp25.000
  └── Tidak → Lanjut
        ↓
Tentukan Metode Pembayaran (Match)
  └── Ambil Nama Metode & Ekstrak Biaya Admin (Destructuring)
        ↓
Tambahkan Biaya Admin ke Total
  ↓
Cetak Header Struk Parkir
  ↓
Validasi Jam Parkir
  ├── Keluar < Masuk → Cetak [ERROR], hentikan pencetakan struk ini
  └── Normal → Lanjut cetak detail biaya
        ↓
Cetak Total Tagihan
  ↓
Selesai Iterasi
```

---

## 🧠 Konsep Pemrograman yang Dilatih

Latihan ini sangat bagus untuk memahami pengolahan data bertahap dan *formatting* teks:

### 1. Step-by-Step State Mutation
Nilai variabel `$tagihan` tidak dihitung dalam satu rumus panjang, melainkan dimutasi (diubah) secara bertahap melewati berbagai tahapan logika (jam, jenis, hari, diskon, denda). Ini melatih cara berpikir prosedural yang rapi.

### 2. Switch dengan Fall-through
Memanfaatkan sifat bawaan `switch` di mana beberapa kondisi yang berurutan ("Senin" sampai "Jumat") akan mengeksekusi blok kode yang sama karena tidak diberi `break`.
```php
case "Senin":
case "Selasa":
// ...
case "Jumat":
    $kategori_hari = "Hari Kerja";
    break;
```

### 3. Match Expression & Destructuring
Menggunakan fitur modern PHP `match` yang jauh lebih ringkas dari `switch` untuk memberikan *return value*. Hasil *return* berupa `array` langsung dipecah (*destructuring*) ke dalam dua variabel berbeda.
```php
$metode = match($k["metode"]) {
    1 => ["Tunai", 0],
    2 => ["Kartu", 1500]
};
[$nama_metode, $biaya_admin] = $metode; // Array Destructuring
```

### 4. Output Formatting (CLI Receipt)
Membuat tampilan program terminal menjadi estetik layaknya struk kasir menggunakan fungsi manipulasi *string*:
*   `str_pad()`: Untuk memastikan jam selalu 2 digit (misal `08:00`), atau meratakan teks ke tengah.
*   `str_repeat()`: Menghasilkan garis pembatas `===========` tanpa mengetik manual.
*   `printf()`: Menyelaraskan posisi titik dua `:` dengan memanfaatkan modifier spasi (`%-18s`).

### 5. Loop Control & Error Handling
Menggunakan `break` pada validasi jam (`$keluar < $masuk`) agar jika terjadi error logika (*jam mundur*), program memotong proses pencetakan struk untuk kendaraan tersebut dan melompat ke akhir blok.

---

## 📈 Tingkat Materi

**Level: Intermediate Awal**

```text
Basic Syntax & Constants
      ↓
Array Iteration
      ↓
Complex Control Flow (if, switch, match)
      ↓
State Mutation & Calculation
      ↓
Array Destructuring
      ↓
String Formatting & CLI Output
```

Latihan ini melatih keterampilan simulasi *bussiness logic* / logika aturan bisnis yang sangat umum ditemui di dunia nyata (seperti kasir, e-commerce, atau sistem parkir) sekaligus mempercantik tampilan output di konsol.