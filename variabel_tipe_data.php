<?php
$form = [
    "nama"    => "  budi SANTOSO  ",
    "umur"    => "25",
    "email"   => "budi@example.com",
    "telepon" => "081234567890",
    "bayar"   => "150000.5",
    "setuju"  => "true",
];

// ═══ TUGAS 1: KONSTANTA ═══
define("NAMA_EVENT", "Workshop PHP Fundamental");
define("BIAYA_DASAR", 150000);
const TAHUN = 2026;
const KUOTA = 40;

// ═══ TUGAS 2: PEMBERSIHAN & KONVERSI TIPE ═══
$nama = ucwords(trim($form["nama"]));
$umur = (int)$form["umur"];
$telepon = trim($form["telepon"]);
$bayar = (float)$form["bayar"];
$setuju = filter_var($form["setuju"], FILTER_VALIDATE_BOOLEAN);
$catatan = null;

echo "════════════════════════ DATA ════════════════════════\n";
printf("%-19s : %-22s (%s)\n", "Nama", $nama, gettype($nama));
printf("%-19s : %-22s (%s)\n", "Umur", $umur, gettype($umur));
printf("%-19s : %-22s (%s)\n", "Telepon", $telepon, gettype($telepon));
printf("%-19s : %-22s (%s)\n", "Bayar", $bayar, gettype($bayar));
printf("%-19s : %-22s (%s)\n", "Setuju", var_export($setuju, true), gettype($setuju));
printf("%-19s : %-22s (%s)\n", "Catatan", var_export($catatan, true), gettype($catatan));
echo "\n";

// ═══ TUGAS 3: CEK TIPE DATA ═══
echo "=== CEK TIPE DATA ===\n";
echo "is_string(\$nama) : " . var_export(is_string($nama), true) ."\n";
echo "is_int(\$umur) : " . var_export(is_int($umur), true) ."\n";
echo "is_float(\$bayar) : " . var_export(is_float($bayar), true) ."\n";
echo "is_bool(\$setuju) : " . var_export(is_bool($setuju), true) ."\n";
echo "is_null(\$catatan) : " . var_export(is_null($catatan), true) ."\n\n";

// ═══ TUGAS 4: Validasi ═══
$umur_valid = filter_var($umur, FILTER_VALIDATE_INT);
$email = filter_var($form["email"], FILTER_VALIDATE_EMAIL);

$error = [];
if ($nama === "") $error[] = "Nama tidak boleh kosong\n";
if ($umur_valid === false) $error[] = "Umur harus berupa angka";
if ($umur < 17) $error[] = "Umur minimal 17 tahun";
if ($email === false) $error[] = "Email tidak valid";
if (!str_starts_with($telepon, "08")) $error[] = "Nomor telpon harus diawali 08xx";
if ($setuju === false) $error[] = "Anda harus menyetujui syarat dan ketentuan";

echo "═══ Error ═══\n";
if (count($error) === 0){
    echo "Semua data vallid\n\n";
}
else{
    foreach ($error as $i => $e){
        echo "[" . $i+1 . "] " . "$e\n";
    }
    echo "\n";
}

// ═══ TUGAS 5: Hitung Selisih ═══
echo "═══ Status pembayaran ═══\n";
$selisih = BIAYA_DASAR - $bayar;

if ($selisih >0){
    $status_bayar = "KURANG RP. " . number_format($selisih, 2, ",", ".");
}elseif($selisih <0){
    $status_bayar = "LEBIH RP. " . number_format(abs($selisih), 2, ",", ".");
}else{
    $status_bayar = "PAS RP. " . number_format($selisih, 2, ",", ".");
}
$lunas = ($selisih <= 0);
echo "$status_bayar \n";

// ═══ TUGAS 6: KARTU PESERTA ═══
$lebar = 46;
$nomor = 7;   // peserta ke-7 yang mendaftar

echo str_repeat("=", $lebar) . "\n";
echo str_pad(strtoupper(NAMA_EVENT), $lebar, " ", STR_PAD_BOTH) . "\n";
echo str_pad("TAHUN " . TAHUN, $lebar, " ", STR_PAD_BOTH) . "\n";
echo str_repeat("=", $lebar) . "\n";
printf("%-13s : %s\n", "No. Peserta", "WS-" . TAHUN . "-" . str_pad((string)$nomor, 3, "0", STR_PAD_LEFT));
printf("%-13s : %s\n", "Nama", $nama);
printf("%-13s : %d tahun\n", "Umur", $umur);
printf("%-13s : %s\n", "Email", $email !== false ? $email : "-");
printf("%-13s : %s\n", "Telepon", $telepon);
echo str_repeat("-", $lebar) . "\n";
printf("%-13s : Rp %s\n", "Biaya", number_format(BIAYA_DASAR, 2, ',', '.'));
printf("%-13s : Rp %s\n", "Dibayar", number_format($bayar, 2, ',', '.'));
printf("%-13s : %s\n", "Status", $status_bayar);
printf("%-13s : %s\n", "Terverifikasi", ($lunas && count($error) === 0) ? "YA" : "BELUM");
echo str_repeat("=", $lebar) . "\n";
printf("Sisa kuota: %d dari %d peserta\n", KUOTA - $nomor, KUOTA);