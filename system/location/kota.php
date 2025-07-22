<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/thriftnew/config.php");

function apiGet($url, $headers = [])
{
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => $headers,
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    return [$response, $error];
}

header('Content-Type: text/html; charset=UTF-8');

echo '<option value="" selected disabled hidden>Pilih Kota</option>';

$exp_id_provinsi = explode(',', $_POST['id_provinsi'] ?? '');
$id_provinsi = trim($exp_id_provinsi[0] ?? '');

if (!$id_provinsi || !is_numeric($id_provinsi)) {
    echo '<option disabled>ID Provinsi tidak valid</option>';
    exit;
}

$url = "https://rajaongkir.komerce.id/api/v1/destination/city/{$id_provinsi}";
$headers = ["key: $rajaongkir_key"];

list($res_kota, $err_kota) = apiGet($url, $headers);

if ($err_kota) {
    echo "<option disabled>Terjadi kesalahan: $err_kota</option>";
} else {
    $data = json_decode($res_kota, true);
    // print_r($data);
    if (isset($data['data']) && is_array($data['data'])) {
        foreach ($data['data'] as $kota) {
            $id = htmlspecialchars($kota['city_id']);
            $name = htmlspecialchars($kota['city_name']);
            echo "<option value=\"{$id},{$name}\">{$name}</option>";
        }
    } else {
        echo "<option disabled>Tidak ada data kota ditemukan</option>";
    }
}
