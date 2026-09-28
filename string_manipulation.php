<?php

$log_mentah = <<<LOG
2026-09-17 08:14:22 | 192.168.1.10  | GET  /produk        | 200 | 0.245
2026-09-17 08:15:03 | 192.168.1.42  | POST /login         | 401 | 0.512
2026-09-17 08:15:47 | 10.20.30.15   | GET  /keranjang     | 200 | 0.131
2026-09-17 08:16:11 | 192.168.1.10  | GET  /produk/detail | 404 | 0.089
2026-09-17 08:17:35 | 172.16.4.88   | POST /checkout      | 500 | 1.874
2026-09-17 08:18:02 | 10.20.30.15   | GET  /produk        | 200 | 0.203
LOG;

// ══════════════════════════════════════════════════════════════════
// DATA BAGIAN B — JANGAN DIUBAH
// ══════════════════════════════════════════════════════════════════
$csv_pelanggan = "  dr. BUDI santoso , +6281234567890 , budi@Mail.COM , 1500000\n"
               . "ANI wijaya, S.Kom , 081298765432 , ANI.W@example.co.id , 2750000\n"
               . " Cika  pertiwi , 6285711122233 , cika@mail.com , 980000\n"
               . "H. DEDI kurniawan , 081377788899 , dedi@MAIL.com , 4325000";

$gelar = ["dr.", "Dr.", "H.", "Hj.", ", S.Kom", ", S.T", ", M.M"];

//====================================================================================================

#BAGIAN A
echo "===== BAGIAN A: PARSER LOG AKSES =====\n";
$baris  = explode("\n", $log_mentah); // memisahkan baris baru
echo "Jumlah baris log: " . count($baris) . "\n";

$total_request = 0;
$error = 0;
$durasi = [];
$paling_lambat = ["endpoint" => "", "durasi" => 0.0];
$daftar_ip = [];
printf("%-8s %-18s %-6s %-20s %-6s %8s\n", "Jam", "IP (disamarkan)", "Method", "Endpoint", "Status", "Durasi");
echo str_repeat("-", 72) . PHP_EOL;
foreach($baris as $b){
    $bagian = explode("|", $b); //memisahkan |

    $waktu = trim($bagian[0]);
    $tanggal = substr($waktu, 0, strpos($waktu, " "));
    $jam = substr($waktu, strpos($waktu, " ") +1);

    $ip = trim($bagian[1]);
    $daftar_ip[] = $ip;
    $oktet = explode(".", $ip);
    $oktet[3] = "***";
    $ip_aman = implode(".", $oktet);

    $request = trim($bagian[2]);
    $metode = substr($request, 0, strpos($request, " "));
    $endpoint = trim(substr($request, strpos($request, " ")));

    $status = trim($bagian[3]);
    $durasi[] = (float)trim($bagian[4]);

    printf("%-8s %-18s %-6s %-20s %-6s %8s\n", $jam, $ip_aman, $metode, $endpoint, $status, $durasi[count($durasi)-1]);

    $total_request++;
    if (strpos($status, "5") === 0 ||  strpos($status, "4") === 0) $error++;
    if ($paling_lambat["durasi"] < (float)trim($bagian[4])) $paling_lambat = ["endpoint" => "$endpoint", "durasi" => (float)trim($bagian[4])];
}
echo str_repeat("-", 72) . PHP_EOL;

$persen_error = 100/($total_request/$error);
echo "Total request: $total_request\n";
echo "Request error: $error ($persen_error%)\n";
echo "Durasi rata2 : " . array_sum($durasi)/$total_request . "\n";
echo "Paling lambat: " . $paling_lambat["endpoint"] . " (" . $paling_lambat["durasi"] . ")\n\n";

echo "=== ANALISIS TEKS LOG ===\n";
echo "Mengandung '/checkout'?      : " . (str_contains($log_mentah, "/checkout") ? "Ya" : "Tidak") . PHP_EOL;
echo "Kemunculan '/produk'         : " . substr_count($log_mentah, "/produk") . " kali\n";
echo "Kemunculan 'GET'             : " . substr_count($log_mentah, "GET") . " kali\n";
echo "Posisi pertama '500'         : " . strpos($log_mentah, "500") . PHP_EOL;
echo "Posisi pertama '200'         : " . strpos($log_mentah, "200") . PHP_EOL;
echo "Diawali tanggal 2026?        : " . (str_starts_with($log_mentah, "2026") ? "Ya" : "Tidak") . PHP_EOL;
echo "IP unik yang tercatat        : " . count(array_unique($daftar_ip)) . " dari " . $total_request . "\n\n";

echo "===== BAGIAN B: PEMBERSIH DATA PELANGGAN =====\n";
printf ("%-4s %-20s %-16s %-26s %13s\n", "No", "Nama", "Telepon", "Email", "Total Belanja");
echo str_repeat("-", 83) . PHP_EOL;

$orang = explode("\n", $csv_pelanggan);
$no = 0;
$total = 0;
foreach ($orang as $o){
    $no++;
    $atribut = explode(",", $o);

    if (count($atribut) > 4) {
        $nama = trim($atribut[0] . $atribut[1]);
        $telepon = trim($atribut[2]);
        $email = trim($atribut[3]);
        $belanja = (float)trim($atribut[4]);
    }else{
        $nama = trim($atribut[0]);
        $telepon = trim($atribut[1]);
        $email = trim($atribut[2]);
        $belanja = (float)trim($atribut[3]);
    }
    $total += $belanja;

    foreach ($gelar as $g){
        $nama = trim(str_replace($g, "", $nama));
    }

    if(str_starts_with($telepon, "+62")){
        $telepon = "0" . substr($telepon, 3);
    }elseif(str_starts_with($telepon, "62")){
        $telepon = "0" . substr($telepon, 2);
    }

    $belanja = number_format(($belanja), 2, ",", ".");
    printf ("0%-3s %-20s %-16s %-26s %13s\n", $no, $nama, $telepon, $email, $belanja);
}
echo str_repeat("-", 83) . PHP_EOL;
printf ("TOTAL %77s\n", $belanja);