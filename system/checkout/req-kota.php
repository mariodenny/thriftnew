<option value="" selected disabled hidden>Pilih Kecamatan</option>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/thriftnew/config.php");

$city_id = $_POST['id_kota'] ?? '';

if (!$city_id || !is_numeric($city_id)) {
    echo '<option disabled>ID Kota tidak valid</option>';
    exit;
}

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/district/$city_id",
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

$response = curl_exec($curl);
$error = curl_error($curl);
curl_close($curl);

if ($error) {
    echo "<option disabled>cURL Error: $error</option>";
} else {
    $data = json_decode($response, true);
    if (isset($data['data']) && is_array($data['data'])) {
        foreach ($data['data'] as $district) {
            echo '<option value="' . $district['id'] . '">' . $district['name'] . '</option>';
        }
    } else {
        echo "<option disabled>Tidak ada kecamatan ditemukan</option>";
    }
}
?>