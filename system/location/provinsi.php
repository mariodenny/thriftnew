<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/thriftnew/config.php");

function apiRequestGet($url, $headers = [])
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

// RAJA ONGKIR KOMERCE
$headers = ["key: $rajaongkir_key"];
$url = "https://rajaongkir.komerce.id/api/v1/destination/province";

list($res_provinsi, $err_provinsi) = apiRequestGet($url, $headers);

$provinsi_isi_data = [];

if ($err_provinsi) {
    error_log("RajaOngkir Error: " . $err_provinsi);
} else {
    $provinsi_data = json_decode($res_provinsi, true);
    // print_r($provinsi_data);

    if (isset($provinsi_data['data']) && is_array($provinsi_data['data'])) {
        $provinsi_isi_data = $provinsi_data['data'];
    } else {
        $provinsi_isi_data = [];
        error_log("Response Komerce RajaOngkir tidak valid.");
    }
}
