<?php

/*
 * Mall Tegal Plaza memakai sistem parkir dengan aturan berlapis.
 * Setiap kendaraan yang keluar harus dihitung tarifnya lalu dicetak
 * struknya. Aturannya:
 *
 *   • Jam pertama            : Rp 5.000
 *   • Jam berikutnya         : Rp 3.000 / jam
 *   • Maksimum harian        : Rp 50.000
 *   • Motor                  : setengah dari semua tarif di atas
 *                              (termasuk batas maksimumnya)
 *   • Truk                   : dua kali lipat tarif mobil
 *   • Akhir pekan            : tambahan flat Rp 2.000
 *   • Tiket hilang           : denda Rp 25.000
 *   • Member                 : diskon 20% dari biaya parkir
 *                              (denda tiket TIDAK ikut didiskon)
 *   • Parkir < 1 jam         : tetap dihitung 1 jam
 *   • Jam keluar < jam masuk : tolak transaksi, arahkan ke petugas
 *
 * Metode pembayaran berbiaya admin:
 *   1 = Tunai (0)   2 = Kartu (1.500)   3 = E-Wallet (500)   4 = Voucher (0)
*/

const JAM_PERTAMA = 5000;
const JAM_BERIKUTNYA = 3000;
const MAXIMUM_HARIAN = 50000;
const FLAT = 2000;
const DENDA = 25000;
const MEMBER = 0.2;

$kendaraan = [
    ["plat" => "B 1234 XYZ", "jenis" => "mobil", "masuk" =>  8, "keluar" => 14, "hari" => "Senin",  "member" => true,  "metode" => 3, "tiket_hilang" => false],
    ["plat" => "D 5678 AB",  "jenis" => "motor", "masuk" => 10, "keluar" => 11, "hari" => "Sabtu",  "member" => false, "metode" => 1, "tiket_hilang" => false],
    ["plat" => "F 9012 CD",  "jenis" => "mobil", "masuk" =>  7, "keluar" => 22, "hari" => "Minggu", "member" => false, "metode" => 2, "tiket_hilang" => true],
    ["plat" => "B 3456 EF",  "jenis" => "truk",  "masuk" => 13, "keluar" => 16, "hari" => "Rabu",   "member" => true,  "metode" => 4, "tiket_hilang" => false],
    ["plat" => "E 7788 GH",  "jenis" => "mobil", "masuk" => 15, "keluar" => 12, "hari" => "Kamis",  "member" => false, "metode" => 1, "tiket_hilang" => false],
];

foreach($kendaraan as $i =>$k){
    $plat = $k["plat"];
    $jenis = $k["jenis"];
    $masuk = $k["masuk"];
    $keluar = $k["keluar"];
    $hari = $k["hari"];

    $member = $k["member"];
    $tiket_hilang = $k["tiket_hilang"];

    #jam parkir
    $lama_parkir = $keluar - $masuk;
    $tagihan = JAM_PERTAMA;
    if ($lama_parkir > 1) {
        $tagihan+= (JAM_BERIKUTNYA * ($lama_parkir-1)); 
        if($tagihan > 50000) $tagihan = 50000;
    }

    #jenis
    if ($jenis === "motor"){
        $tagihan /= 2;
    }elseif ($jenis === "truk"){
        $tagihan *= 2;
    }

    #hari
    switch($hari){
        case "Senin":
        case "Selasa":
        case "Rabu":
        case "Kamis":
        case "Jumat":
            $kategori_hari = "Hari Kerja"; //fall through senin - jumat
            break;
        case "Sabtu":
        case "Minggu":
            $kategori_hari = "Hari Libur";
            $tagihan += 2000;
            break;
        default:
            $kategori_hari = "Hari Tidak Dikenal";
    }

    #member
    $diskon = 0;
    if ($member === true) {
        $diskon = $tagihan * MEMBER;
        $tagihan -= $diskon;
    }

    #tiket hilang
    $denda = 0;
    if ($tiket_hilang === true) {
        $denda = DENDA;
        $tagihan += $denda;
    }

    #metode
    $metode = match($k["metode"]){
        1 => ["Tunai", 0],
        2 => ["Kartu", 1500],
        3 => ["E-Wallet", 500],
        4 => ["Voucher", 0],
        default => ["Metode tidak dikenal", 0]
    };
    [$nama_metode, $biaya_admin] = $metode;
    $tagihan += $biaya_admin;

    #output
    echo str_repeat("=", 40). "\n";
    echo str_pad("Tiket Parkir " . $i+1 , 40, " ", STR_PAD_BOTH). "\n";
    echo str_repeat("=", 40). "\n";
    printf ("%-18s: %s\n", "Jenis Kendaraan", $jenis);
    printf ("%-18s: %s\n", "Plat", $plat);
    printf ("%-18s: %s (%s)\n", "Hari", $hari, $kategori_hari);
    printf ("%-18s: %s:00 - %s:00 (%d)\n", "Jam", str_pad($masuk, 2, 0, STR_PAD_LEFT), str_pad($keluar, 2, 0, STR_PAD_LEFT), $lama_parkir);
    if ($keluar < $masuk) {echo str_repeat("-", 40). "\n"; echo "[ERROR] Transaksi ditolak, silahkan temui petugas parkir\n"; break;}
    printf ("%-18s: %s\n", "Diskon member", number_format($diskon, 2, ",", "."));
    printf ("%-18s: %s\n", "Denda Tiket Hilang", number_format($denda, 2, ",", "."));
    printf ("%-18s: %s\n", "Metode Pembayaran", $nama_metode);
    printf ("%-18s: %s\n", "Biaya admin", number_format($biaya_admin, 2, ",", "."));
    echo str_repeat("-", 40). "\n";
    printf ("%-18s: %s\n", "Total Tagihan", number_format($tagihan, 2, ",", "."));

    echo "\n";
}

