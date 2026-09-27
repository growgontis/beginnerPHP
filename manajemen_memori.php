<?php

$log_aktivitas = [];
$total_unduhan = 0;

$daftar_unduh = [
    "Pemrograman PHP Dasar",
    "Algoritma dan Struktur Data",
    "Basis Data Relasional",
    "Jaringan Komputer",
];

function catatLog(string $pesan):void {
    global $log_aktivitas; // langsung mengakses variabel $log_aktivitas tanpa perlu pass reference
    $log_aktivitas[] = $pesan;
}   

function unduh(string $judul):string {
    static $kuota = 3;
    global $total_unduhan;

    if ($kuota ==0){
        catatLog("DITOLAK — kuota unduh sesi ini sudah habis");
        return "DITOLAK — kuota unduh sesi ini sudah habis" . PHP_EOL;
    }

    $kuota--;
    $total_unduhan++;
    catatLog("BERHASIL — $judul diunduh (sisa kuota: $kuota)");
    return "BERHASIL — $judul diunduh (sisa kuota: $kuota)"  . PHP_EOL;
}

echo "=== SIMULASI UNDUHAN ===\n";
echo unduh("Pemrograman PHP Dasar") . "\n";
echo unduh("Algoritma dan Struktur Data") . "\n";
echo unduh("Basis Data Relasional") . "\n";
echo unduh("Jaringan Komputer") . "\n";     // melebihi kuota
echo "\n";

echo "=== LOG AKTIVITAS ===\n";
foreach ($log_aktivitas as $i => $baris) {
    echo "  " . str_pad((string)($i + 1), 2, "0", STR_PAD_LEFT) . ". $baris\n";
}
echo "  Total unduhan berhasil: $total_unduhan\n\n";

function resetSesi(): void
{
    global $log_aktivitas, $total_unduhan;
    $log_aktivitas = [];
    $total_unduhan = 0;
}

resetSesi();
echo "=== SETELAH resetSesi() ===\n";
echo "  Jumlah log     : " . count($log_aktivitas) . "\n";
echo "  Total unduhan  : $total_unduhan\n";
echo "  CATATAN: kuota di dalam unduh() TIDAK ikut ter-reset karena static\n";
echo "           bertahan selama proses PHP masih berjalan.\n";
echo "  Bukti → " . unduh("Sistem Operasi") . "\n";

//Experiment Scope
function cekScope ():void {
    $variabel_lokal = "tes";
    echo $variabel_lokal . PHP_EOL;
    echo isset($log_aktivitas) . PHP_EOL;
}
echo isset($variabel_lokal);

//Experiment Static
function pakaiStatic(): int
{
    static $n = 0;
    $n++;
    return $n;
}

function pakaiBiasa(): int
{
    $n = 0;
    $n++;
    return $n;
}

echo "=== STATIC vs BIASA (3x pemanggilan) ===\n";
for ($i = 1; $i <= 3; $i++) {
    echo "  Panggilan ke-$i → static: " . pakaiStatic() . " | biasa: " . pakaiBiasa() . "\n";
}
echo "\n";

//Superglobal
echo "=== INFORMASI EKSEKUSI (SUPERGLOBAL) ===\n";
echo "  Script  : " . basename($_SERVER['SCRIPT_FILENAME'] ?? __FILE__) . "\n"; //menampilkan nama file yang dieksekusi
echo "  Mode    : " . (PHP_SAPI === 'cli' ? 'CLI' : 'Web') . "\n"; //mendeteksi program dieksekusi li atau web

//Reference counting
echo "=== REFERENCE COUNTING: data yang sama disimpan dalam 2 variabel ===\n";
$sesi = new stdClass(); //objek. stdClass() class kosong bawaan php
$sesi->id       = "SES-2026-0091"; //properti
$sesi->user     = "deni";
$sesi->mulai    = "08:14:22";

$backup = $sesi;            // ref count = 2, BUKAN salinan baru
$backup->user = "deni_p";   // mengubah lewat $backup ikut mengubah $sesi

echo "  \$sesi->user setelah diubah via \$backup : {$sesi->user}\n";
echo "  (objek di-assign by handle, jadi keduanya menunjuk data yang sama)\n";

unset($sesi);               // ref count turun ke 1, objek belum dihapus
echo "  Setelah unset(\$sesi), \$backup->id      : {$backup->id}\n";

unset($backup);             // ref count = 0 → GC membebaskan memori
echo "  Setelah unset(\$backup)                : " . (isset($backup) ? "masih ada" : "sudah dibersihkan oleh GC") . "\n\n";