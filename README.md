# beginnerPHP
# PHP v 8.1+

# 📚 Latihan PHP — Implementasi Operator Dasar & Logika Bitwise

Program CLI sederhana yang disimulasikan untuk melakukan perhitungan transaksi belanja menggunakan operator aritmatika/logika dasar, serta penerapan sistem manajemen hak akses (*Role-Based Access Control*) menggunakan operator *bitwise*.

---

## 🎯 Tujuan Latihan

Latihan ini bertujuan untuk melatih:

* Penggunaan konstanta dan operator aritmatika dasar.
* Penggunaan *ternary operator* berlapis untuk pengambilan keputusan yang lebih ringkas.
* Pemahaman *null coalescing assignment* (`??=`) dan *elvis operator* (`?:`).
* Perbedaan operator perbandingan *loose* (`==`) dan *strict* (`===`).
* Penggunaan *spaceship operator* (`<=>`) untuk perbandingan nilai dua arah.
* Manipulasi status atau hak akses tingkat rendah menggunakan operator *bitwise* (`|`, `&`, `^`, `~`, `<<`, `>>`).
* Penggunaan operator logika boolean (`&&`, `!`, `xor`).
* Perbedaan *pre-increment* dan *post-increment* pada suatu iterasi atau *counter*.

---

## 🧩 Materi yang Dicakup

| Materi               | Contoh                                      |
| -------------------- | ------------------------------------------- |
| Konstanta & Variable | `const PPN = 0.11;`, `$harga_satuan`        |
| Aritmatika           | `*`, `/`, `%`, `+`, `-`                     |
| Ternary Operator     | `($subtotal >= 500000) ? 15 : 0`            |
| Null Coalescing      | `??=`, `?:`                                 |
| Perbandingan Strict  | `==`, `===`, `!==`                          |
| Spaceship Operator   | `<=>`                                       |
| Assignment           | `+=`, `|=`, `&=`, `^=`                      |
| Bitwise OR (Beri)    | `$hak_budi \| HAK_TULIS`                    |
| Bitwise AND (Cek)    | `$hak_budi & HAK_HAPUS`                     |
| Bitwise NOT (Cabut)  | `& ~HAK_TULIS`                              |
| Bitwise XOR (Toggle) | `^= HAK_TULIS`                              |
| Bitwise Shift        | `<< 1`, `>> 1`                              |
| Logika Boolean       | `&&`, `!`, `xor`                            |
| Increment            | `$percobaan++`, `++$percobaan`             |
| Built-in function    | `number_format()`, `decbin()`, `str_pad()`  |

---

## 🔄 Alur Program

```text
Mulai
  ↓
[BAGIAN A - Transaksi Belanja]
  ↓
Hitung Subtotal
  ↓
Tentukan Diskon (Ternary Berjenjang)
  ↓
Hitung Ongkos Kirim & Modulo (Sisa Bagi)
  ↓
Validasi Kupon & Catatan (Null Coalescing / Elvis)
  ↓
Uji Perbandingan (==, ===, !==, <=>)
  ↓
Kalkulasi Total Akhir (Assignment +=)
  ↓
[BAGIAN B - Hak Akses Bitwise]
  ↓
Definisi Hak Akses (Konstanta Biner: 1, 2, 4, 8)
  ↓
Pemberian Hak Awal (Bitwise OR | )
  ↓
Pemeriksaan Hak (Bitwise AND & )
  ↓
Modifikasi Hak (Tambah, Cabut, Toggle)
  ↓
Uji Geser Bit (Shift Left / Right)
  ↓
Simulasi Keputusan Akses Gabungan (Logika &&, !)
  ↓
Uji Increment (Pre/Post)
  ↓
  Selesai
```

---

## 🧠 Konsep Pemrograman yang Dilatih

Latihan ini melatih implementasi operator pada dua simulasi kasus di dunia nyata:

### 1. Arithmetic & Ternary Operator
Menghitung subtotal dan persentase diskon secara efisien dalam satu baris, menggantikan struktur `if-else` yang panjang.
```php
$diskon = ($subtotal >= 500000) ? 15 : (($subtotal >= 300000) ? 10 : (($subtotal >= 100000) ? 5 : 0));
```

### 2. Elvis & Null Coalescing Assignment
Memberikan nilai *default* apabila variabel bernilai `null` atau *falsy*, sangat berguna untuk memproses input *form* yang opsional.
```php
$kupon ??= "TANPA-KUPON";
$catatan = $catatan_kirim ?: "(tidak ada catatan)";
```

### 3. Strict Comparison & Spaceship
Memastikan tipe data sama persis saat membandingkan (`===`), serta mendapatkan status perbandingan sekaligus (lebih kecil: `-1`, sama dengan: `0`, lebih besar: `1`).
```php
$validasi2 = ($input_form === $nilai_db) ? "true" : "false";
echo $harga_toko_a <=> $harga_toko_b;
```

### 4. Bitwise OR & AND (Beri dan Cek Hak)
Menggunakan struktur bilangan biner (`0001`, `0010`, dll) untuk melakukan manajemen hak akses yang jauh lebih cepat dan hemat memori dibandingkan *array* nilai boolean.
```php
$hak_budi = HAK_BACA | HAK_TULIS; // 0011 (Memberi hak baca dan tulis)
$boleh_hapus = ($hak_budi & HAK_HAPUS); // Mengecek apakah bit hapus (0100) menyala
```

### 5. Bitwise Cabut dan Toggle Hak
Mencabut hak spesifik dengan cara membalikkan bit target menggunakan NOT (`~`) lalu di-AND-kan, serta men-*toggle* (nyala-mati) hak menggunakan XOR (`^`).
```php
$hak_budi &= ~HAK_TULIS; // Mencabut hak tulis tanpa mengubah hak lainnya
$hak_ani ^= HAK_TULIS;   // Men-toggle (jika ada jadi tidak ada, jika tidak ada jadi ada)
```

### 6. Logika Akses & Increment
Penggabungan status *boolean* untuk gerbang akses akhir, serta observasi berjalannya *post-increment* dan *pre-increment*.
```php
$boleh_masuk = $login && $akun_aktif && !$maintenance;
$percobaan++; // post-increment, nilai lama dieksekusi dulu baru ditambah
```

---

## 📈 Tingkat Materi

**Level: Intermediate Awal**

```text
Fundamental Data Types
      ↓
Arithmetic & Logic Operators
      ↓
Ternary & Coalescing
      ↓
Strict Comparison & Spaceship
      ↓
Bitwise Operations (OR, AND, XOR)
      ↓
Binary Manipulation & Shift
```

Latihan ini mendalami **berbagai jenis operator PHP secara komprehensif** yang sering kali digunakan oleh *developer* profesional untuk mempersingkat kode (*shorthand syntactic sugar*), efisiensi kalkulasi logika, dan optimasi pada level *bit* atau memori sistem.