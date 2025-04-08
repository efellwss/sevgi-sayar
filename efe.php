<?php

if ($_GET['islem'] == "ekle") {
    $json_file = "mutluluklar.json";
    $ip_a = $_SERVER['REMOTE_ADDR'];
    $tarih_db = date('Y-m-d H.i.s');

    if (!file_exists($json_file)) {
        file_put_contents($json_file, json_encode([]));
    }

    $data = json_decode(file_get_contents($json_file), true);

    $bulundu = false;
    foreach ($data as $item) {
        if ($item['ip'] == $ip_a) {
            $bulundu = true;
            echo $item['id'];
            echo "<script>swal(
                '😉',
                'Tekrar Tekrar Mutluluklar Dilediğine göre düğünde bir çeyrek takarsın artık 😂',
                'success'
            )</script>";
            break;
        }
    }

    if (!$bulundu) {
        $yeni_id = count($data) + 1;
        $data[] = [
            "id" => $yeni_id,
            "ip" => $ip_a,
            "tarih" => $tarih_db
        ];

        file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
        
        echo $yeni_id;
        echo "<script>swal(
            '💝',
            'Mutluluğumuzu Paylaştığın İçin Teşekkürler',
            'success'
        )</script>";
    }
}
?>