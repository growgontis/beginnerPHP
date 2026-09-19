# beginnerPHP
# PHP v 8.1+

# 🛒 Latihan PHP — Kasir Inventaris CLI

Program CLI sederhana yang mensimulasikan sistem kasir dengan inventaris barang. Program menerima input kode barang dan jumlah pembelian, memvalidasi stok, memasukkan barang ke keranjang, menghitung total belanja dan pajak, kemudian menampilkan struk pembayaran.

---

## 🎯 Tujuan Latihan

Latihan ini bertujuan untuk melatih:

* Penggunaan associative dan nested array.
* Penggunaan argument CLI dengan `$argv`.
* Membuat dan menggunakan function.
* Penggunaan reference dengan `&`.
* Validasi input dan stok barang.
* Penggunaan perulangan dan percabangan.
* Pengolahan data keranjang belanja.
* Perhitungan total dan pajak.
* Formatting output menggunakan `printf()`.
* Formatting angka menggunakan `number_format()`.
* Penggunaan constant dengan `const`.

---

## 🧩 Materi yang Dicakup

| Materi            | Contoh                          |
| ----------------- | ------------------------------- |
| Associative Array | `$inventaris["001"]`            |
| Nested Array      | `["nama", "harga", "stok"]`     |
| CLI Argument      | `$argv[1]`                      |
| Null Coalescing   | `$argv[1] ?? "Tidak diketahui"` |
| Input CLI         | `readline()`                    |
| String            | `trim()`, `strtolower()`        |
| String parsing    | `explode()`                     |
| Array             | `count()`, `isset()`            |
| Percabangan       | `if`, `else`                    |
| Perulangan        | `while`, `foreach`              |
| Kontrol loop      | `break`, `continue`             |
| Function          | `tambahKeranjang()`             |
| Reference         | `&$keranjang`, `&$inventaris`   |
| Constant          | `const PAJAK = 0.11`            |
| Operator          | `-=`, `+=`, `*`, `+`            |
| Formatting output | `printf()`                      |
| Formatting angka  | `number_format()`               |

---

## 🔄 Alur Program

```text
Mulai
  ↓
Baca argument CLI
  ↓
Input kode barang + jumlah
  ↓
Input = "selesai"?
  ├── Ya → Selesai input
  │
  └── Tidak
        ↓
    Pisahkan kode & jumlah
        ↓
    Input valid?
      ├── Tidak → Input ulang
      │
      └── Ya
            ↓
        Cek kode barang
            ↓
        Kode valid?
          ├── Tidak → Input ulang
          │
          └── Ya
                ↓
            Cek stok
                ↓
            Stok cukup?
              ├── Tidak → Input ulang
              │
              └── Ya
                    ↓
                Masukkan ke keranjang
                    ↓
                Kurangi stok
                    ↓
                Kembali input
                    ↓
              Hitung total belanja
                    ↓
                Hitung pajak
                    ↓
              Hitung total bayar
                    ↓
                Cetak struk
                    ↓
                  Selesai
```

---

## 🧠 Konsep Pemrograman yang Dilatih

### 1. Input & Parsing

Program menerima input seperti:

```text
001 3
```

Kemudian memisahkannya menggunakan:

```php
$data_input = explode(" ", $input);
```

Hasilnya:

```text
001 → kode barang
3   → jumlah
```

### 2. Validasi

Program memvalidasi:

```text
Input memiliki kode dan jumlah
        ↓
Kode barang tersedia
        ↓
Stok mencukupi
```

Contohnya:

```php
if (!isset($inventaris[$kode_input])) {
    echo "Kode barang salah\n";
    continue;
}
```

### 3. Manipulasi Data

Function `tambahKeranjang()` melakukan dua hal:

```text
Kurangi stok inventaris
        +
Tambahkan barang ke keranjang
```

Jika barang sudah ada di keranjang, quantity ditambahkan:

```php
$keranjang[$kode]["qty"] += $qty;
```

### 4. Reference

Function menggunakan:

```php
function tambahKeranjang(&$keranjang, &$inventaris, $kode, $qty)
```

Tanda `&` membuat function bekerja langsung terhadap variable asli sehingga perubahan stok dan keranjang tetap tersimpan setelah function selesai.

### 5. Processing

Program menghitung:

```text
Harga barang × Quantity
        ↓
Total belanja
        ↓
Pajak 11%
        ↓
Total bayar
```

### 6. Output Formatting

`printf()` digunakan untuk membuat tampilan struk lebih rapi:

```php
printf(
    "%d. %-17s(x$qty) Rp %s\n",
    $nomor,
    $nama,
    number_format($harga, 0, ",", ".")
);
```

---

## 📈 Tingkat Materi

**Level: Beginner → Intermediate Awal**

```text
PHP Fundamental
      ↓
Array & Nested Array
      ↓
Input CLI
      ↓
String Parsing
      ↓
Validasi Data
      ↓
Function & Reference
      ↓
Data Processing
      ↓
Constant
      ↓
Output Formatting
```

Latihan ini merupakan pengembangan dari latihan PHP fundamental karena mulai menggabungkan **CLI argument, manipulasi array, function dengan reference, validasi data, dan simulasi proses bisnis sederhana**.

