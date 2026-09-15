<?php

$kontak = [];

while(true){
    echo "\n--- APLIKASI BUKU KONTAK ---\n";
    echo "1. Tampilkan Semua Kontak\n";
    echo "2. Tambah Kontak Baru\n";
    echo "3. Cari Kontak\n";
    echo "5. Hapus Kontak\n";
    echo "4. Keluar\n";
    echo "Pilih menu (1-4): ";

    $input = trim(readline());
    if (!is_numeric($input)) echo "input harus berupa angka";
    switch($input){
        case 1:
            tampilKontak();
            break;
        case 2:
            tambahKontak($kontak);
            break;
        case 3:
            cariKontak();
            break;
        case 4:
            hapusKontak();
            break 2;
        case 5:
            echo "Terima kasih telah menggunakan kode ini";
            break 2;
        default:
            echo "input yang anda masukkan tidak valid";
    }
    echo "\n";
}

function tampilKontak():void {
    global $kontak; //mengambil $kontak di luar fungsi secara langsung
    if (empty($kontak)) echo "tidak ada kontak";
    foreach($kontak as $nama => $item){
        echo "Nama: $nama, Nomor: {$item["nomor"]}, Kategori: {$item["kategori"]}\n";
    }
}

function tambahKontak(&$kontak):void {
    $nama = strtolower(trim(readline("nama: ")));
    while(true){
        $nomor = trim(readline("nomor: "));
        if (!str_starts_with($nomor, "08")) {
            echo "harus diawali 08xx\n";
            continue;
        }elseif(!is_numeric($nomor)){
            echo "input harus angka";
            continue;
        }
    }
    $kategori = trim(readline("kategori: "));

    $kontak [$nama] = [
        "nomor" => $nomor,
        "kategori" => $kategori
    ]; // masukkan input ke dalam array
}

function cariKontak():void {
    global $kontak;
    $nama_input = strtolower(trim(readline("Cari berdasarkan nama: ")));

    $kontak_ditemukan = false;
    foreach ($kontak as $nama => $item){
        //strpos outputnya 0. dalam if artinya bisa false. makanya pakai !== false
        if (strpos(strtolower($nama), $nama_input) !== false){
            echo "Nama: $nama, Nomor: {$item["nomor"]}, Kategori: {$item["nomor"]}";
            $kontak_ditemukan = true;
        }
    }
    if ($kontak_ditemukan === false) echo "kontak tidak ditemukan";
}

function hapusKontak(){
    global $kontak;
    $nama_input = strtolower(trim(readline("Cari berdasarkan nama: ")));

    $kontak_ditemukan = false;
    foreach ($kontak as $nama => $item){
        //strpos outputnya 0. dalam if artinya bisa false. makanya pakai !== false
        if (strpos(strtolower($nama), $nama_input) !== false){
            unset($kontak[$nama]);
            $kontak_ditemukan = true;
        }
    }
    if ($kontak_ditemukan === false) echo "kontak tidak ditemukan";
}