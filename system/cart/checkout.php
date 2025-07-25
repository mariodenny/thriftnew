<?php
session_start();
include '../../config.php';

$idproduk = $_POST['id_product'];

// SELECT CART
$select_cart = $server->query("SELECT * FROM `keranjang` WHERE `id_iklan`='$idproduk' AND `id_user`='$iduser'");
$cart_data = mysqli_fetch_assoc($select_cart);

// SELECT PRODUK
$select_iklan = $server->query("SELECT * FROM `iklan` WHERE `id`='$idproduk'");
$iklan_data = mysqli_fetch_assoc($select_iklan);

// SELECT LOKASI USER
$lokasi_user = $server->query("SELECT * FROM `lokasi_user` WHERE `id_user`='$iduser'");
$lokasi_user_data = mysqli_fetch_assoc($lokasi_user);

if ($_POST['tipe_checkout'] == 'keranjang') {
    $id_iklan = $cart_data['id_iklan'];
    $jumlah = $cart_data['jumlah'];
    $harga_k = $cart_data['harga_k'];
    $diskon_k = $cart_data['diskon_k'];
    $warna_k = $cart_data['warna_k'];
    $ukuran_k = $cart_data['ukuran_k'];
} else {
    $id_iklan = $iklan_data['id'];
    $jumlah = $_POST['jumlah_product'];
    $harga_k = $_POST['ukuran_harga_satuan_value_send'];
    $diskon_k = $iklan_data['diskon'];
    $warna_k = $_POST['warna_k_val'];
    $ukuran_k = $_POST['ukuran_k_val'];
}

// PENGECEKAN STOK LEBIH DETAIL
if ($iklan_data) {
    $stok_tersedia = $iklan_data['stok'];

    $query_terjual = "SELECT SUM(jumlah) as total_terjual FROM `invoice` 
                     WHERE `id_iklan`='$idproduk' 
                     AND `warna_i`='$warna_k' 
                     AND `ukuran_i`='$ukuran_k'
                     AND `tipe_progress` NOT IN ('dibatalkan', 'cancelled')";
    $result_terjual = $server->query($query_terjual);
    $data_terjual = mysqli_fetch_assoc($result_terjual);
    $total_terjual = $data_terjual['total_terjual'] ? $data_terjual['total_terjual'] : 0;

    $exclude_user = ($_POST['tipe_checkout'] == 'keranjang') ? " AND `id_user` != '$iduser'" : "";
    $query_keranjang = "SELECT SUM(jumlah) as total_keranjang FROM `keranjang` 
                       WHERE `id_iklan`='$idproduk' 
                       AND `warna_k`='$warna_k' 
                       AND `ukuran_k`='$ukuran_k' $exclude_user";
    $result_keranjang = $server->query($query_keranjang);
    $data_keranjang = mysqli_fetch_assoc($result_keranjang);
    $total_di_keranjang = $data_keranjang['total_keranjang'] ? $data_keranjang['total_keranjang'] : 0;

    $stok_tersisa = $stok_tersedia - $total_terjual - $total_di_keranjang;

    if ($stok_tersisa < $jumlah) {
        echo "<script>alert('Stok tidak mencukupi! Stok tersisa: $stok_tersisa item. Silakan kurangi jumlah produk.'); window.history.back();</script>";
        exit;
    } else {
        // LANGSUNG KURANGI STOK
        $server->query("UPDATE `iklan` SET `stok` = `stok` - $jumlah WHERE `id`='$id_iklan'");
    }
}

$time = date('Y-m-d H:i:s');
$tipe_progress = 'Belum Bayar';

$kurir = 'jne';
$id_kurir = '0';
$berat_barang = $iklan_data['berat'];

$cek_invoice = $server->query("SELECT * FROM `invoice` WHERE `id_iklan`='$idproduk' AND `id_user`='$iduser'");
$cek_invoice_data = mysqli_fetch_assoc($cek_invoice);

if ($cek_invoice_data) {
    $idinvoice_cko = $cek_invoice_data['idinvoice'];
    $update_invoice = $server->query("UPDATE `invoice` SET `jumlah`='$jumlah',`harga_i`='$harga_k',`diskon_i`='$diskon_k' WHERE `idinvoice`='$idinvoice_cko' AND `id_user`='$iduser'");
    $delete_cart_ck = $server->query("DELETE FROM `keranjang` WHERE `id_iklan`='$idproduk' AND `id_user`='$iduser'");
    if ($update_invoice || $delete_cart_ck) {
?>
        <script>
            window.location.href = "<?php echo $url; ?>checkout/detail/<?php echo $idinvoice_cko; ?>";
        </script>
    <?php
    }
} else {
    if ($lokasi_user_data) {
        $prov_inv = $lokasi_user_data['id_provinsi'] . ',' . $lokasi_user_data['provinsi'];
        $kota_inv = $lokasi_user_data['id_kota'] . ',' . $lokasi_user_data['kota'];
        $alengkap_inv = $lokasi_user_data['alamat_lengkap'];

        $kota_tujuan = $lokasi_user_data['id_kota'];

        // CALL API RAJAONGKIR (ERROR DIABAIKAN)
        $curl_jne = curl_init();
        curl_setopt_array($curl_jne, array(
            CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/calculate/district/domestic-cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$kota_id_toko&destination=$kota_tujuan&weight=$berat_barang&courier=$kurir&price=lowest",
            CURLOPT_HTTPHEADER => array(
                "key: $rajaongkir_key",
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));
        $response_cost_jne = curl_exec($curl_jne);
        $err_cost_jne = curl_error($curl_jne);
        curl_close($curl_jne);

        if ($err_cost_jne) {
            $harga_ongkir = 0;
            $kurir_ongkir = $kurir;
            $kurir_layanan_ongkir = 'REG';
            $etd_ongkir = '1-2';
        } else {
            $data_cost_jne = json_decode($response_cost_jne, true);
            if (isset($data_cost_jne['data']) && !empty($data_cost_jne['data'])) {
                $jne_data = null;
                foreach ($data_cost_jne['data'] as $courier_data) {
                    if (strtolower($courier_data['courier']) == strtolower($kurir)) {
                        $jne_data = $courier_data;
                        break;
                    }
                }
                if ($jne_data && isset($jne_data['costs']) && !empty($jne_data['costs'])) {
                    $selected_service = $jne_data['costs'][$id_kurir] ?? $jne_data['costs'][0];
                    $kurir_ongkir = $jne_data['courier'];
                    $kurir_layanan_ongkir = $selected_service['service'];
                    $etd_ongkir = $selected_service['cost'][0]['etd'];
                    $harga_ongkir = $selected_service['cost'][0]['value'] * $jumlah;
                } else {
                    $harga_ongkir = 0;
                    $kurir_ongkir = $kurir;
                    $kurir_layanan_ongkir = 'REG';
                    $etd_ongkir = '1-2';
                }
            } else {
                $harga_ongkir = 0;
                $kurir_ongkir = $kurir;
                $kurir_layanan_ongkir = 'REG';
                $etd_ongkir = '1-2';
            }
        }

        $insert_checkout = $server->query("INSERT INTO `invoice`(`id_iklan`, `id_user`, `jumlah`, `warna_i`, `ukuran_i`, `harga_i`, `diskon_i`, `kurir`, `id_kurir`, `layanan_kurir`, `etd`, `harga_ongkir`, `provinsi`, `kota`, `alamat_lengkap`, `waktu`, `tipe_progress`) 
            VALUES ('$id_iklan', '$iduser', '$jumlah', '$warna_k', '$ukuran_k', '$harga_k', '$diskon_k', '$kurir_ongkir', '$id_kurir', '$kurir_layanan_ongkir', '$etd_ongkir', '$harga_ongkir', '$prov_inv', '$kota_inv', '$alengkap_inv', '$time', '$tipe_progress')");
    } else {
        $insert_checkout = $server->query("INSERT INTO `invoice`(`id_iklan`, `id_user`, `jumlah`, `warna_i`, `ukuran_i`, `harga_i`, `diskon_i`, `kurir`, `id_kurir`, `waktu`, `tipe_progress`) 
            VALUES ('$id_iklan', '$iduser', '$jumlah', '$warna_k', '$ukuran_k', '$harga_k', '$diskon_k', '$kurir', '$id_kurir', '$time', '$tipe_progress')");
    }
    $delete_cart_ck = $server->query("DELETE FROM `keranjang` WHERE `id_iklan`='$idproduk' AND `id_user`='$iduser'");
    if ($insert_checkout || $delete_cart_ck) {
        $select_invoice = $server->query("SELECT * FROM `invoice` WHERE `id_iklan`='$idproduk' AND `id_user`='$iduser'");
        $invoice_data = mysqli_fetch_assoc($select_invoice);
        $idinvoice_cko = $invoice_data['idinvoice'];
    ?>
        <script>
            window.location.href = "<?php echo $url; ?>checkout/detail/<?php echo $idinvoice_cko; ?>";
        </script>
<?php
    }
}
?>