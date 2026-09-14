<?php

$data_mahasiswa = [];

while(true){
    $nama = trim(readline("Nama: "));
    if(strtolower($nama) == "selesai" || strtolower($nama) == "stop") break;

    do{
        $tugas = trim(readline("Tugas: "));
        $uts = trim(readline("UTS: "));
        $uas = trim(readline("UAS: "));

        if (is_numeric($tugas) && is_numeric($uts) && is_numeric($uas)){
            if (($tugas <0 || $tugas >100) || ($uts <0 || $uts >100) || ($uas <0 || $uas >100)){
                echo "nilai harus dalam rentang 0-100\n";
                continue; //validasi input 0-100
            }
            break; //validasi input berupa angka
        }else{
            echo "Input tidak valid\n";
            continue;
        }
        
    }while(true);

    $data_mahasiswa[$nama] = [
        "tugas" => $tugas,
        "uts" => $uts,
        "uas" => $uas
    ]; //masukkan data input ke array
}

if (empty($data_mahasiswa)) {
    echo "tidak ada data mahasiswa\n";
}else{
    $output = "";
    $output .= "\n============================================================\n";
    $output .= "                 REKAPITULASI NILAI MAHASISWA\n";
    $output .= "============================================================\n";
    $output .= "Nama            | Tugas | UTS | UAS | Nilai Akhir | Grade\n";
    $output .= "------------------------------------------------------------\n";
    foreach($data_mahasiswa as $nama => $item){
        $tugas = $item["tugas"];
        $uts = $item["uts"];
        $uas = $item["uas"];
        $nilai_akhir = hitungNilaiAkhir($tugas, $uts, $uas);
        $grade = tentukanGrade($nilai_akhir);

        $output .= sprintf("%-15s | %-5s | %-3s | %-3s | %-11s | %-5s\n", $nama, $tugas, $uts, $uas, $nilai_akhir, $grade);
    }
    $output .= "============================================================\n";
    $output .= "Total mahasiswa: " . count($data_mahasiswa) . "\n";

    $semuaNilaiAkhir = [];
    foreach($data_mahasiswa as $nilai){
        $tugas = $nilai["tugas"];
        $uts = $nilai["uts"];
        $uas = $nilai["uas"];
        $nilai_akhir = hitungNilaiAkhir($tugas, $uts, $uas);
        $semuaNilaiAkhir[] = $nilai_akhir;
    }
    $output .= "Niali rata-rata: " . array_sum($semuaNilaiAkhir)/count($data_mahasiswa) . "\n";
    $output .= "============================================================\n";

    file_put_contents("rekap_nilai.txt", $output); // menyimpan output ke dalam file
}

function hitungNilaiAkhir($tugas, $uts, $uas):float {
    return $tugas * 0.3 + $uts * 0.3 + $uas * 0.4;
}

function tentukanGrade($nilai_akhir):string {
    if($nilai_akhir >= 85){
        return "A";
    }elseif($nilai_akhir >= 70){
        return "B";
    }elseif($nilai_akhir >= 60){
        return "C";
    }elseif($nilai_akhir >= 50){
        return "D";
    }else{
        return "E";
    }
}