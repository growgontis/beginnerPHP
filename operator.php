<?php

$harga_satuan = 47500;
$qty          = 7;
$berat_gram   = 7300;
$tarif_per_kg = 12000;
$bayar        = 500000;
const PPN = 0.11;

//═══════════════ BAGIAN A — PERHITUNGAN HARGA ═══════════════
#A1 - Subtotal
$subtotal = $harga_satuan * $qty;

echo "===== Subtotal dan PPN =====\n";
echo "Harga Satuan: Rp" . number_format($harga_satuan, 2, ",", ".") . "\n";
echo "Jumlah      : Rp" . number_format($qty, 2, ",", ".") . "\n";
echo "Subtotal    : Rp" . number_format($subtotal, 2, ",", ".") . "\n";
echo "\n";

#A2 - Diskon
$diskon = ($subtotal >= 500.000) ? 15 : (($subtotal >= 300.000) ? 10 : (($subtotal >= 100.000) ? 5 : 0));
$nilai_diskon = $subtotal * $diskon /100;
$setelah_diskon = $subtotal - $nilai_diskon;

echo "===== Diskon =====\n";
echo "Diskon               : $diskon%\n";
echo "Nilai diskon         : Rp" .  number_format($nilai_diskon, 2, ",", ".") . "\n";
echo "Harga setelah diskon : Rp" .  number_format($setelah_diskon, 2, ",", ".") . "\n";
echo "\n";

#A3 - Ongkir
$kg = (int)($berat_gram/1000);
$sisa = $berat_gram%1000;
$total_berat = ($sisa >0) ? $kg+1 : $kg;
$ongkir = $tarif_per_kg * $total_berat;

echo "===== Ongkir =====\n";
echo "Total berat : $total_berat\n";
echo "Tarif per Kg: Rp" .  number_format($tarif_per_kg, 2, ",", ".") . "\n";
echo "Ongkir      : Rp" .  number_format($ongkir, 2, ",", ".") . "\n";
echo "\n";

#A4 - Kupon
$kupon = null;
$catatan_kirim = "";

echo "===== Kupon =====\n";
echo "Kupon        : " . ($kupon ??= "TANPA-KUPON") . "\n";
echo "Catatan Kirim: " . ($catatan_kirim ?: "(tidak ada catatan)") . "\n";
echo "\n";

#A5 - Experiment Perbandingan
$input_form = "332500";   // dari form → string
$nilai_db   = 332500;     // dari database → integer

$validasi1 = ($input_form == $nilai_db) ? "true" : "false";
$validasi2 = ($input_form === $nilai_db) ? "true" : "false";
$validasi3 = ($input_form !== $nilai_db) ? "true" : "false";

echo "===== Experiment Perbandingan =====\n";
echo "validasi (==): $validasi1, validasi (===): $validasi2, validasi (!==): $validasi3\n";
echo "\n";

#A6 - Experiment Spaceship
$harga_toko_a = 332500;
$harga_toko_b = 349000;
$harga_toko_c = 332500;

echo "===== SPACESHIP (<=>) =====\n";
echo "A <=> B : " . ($harga_toko_a <=> $harga_toko_b) . "  (A lebih murah)\n";
echo "B <=> C : " . ($harga_toko_b <=> $harga_toko_c) . "  (B lebih mahal)\n";
echo "A <=> C : " . ($harga_toko_a <=> $harga_toko_c) . "  (harga sama)\n\n";

#A7 - Experiment Operator Penugasan
$total = 0;
$total += $setelah_diskon;
$total += $ongkir;
$total += $total*PPN;

echo "Total harga: " . number_format($total, 2, ",", ".") . "\n";
echo "\n";

//═══════════════ BAGIAN B — HAK AKSES BITWISE ═══════════════
const HAK_BACA=1, HAK_TULIS=2, HAK_HAPUS=4, HAK_ADMIN=8;

function tampilHak(string $nama, int $bitmask): void
{
    $daftar = []; //misal kasus $hak_budi
    if ($bitmask & HAK_BACA)  $daftar[] = "BACA"; // 0011 & 0001 = 0001 hasilnya true
    if ($bitmask & HAK_TULIS) $daftar[] = "TULIS"; // 0011 & 0010 = 0010 hasilnya true
    if ($bitmask & HAK_HAPUS) $daftar[] = "HAPUS"; // 0011 & 0100 = 0000 hasilnya false
    if ($bitmask & HAK_ADMIN) $daftar[] = "ADMIN"; // 0011 & 1000 = 0000 hasilnya false

    printf("%-8s | bitmask %2d | biner %s | %s\n",
        $nama,
        $bitmask,
        str_pad(decbin($bitmask), 4, "0", STR_PAD_LEFT),
        $daftar ? implode(", ", $daftar) : "(tanpa hak akses)"
    );
}

// ═══ TUGAS B1: MEMBERI HAK DENGAN OR ═══
$hak_budi  = HAK_BACA | HAK_TULIS;              // 0011 = 3
$hak_ani   = HAK_BACA;                          // 0001 = 1
$hak_admin = HAK_BACA | HAK_TULIS | HAK_HAPUS | HAK_ADMIN;  // 1111 = 15

echo "=== HAK AWAL ===\n";
tampilHak("Budi",  $hak_budi);
tampilHak("Ani",   $hak_ani);
tampilHak("Admin", $hak_admin);
echo "\n";

// ═══ TUGAS B2: MEMERIKSA HAK DENGAN AND ═══
echo "=== PEMERIKSAAN HAK ===\n";
echo "Budi boleh menghapus? " . (($hak_budi & HAK_HAPUS) ? "Ya" : "Tidak") . "\n";
echo "Budi boleh menulis?   " . (($hak_budi & HAK_TULIS) ? "Ya" : "Tidak") . "\n";
echo "Ani  boleh menulis?   " . (($hak_ani  & HAK_TULIS) ? "Ya" : "Tidak") . "\n\n";

// ═══ TUGAS B3: MENAMBAH (|=) DAN MENCABUT (& ~) HAK ═══
echo "=== PERUBAHAN HAK ===\n";
$hak_budi |= HAK_HAPUS;              // tambah hak hapus
echo "Budi diberi hak HAPUS  → ";
tampilHak("Budi", $hak_budi);

$hak_budi &= ~HAK_TULIS;             // cabut hak tulis
echo "Budi dicabut hak TULIS → ";
tampilHak("Budi", $hak_budi);

$hak_ani ^= HAK_TULIS;               // XOR: toggle
echo "Ani  di-toggle TULIS   → ";
tampilHak("Ani", $hak_ani);
$hak_ani ^= HAK_TULIS;
echo "Ani  di-toggle lagi    → ";
tampilHak("Ani", $hak_ani);
echo "\n";

// ═══ TUGAS B4: GESER BIT ═══
echo "=== GESER BIT ===\n";
echo "HAK_BACA << 1 = " . (HAK_BACA << 1) . " (sama dengan HAK_TULIS)\n";
echo "HAK_ADMIN >> 1 = " . (HAK_ADMIN >> 1) . " (sama dengan HAK_HAPUS)\n";
echo "Geser kiri 1 bit = mengalikan 2, geser kanan 1 bit = membagi 2\n\n";

// ═══ TUGAS B5: LOGIKA AKSES AKHIR ═══
$login       = true;
$akun_aktif  = true;
$maintenance = false;

$boleh_masuk = $login && $akun_aktif && !$maintenance;
$boleh_hapus = $boleh_masuk && ($hak_budi & HAK_HAPUS);

echo "=== KEPUTUSAN AKSES (Budi) ===\n";
echo "Login && aktif && !maintenance : " . var_export($boleh_masuk, true) . "\n";
echo "Boleh menghapus data           : " . var_export((bool)$boleh_hapus, true) . "\n";
echo "XOR (login xor maintenance)    : " . var_export($login xor $maintenance, true) . "\n";

// Increment/decrement pada counter percobaan login
$percobaan = 0;
echo "\n=== COUNTER PERCOBAAN LOGIN ===\n";
echo "Post-increment \$percobaan++ : " . $percobaan++ . " → nilai sekarang $percobaan\n";
echo "Pre-increment  ++\$percobaan : " . ++$percobaan . " → nilai sekarang $percobaan\n";