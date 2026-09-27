<?php

$transaksi = [
    ["kode" => "TRX-001", "produk" => "Nasi Goreng", "qty" => 3, "harga" => 18000, "status" => "selesai"],
    ["kode" => "TRX-002", "produk" => "Es Teh",      "qty" => 8, "harga" =>  5000, "status" => "selesai"],
    ["kode" => "TRX-003", "produk" => "Ayam Bakar",  "qty" => 2, "harga" => 27000, "status" => "batal"],
    ["kode" => "TRX-004", "produk" => "Nasi Goreng", "qty" => 5, "harga" => 18000, "status" => "selesai"],
    ["kode" => "TRX-005", "produk" => "Mie Rebus",   "qty" => 4, "harga" => 15000, "status" => "selesai"],
    ["kode" => "TRX-006", "produk" => "Es Jeruk",    "qty" => 6, "harga" =>  6000, "status" => "batal"],
    ["kode" => "TRX-007", "produk" => "Ayam Bakar",  "qty" => 4, "harga" => 27000, "status" => "selesai"],
    ["kode" => "TRX-008", "produk" => "Es Teh",      "qty" => 2, "harga" =>  5000, "status" => "selesai"],
    ["kode" => "TRX-009", "produk" => "Nasi Goreng", "qty" => 1, "harga" => 18000, "status" => "selesai"],
    ["kode" => "TRX-010", "produk" => "Mie Rebus",   "qty" => 7, "harga" => 15000, "status" => "selesai"],
];

$antrian_dapur = ["Nasi Goreng", "Mie Rebus", "Ayam Bakar", "Nasi Goreng", "Es Teh"];

$hari    = ["Sen", "Sel", "Rab", "Kam", "Jum"];
$produk  = ["Nasi Goreng", "Mie Rebus", "Ayam Bakar"];
$terjual = [
    [12, 9, 14, 11, 20],   // Nasi Goreng
    [ 7, 8,  5,  9, 13],   // Mie Rebus
    [ 4, 6,  3,  7, 10],   // Ayam Bakar
];

$rak = [
    ["Beras" => 40, "Minyak" => 25, "Gula" => 18],
    ["Telur" => 30, "Tepung" =>  0, "Garam" => 12],
    ["Kecap" => 15, "Saus"   =>  9, "Mie"   =>  0],
];

//=====================================================================================================================

# DAFTAR TRANSAKSI
echo "=== DAFTAR TRANSAKSI ===\n";
printf ("%-9s %-15s %3s %10s %12s\n", "Kode", "Produk", "Qty", "Harga", "Subtotal");
echo "------------------------------------------------------\n";

$omzet = 0;
$selesai = 0;
$batal = 0;
foreach($transaksi as $t){
    $kode = $t["kode"];
    $produk_ = $t["produk"];
    $qty = $t["qty"];
    $harga = $t["harga"];
    $status = $t["status"];
    $subtotal = $harga * $qty;

    if($status !== "batal") {
        $omzet += $subtotal;
        $selesai++;
    }else{
        $subtotal = "-- BATAL --";
        $batal++;
    }
    printf ("%-9s %-15s %3s %10s %12s\n", $kode, $produk_, $qty, $harga, $subtotal);
}

echo "------------------------------------------------------\n";
printf ("Total OMZET %39s\n\n", "Rp " . number_format($omzet, 2, ",", "."));
echo "Transaksi selesai: $selesai  |  dibatalkan: $batal\n";
echo "Rata-rata per transaksi: Rp " . number_format(($omzet/$selesai), 2, ",", ".") . "\n\n";

# MAX/MIN TRANSAKSI
echo"=== TRANSAKSI EKSTREM (dicari manual dengan loop) ===\n";

$tertinggi = [];
$terendah = [];
foreach($transaksi as $t){
    $kode = $t["kode"];
    $produk_ = $t["produk"];
    $qty = $t["qty"];
    $harga = $t["harga"];
    $status = $t["status"];
    $subtotal = $harga * $qty;

    if($status === "selesai") {
        if (empty($tertinggi) || $subtotal > $tertinggi["subtotal"]){
            $tertinggi = ["kode" => $kode, "produk" => $produk_, "subtotal" => $subtotal];
        }elseif(empty($terendah) || $subtotal < $terendah["subtotal"]){
            $terendah = ["kode" => $kode, "produk" => $produk_, "subtotal" => $subtotal];
        }
    }
}
echo "Tertinggi : " . $tertinggi["kode"] . " - " . $tertinggi["produk"] . " (" . $tertinggi["subtotal"] . ")\n";
echo "Terendah : " . $terendah["kode"] . " - " . $terendah["produk"] . " (" . $terendah["subtotal"] . ")\n\n";

echo "=== ANTRIAN DAPUR (while) ===\n";
$antrian = count($antrian_dapur);
$no = 0;
while ($antrian !== 0){
    $antrian--;
    printf("[%d] Memasak: %-11s %20s", $no+1, $antrian_dapur[$no], "(sisa antrian: $antrian)\n");
    $no++;
}
echo "Semua pesanan selesai.\n\n";

# NESTED LOOP
echo "=== MATRIKS PORSI TERJUAL (nested loop) ===\n";
printf ("%-14s", "Produk"); 
foreach ($hari as $h){ // breakdown $hari
    printf ("%6s", $h);
}
printf ("%8s\n", "Total");
echo str_repeat("-", 52) . "\n";

$total_hari = [0, 0, 0, 0, 0];
for ($i = 0; $i < count($produk); $i++){ // breakdown $produk dan $transaksi
    printf ("%-14s", $produk[$i]);
    $subtotal2 = 0;
    for ($j = 0; $j < count($hari); $j++){ // breakdown $transaksi[$hari]
        printf ("%6s", $terjual[$i][$j]);
        $subtotal2 += $terjual[$i][$j]; 
        $total_hari[$j] += $terjual[$i][$j]; 
    }
    printf ("%8s\n", $subtotal2);
}
echo str_repeat("-", 52) . "\n";

printf("%-14s", "TOTAL/HARI");
$grand = 0;
foreach ($total_hari as $t) {
    printf("%6d", $t);
    $grand += $t;
}
printf("%8d\n\n", $grand);

# BREAK LEVEL
echo "=== PENCARIAN STOK HABIS (break 2) ===\n";
for ($i = 0; $i < count($rak); $i++){
    foreach($rak[$i] as $key => $value){
        echo "Memeriksa rak ". ($i+1) ." → $key ($value)\n";
        if ($value === 0){
            echo "DITEMUKAN: $key habis di rak ". ($i+1) ."\n\n";
            break 2;
        }
    }
}

# PIRAMIDA
for ($i = 1; $i < 5; $i++){ 
    for($j = 5; $j > $i; $j--){ // for ini bisa diganti str_repeat(" ", 5-$i)
        echo " ";
    }
    for($j = 0; $j < (2*$i-1); $j++){
        echo "*";
    }
    echo "\n";
}
echo "\n";

for ($i = 1; $i < 5; $i++){ 
    for($j = 5; $j > $i; $j--){ // for ini bisa diganti str_repeat(" ", 5-$i)
        echo " ";
    }
    for($j = 0; $j < (2*$i-1); $j++){
        if ($j %2 !== 0) {
            echo " ";
            continue;
        }
        echo "*";
    }
    echo "\n";
}