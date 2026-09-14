<?php
$inventaris = [
    "001" => ["nama" => "Kopi Hitam", "harga" => 15000, "stok" => 50],
    "002" => ["nama" => "Susu UHT", "harga" => 20000, "stok" => 20],
    "003" => ["nama" => "Roti Tawar", "harga" => 12000, "stok" => 10]
];

$keranjang = [];

function tambahKeranjang(&$keranjang, &$inventaris, $kode, $qty){
    $inventaris[$kode]["stok"] -= $qty; //kurangi stok sesuai jumlah yang dipilih

    if (isset($keranjang[$kode])){
        $keranjang[$kode]["qty"] += $qty;
    }
    else{
        $keranjang[$kode] = [
        "nama" => $inventaris[$kode]["nama"],
        "harga" => $inventaris[$kode]["harga"],
        "qty" => $qty
        ]; //memasukkan data input ke $keranjang
    }
    
}

// input
while(true){
    $input = trim(readline("kode dan jumlah (contoh: 001 3): "));
    if (strtolower($input) == "selesai") {break;}

    $data_input = explode(" ", $input);
    if (count($data_input) < 2) {echo "Input invalid\n"; continue;} //input invalid
    $kode_input = $data_input[0];
    $qty_input = $data_input[1];

    if (!isset($inventaris[$kode_input])) {echo "Kode barang salah\n"; continue;} //kode barang tidak valid
    if ($inventaris[$kode_input]["stok"] < $qty_input) {echo "Stok tidak cukup\n"; continue;} //stok kurang

    tambahKeranjang($keranjang, $inventaris, $kode_input, $qty_input);
}

// perhitungan
const PAJAK = 0.11;
$total_belanja = 0;
$nomor = 1;

echo "\n====================================\n";
echo "STRUK BELANJA ANDA\n";
echo "====================================\n";

foreach($keranjang as $item){
    $nama = $item["nama"];
    $harga = $item["harga"] * $item["qty"];
    $qty = $item["qty"];

    $total_belanja+=$harga;

    printf("%d. %-17s(x$qty) Rp %s\n", $nomor, $nama, number_format($harga, 0, ",", ".")); //print format
    $nomor++;
}

$total_pajak = PAJAK * $total_belanja;
$total_akhir = $total_belanja + $total_pajak;

echo "------------------------------------\n";
printf("%-23s: Rp %s\n", "total_belanja", number_format($total_belanja, 0, ",", "."));
printf("%-23s: Rp %s\n", "Pajak (11%)", number_format($total_pajak, 0, ",", "."));
echo "====================================\n";
printf("%-23s: Rp %s\n", "TOTAL BAYAR", number_format($total_akhir, 0, ",", "."));
echo "====================================\n";