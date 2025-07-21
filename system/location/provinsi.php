<?php
// RAJA ONGKIR PROVINSI
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: $rajaongkir_key"
    ),
));

$res_provinsi = curl_exec($curl);
$err_provinsi = curl_error($curl);
curl_close($curl);

$provinsi_isi_data = [];

if ($err_provinsi) {
    // Simpan log atau tampilkan error jika perlu
    error_log("RajaOngkir Error: " . $err_provinsi);
} else {
    $provinsi_data = json_decode($res_provinsi, true);

    // Cek apakah index yang dibutuhkan tersedia
    if (
        isset($provinsi_data['rajaongkir']) &&
        isset($provinsi_data['rajaongkir']['results']) &&
        is_array($provinsi_data['rajaongkir']['results'])
    ) {
        $provinsi_isi_data = $provinsi_data['rajaongkir']['results'];
    } else {
        // Jika gagal ambil data valid, kosongkan dan optionally beri log
        $provinsi_isi_data = [];
        error_log("RajaOngkir response tidak valid atau quota habis.");
    }
}
