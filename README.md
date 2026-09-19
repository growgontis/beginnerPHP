# beginnerPHP
# PHP v 8.1+

# 📚 Latihan PHP — Rekapitulasi Nilai Mahasiswa

Program CLI sederhana untuk memasukkan data mahasiswa, melakukan validasi nilai, menghitung nilai akhir, menentukan grade, menampilkan rekapitulasi, dan menyimpan hasil ke file.

---

## 🎯 Tujuan Latihan

Latihan ini bertujuan untuk melatih:

* Penggunaan variable dan tipe data.
* Input data melalui CLI menggunakan `readline()`.
* Validasi input.
* Penggunaan percabangan dan perulangan.
* Penggunaan array untuk menyimpan data.
* Pembuatan dan penggunaan function.
* Pengolahan data dan perhitungan nilai.
* Formatting output.
* Penyimpanan hasil ke file.

---

## 🧩 Materi yang Dicakup

| Materi               | Contoh                                      |
| -------------------- | ------------------------------------------- |
| Variable             | `$nama`, `$tugas`, `$uts`, `$uas`           |
| Input CLI            | `readline()`                                |
| String               | `trim()`, `strtolower()`                    |
| Validasi             | `is_numeric()`                              |
| Percabangan          | `if`, `elseif`, `else`                      |
| Perulangan           | `while`, `do...while`                       |
| Kontrol loop         | `break`, `continue`                         |
| Array                | Associative & nested array                  |
| Iterasi array        | `foreach`                                   |
| Function             | `hitungNilaiAkhir()`                        |
| Parameter & return   | `($tugas, $uts, $uas)`, `return`            |
| Return type          | `:float`, `:string`                         |
| Built-in function    | `empty()`, `count()`, `array_sum()`         |
| Formatting           | `sprintf()`                                 |
| String concatenation | `.=`                                        |
| File handling        | `file_put_contents()`                       |
| Operator             | `+`, `*`, `/`, `<`, `>`, `>=`, `&&`, `\|\|` |

---

## 🔄 Alur Program

```text
Mulai
  ↓
Input nama mahasiswa
  ↓
Nama = "selesai"/"stop"?
  ├── Ya → Selesai
  │
  └── Tidak
        ↓
    Input nilai Tugas, UTS, UAS
        ↓
    Validasi input
        ↓
    Nilai valid?
      ├── Tidak → Input ulang
      │
      └── Ya
            ↓
        Simpan data mahasiswa
            ↓
        Kembali input mahasiswa
            ↓
        Selesai input
            ↓
        Hitung nilai akhir
            ↓
        Tentukan grade
            ↓
        Hitung rata-rata
            ↓
        Buat rekapitulasi
            ↓
        Simpan ke file
            ↓
          Selesai
```

---

## 🧠 Konsep Pemrograman yang Dilatih

Latihan ini melatih alur dasar dalam membangun sebuah program:

### 1. Input

Menerima data dari pengguna melalui terminal.

```php
$nama = readline("Nama: ");
```

### 2. Validation

Memastikan data yang diberikan sesuai dengan aturan.

```php
is_numeric($tugas)
```

dan memastikan nilai berada pada rentang `0–100`.

### 3. Storage

Menyimpan data mahasiswa ke dalam associative/nested array.

```php
$data_mahasiswa[$nama] = [
    "tugas" => $tugas,
    "uts" => $uts,
    "uas" => $uas
];
```

### 4. Processing

Mengolah data untuk mendapatkan nilai akhir.

```text
Tugas × 30%
UTS   × 30%
UAS   × 40%
```

### 5. Decision

Menentukan grade berdasarkan nilai akhir.

```text
>= 85 → A
>= 70 → B
>= 60 → C
>= 50 → D
<  50 → E
```

### 6. Output

Menampilkan hasil dalam bentuk tabel yang terformat.

### 7. Persistence

Menyimpan hasil rekapitulasi ke file `rekap_nilai.txt`.

---

## 📈 Tingkat Materi

**Level: Beginner → Intermediate Awal**

```text
PHP Fundamental
      ↓
Variable & Data Type
      ↓
Input & Validation
      ↓
Control Flow
      ↓
Array
      ↓
Function
      ↓
Data Processing
      ↓
File Handling
```

Latihan ini sudah mencakup **fundamental PHP secara cukup lengkap** dan mulai memperkenalkan konsep pengolahan data dalam program yang lebih nyata.
