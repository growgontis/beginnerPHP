# beginnerPHP
# PHP v 8.1+

# 📚 Latihan PHP — Manipulasi Array, Matriks, & Kontrol Perulangan Lanjut

Program CLI yang mensimulasikan sistem pencatatan transaksi restoran, antrian dapur, rekapitulasi matriks penjualan menggunakan *nested loop*, hingga pencarian stok dan pembuatan pola (piramida) menggunakan kontrol perulangan tingkat lanjut.

---

## 🎯 Tujuan Latihan

Latihan ini bertujuan untuk melatih:
* Pemrosesan data *array* multidimensi (*array of objects/associative arrays*).
* Pencarian nilai ekstrem (tertinggi/terendah) secara manual tanpa fungsi bawaan.
* Penggunaan dan perbedaan berbagai jenis perulangan (`foreach`, `while`, `for`).
* Pemahaman mendalam tentang *nested loop* (perulangan bersarang) untuk memproses matriks (baris & kolom) serta mencetak pola dua dimensi.
* Penggunaan *loop control* tingkat lanjut seperti `break 2` dan `continue`.
* *Formatting* cetakan tabel yang lebih kompleks dan dinamis di CLI menggunakan `printf`.

---

## 🧩 Materi yang Dicakup

| Materi | Contoh |
| --- | --- |
| Array Associative & Indexed | `$transaksi = [...]`, `$hari = [...]` |
| Foreach Loop | `foreach($transaksi as $t)` |
| While Loop | `while ($antrian !== 0)` |
| For Loop | `for ($i = 0; $i < count($produk); $i++)` |
| Nested Loop (Bersarang) | `for` di dalam `for` (Matriks Terjual & Piramida) |
| Pencarian Ekstrem | `if(empty($tertinggi) \|\| $subtotal > $tertinggi["subtotal"])` |
| Loop Control: Break Level | `break 2;` (keluar dari dua loop sekaligus) |
| Loop Control: Continue | `continue;` (melompati iterasi saat ini) |
| Aritmatika Modulo (Ganjil/Genap) | `$j % 2 !== 0` |
| Formatting Tabel Dinamis | `printf("%-14s", $produk[$i])` |

---

## 🔄 Alur Program

```text
Mulai
  ↓
[Bagian 1: Daftar Transaksi]
Iterasi $transaksi (foreach) → Hitung omzet, hitung selesai/batal, cetak tabel
  ↓
[Bagian 2: Nilai Ekstrem]
Iterasi $transaksi → Simpan & perbarui subtotal tertinggi dan terendah
  ↓
[Bagian 3: Antrian Dapur]
Proses $antrian_dapur (while) → Kurangi jumlah antrian sampai 0
  ↓
[Bagian 4: Matriks Terjual]
Looping Baris (Produk) & Kolom (Hari) → Hitung subtotal per produk & grand total per hari
  ↓
[Bagian 5: Cari Stok Habis]
Nested loop pada $rak → Jika menemukan stok == 0, langsung hentikan seluruh loop (break 2)
  ↓
[Bagian 6: Cetak Piramida]
Nested loop baris dan kolom → Cetak bintang, atau lewati dengan 'continue' untuk piramida berongga
  ↓
Selesai
```

---

## 🧠 Konsep Pemrograman yang Dilatih

Latihan ini sangat padat dengan teknik fundamental pengolahan data array dan iterasi:

### 1. Iterasi Data Kompleks & Accumulator
Menggunakan `foreach` untuk membongkar *array of associative arrays*. Selama iterasi, program juga menumpuk nilai (akumulasi) seperti menghitung total `$omzet` dan menghitung *counter* jumlah pesanan `$selesai`.

### 2. Pencarian Nilai Ekstrem (Maks/Min) Manual
Algoritma dasar pencarian dengan menyimpan nilai sementara. Jika iterasi menemukan nilai yang lebih besar dari penyimpan `$tertinggi`, nilai penyimpan akan ditimpa. Ini sangat melatih logika perbandingan data tanpa mengandalkan fungsi bawaan PHP seperti `max()`.

### 3. Matriks / 2D Array Processing (Nested Loop)
Memproses struktur data baris dan kolom (seperti data Excel).
* Loop luar (Outer loop) menangani baris produk.
* Loop dalam (Inner loop) menangani penjualan harian di tiap produk.
* Program melatih cara menampung dua jenis total sekaligus: Total per baris (`$subtotal2`) dan akumulasi total per kolom (`$total_hari`).

### 4. Multi-level Break (`break 2`)
Ketika mencari data dalam loop bersarang (nested loop), menggunakan `break` biasa hanya akan menghentikan loop terdalam. Dengan `break 2`, program dapat menghentikan loop dalam beserta loop luarnya sekaligus ketika sebuah kondisi (stok = 0) terpenuhi, sehingga sangat menghemat *resource* komputasi.

### 5. Penggunaan `continue` pada Pembuatan Pola
Membuat dua jenis piramida bintang bersarang. Pada piramida kedua, `continue` digunakan untuk mencegat jalannya iterasi jika indeks kolom bernilai ganjil (`$j % 2 !== 0`), sehingga iterasi mencetak spasi dan melompat kembali ke atas, menciptakan piramida berongga.

---

## 📈 Tingkat Materi

**Level: Intermediate**

```text
Array Fundamentals
      ↓
Basic Loops (while, foreach)
      ↓
State Retention (Max/Min finding)
      ↓
Multidimensional / 2D Arrays
      ↓
Nested Loops Matrix Processing
      ↓
Loop Control (Break level & Continue)
```

Materi ini memberikan fondasi yang sangat kuat sebelum masuk ke manipulasi *database* relasional, karena pengolahan *result set* dari *database* umumnya akan menggunakan teknik iterasi array dan matriks seperti ini.