<?php
include '../../config.php';

$iduser = $profile['id'];
$idproduk = $_POST['idproduk'];
$jumlah_produk = $_POST['jumlah_produk'];

$warna_value = $_POST['warna_value'];
$ukuran_value = $_POST['ukuran_value'];
$ukuran_harga_satuan_value_send = $_POST['ukuran_harga_satuan_value_send'];

$time = date("Y-m-d H:i:s");

// Ambil data produk
$select_produk = $server->query("SELECT * FROM `iklan` WHERE `id`='$idproduk'");
$produk = mysqli_fetch_assoc($select_produk);

if (!$produk) {
?>
    <script>
        alert('Produk tidak ditemukan.');
        window.history.back();
    </script>
    <?php
    exit;
}

$stok_tersedia = $produk['stok'];
$diskon_cart = $produk['diskon'];

// Cek apakah stok cukup
if ($stok_tersedia >= $jumlah_produk) {

    // Insert ke keranjang
    $insert_cart = $server->query("INSERT INTO `keranjang`
        (`id_iklan`, `id_user`, `jumlah`, `harga_k`, `diskon_k`, `warna_k`, `ukuran_k`, `waktu`)
        VALUES
        ('$idproduk', '$iduser', '$jumlah_produk', '$ukuran_harga_satuan_value_send', '$diskon_cart', '$warna_value', '$ukuran_value', '$time')");

    if ($insert_cart) {
        // // Kurangi stok langsung di tabel iklan
        // $new_stok = $stok_tersedia - $jumlah_produk;
        // $server->query("UPDATE `iklan` SET `stok`='$new_stok' WHERE `id`='$idproduk'");
    ?>
        <script>
            window.location.href = '<?php echo $url; ?>cart/';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Gagal menambahkan ke keranjang. Silakan coba lagi.');
            window.history.back();
        </script>
    <?php
    }
} else {
    ?>
    <script>
        alert('Maaf, stok tidak mencukupi. Stok tersisa: <?php echo $stok_tersedia; ?> item');
        window.history.back();
    </script>
<?php
}
?>