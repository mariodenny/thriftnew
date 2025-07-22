<?php
session_start();

// print_r($_SESSION);
include '../config.php';
// include '../system/location/provinsi.php';
// include '../system/location/kota.php';
require_once '../assets/composer/midtrans-php-master/Midtrans.php';

$id_invoice = $_GET['idinvoice'];
$invoice = $server->query("SELECT * FROM `invoice`, `iklan`, `kategori` WHERE invoice.idinvoice='$id_invoice' AND invoice.id_user='$iduser' AND invoice.id_iklan=iklan.id AND iklan.id_kategori=kategori.id");
$invoice_data = mysqli_fetch_assoc($invoice);
$berat_barang = $invoice_data['berat'];
$exp_gambar_id = explode(',', $invoice_data['gambar']);

// HARGA
$hitung_diskon_fs = ($invoice_data['diskon_i'] / 100) * $invoice_data['harga_i'];
$harga_diskon_fs = ($invoice_data['harga_i'] - $hitung_diskon_fs) * $invoice_data['jumlah'];
$harga_satuan = $harga_diskon_fs / $invoice_data['jumlah'];

if (!$invoice_data) {
    header("Location: " . $url);
}

// Data user
// $id_user = $_SESSION['login'];

// $query_user = $server->query("SELECT nama, email, no_wa FROM users WHERE id = '$id_user'");
// $data_user = $query_user->fetch_assoc();

// // print

require_once($_SERVER['DOCUMENT_ROOT'] . "/thriftnew/config.php");

// Fungsi reusable untuk GET API
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

// Ambil data provinsi
$headers = ["key: $rajaongkir_key"];
$url_provinsi = "https://rajaongkir.komerce.id/api/v1/destination/province";
list($res_provinsi, $err_provinsi) = apiRequestGet($url_provinsi, $headers);

$provinsi_isi_data = [];
$kota_per_provinsi = [];

if (!$err_provinsi) {
    $provinsi_data = json_decode($res_provinsi, true);
    if (isset($provinsi_data['data']) && is_array($provinsi_data['data'])) {
        $provinsi_isi_data = $provinsi_data['data'];

        // Ambil semua kota berdasarkan provinsi
        foreach ($provinsi_isi_data as $provinsi) {
            $prov_id = $provinsi['id'];
            $url_kota = "https://rajaongkir.komerce.id/api/v1/destination/city/$prov_id";

            list($res_kota, $err_kota) = apiRequestGet($url_kota, $headers);
            if (!$err_kota) {
                $kota_data = json_decode($res_kota, true);
                if (isset($kota_data['data']) && is_array($kota_data['data'])) {
                    $kota_per_provinsi[$prov_id] = $kota_data['data'];
                }
            }
        }
    }
}

// RAJA ONGKIR COST
if (!$invoice_data['kota'] == '') {
    $prov_exp_li = explode(',', $invoice_data['provinsi']);
    $kota_exp_li = explode(',', $invoice_data['kota']);
    $kota_tujuan  = $kota_exp_li[0];
    $kurir_ivd = $invoice_data['kurir'];
    $layanan_kurir_ivd = $invoice_data['layanan_kurir'];
    $etd_pengiriman_ivd = $invoice_data['etd'];
    $harga_ongkir = $invoice_data['harga_ongkir'];
} else {
    $harga_ongkir = 0;
}

$total_biaya = $harga_diskon_fs + $harga_ongkir;

// MIDTRANS
// Set your Merchant Server Key
\Midtrans\Config::$serverKey = $midtrans_server_key;
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

$order_id_midtrans = $id_invoice . '-midtrans-' . time();

$params = array(
    'transaction_details' => array(
        'order_id' => $order_id_midtrans,
        'gross_amount' => $total_biaya,
    ),
    'customer_details' => array(
        'first_name' => $profile['nama_lengkap'],
        // 'last_name' => 'pratama',
        'email' => $profile['email'],
        // 'phone' => '08111222333',
    ),
);
$snapToken = \Midtrans\Snap::getSnapToken($params);

// NOMOR REKENING
$select_norek = $server->query("SELECT * FROM `nomor_rekening` WHERE `idnorek`='1' ");
$data_norek = mysqli_fetch_assoc($select_norek);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="icon" href="../../assets/icons/<?php echo $logo; ?>" type="image/svg">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-rwRR5kz4E-kNnJs2"></script>
    <link rel="stylesheet" href="../../assets/css/checkout/detail.css">
</head>

<body id="body">
    <style>
        .btn-primary {
            background-color: #f13b7f;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: inline-block;
            text-align: center;
        }
    </style>
    <!-- SETTING LOKASI -->
    <div class="setting_lokasi" id="setting_lokasi">
        <div class="isi_setting_lokasi">
            <h1>Tentukan Alamat Pengiriman</h1>
            <div class="form_provinsi_kota">
                <div class="isi_form_provinsi_kota">
                    <select class="select" id="provinsi" onchange="changeProvinsi()">
                        <option value="" selected disabled hidden>Pilih Provinsi</option>
                        <?php foreach ($provinsi_isi_data as $prov) { ?>
                            <option value="<?= $prov['id']; ?>"><?= htmlspecialchars($prov['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="isi_form_provinsi_kota">
                    <select class="select" id="kota" disabled>
                        <option selected disabled hidden>Pilih Kota</option>
                    </select>
                </div>
            </div>
            <textarea class="textarea nama_lengkap" id="nama_lengkap" rows="1" placeholder="Nama Lengkap"></textarea>
            <textarea class="textarea nomor_telphone" id="nomor_telphone" rows="1" placeholder="Nomor Telphone"></textarea>
            <textarea class="textarea alamat_lengkap" id="alamat_lengkap" rows="3" placeholder="Alamat Lengkap"></textarea>
            <div class="button simpan_lokasi" id="simpan_lokasi" onclick="SimpanLlokasi('<?php echo $id_invoice; ?>')">
                <p>Simpan</p>
            </div>
            <div class="button simpan_lokasi" id="loading_lokasi">
                <img src="../../assets/icons/loading-w.svg">
            </div>
            <div class="button batal_lokasi" id="batal_lokasi" onclick="BatalLlokasi()">
                <p>Batalkan</p>
            </div>
        </div>
    </div>
    <!-- SETTING LOKASI -->

    <!-- UBAH ONGKIR -->
    <div class="ubah_ongkir" id="ubah_ongkir">
        <div class="ubah_ongkir_isi">
            <div class="close_ubah_ongkir" onclick="CloseUbahOngkir()">
                <i class="ri-close-line"></i>
            </div>
            <h1>Opsi Pengiriman</h1>
            <center><img src="../../assets/icons/loading-o.svg" class="loading_ubah_ongkir" id="loading_ubah_ongkir"></center>
            <div class="res_ubah_ongkir" id="res_ubah_ongkir"></div>
        </div>
    </div>
    <!-- UBAH ONGKIR -->

    <!-- TRANSFER MANUAL -->
    <div class="back_transfer_manual" id="back_transfer_manual">
        <div class="transfer_manual">
            <!-- Ikon X untuk menutup -->
            <span class="close_button" id="close_button">&times;</span>

            <h1>Selesaikan Pembayaran</h1>
            <div class="box_transfer_manual">
                <div class="isi_box_transfer_manual">
                    <h5>BANK <?php echo $data_norek['nama_bank']; ?></h5>
                    <h6>a.n <?php echo $data_norek['an']; ?></h6>
                </div>
                <div class="isi_box_transfer_manual">
                    <h4>Nomor Rekening</h4>
                    <h2><?php echo $data_norek['norek']; ?></h2>
                </div>
                <div class="isi_box_transfer_manual">
                    <h4>Harga Yang Dibayarkan</h4>
                    <h2>Rp <?php echo number_format($total_biaya, 0, ".", "."); ?></h2>
                </div>
                <div class="isi_box_transfer_manual">
                    <h4 class="p_input">Upload Bukti Transfer</h4>
                    <input type="file" class="input" id="inp_bukti_transfer" accept="image/*" onchange="change_image()">
                    <p class="alert_file_npng_bt" id="alert_file_npng_bt">Pastikan file berformat jpg/png</p>
                </div>
                <p></p>
                <div class="isi_box_transfer_manual">
                    <div class="button" id="ubt" onclick="upload_bukti_transfer_manual('<?php echo $id_invoice; ?>', '<?php echo $data_norek['nama_bank']; ?>')">
                        <p>Upload Bukti Transfer</p>
                    </div>
                    <div class="button" id="loading_ubt">
                        <img src="../../assets/icons/loading-w.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TRANSFER MANUAL -->

    <!-- HEADER -->
    <?php include '../partials/header.php'; ?>
    <!-- HEADER -->



    <div class="width">
        <div class="checkout">
            <div class="alamat">
                <div class="box_alamat">
                    <h1><i class="ri-map-pin-2-line"></i> Alamat Pengiriman</h1>
                    <h5 id="ubah_alamat" onclick="ubahAlamat()">UBAH</h5>
                </div>
                <?php
                // Cek apakah alamat invoice tersedia
                if (!empty($invoice_data['kota'])) {
                    echo "<p>";
                    echo htmlspecialchars($invoice_data['alamat_lengkap']) . ", ";
                    echo htmlspecialchars($kota_exp_li[1]) . ", ";
                    echo htmlspecialchars($prov_exp_li[1]) . ", Indonesia<br>";

                    // Tambahkan info user dari session
                    echo "Nama: " . htmlspecialchars($_SESSION['nama_lengkap'] ?? 'User') . "<br>";
                    echo "Email: " . htmlspecialchars($_SESSION['email']) . "<br>";
                    echo "WhatsApp: " . htmlspecialchars($_SESSION['whatsapp']);
                    echo "</p>";
                } else {
                    echo "<p>Alamat pengiriman belum ditentukan</p>";
                }
                ?>
            </div>

            <div class="detail_checkout">
                <h1>Produk Dipesan</h1>
                <div class="box_detail_checkout">
                    <div class="rincian_checkout">
                        <img src="../../assets/image/product/<?php echo $exp_gambar_id[0]; ?>" alt="">
                        <div class="judul_rincian_checkout">
                            <h1><?php echo $invoice_data['judul']; ?></h1>
                            <p>Kategori <span><?php echo $invoice_data['nama']; ?></span></p>
                            <p>Total Produk <span><?php echo $invoice_data['jumlah']; ?></span></p>
                        </div>
                    </div>
                    <div class="box_harga_satuan_checkout">
                        <div class="harga_satuan_checkout">
                            <p>Harga Satuan</p>
                            <h5>Rp <?php echo number_format($harga_satuan, 0, ".", "."); ?></h5>
                        </div>
                        <div class="harga_satuan_checkout">
                            <p>Jumlah</p>
                            <h5><?php echo $invoice_data['jumlah']; ?></h5>
                        </div>
                        <div class="harga_satuan_checkout" id="subtotal_produk">
                            <p>Subtotal Produk</p>
                            <h5>Rp <?php echo number_format($harga_diskon_fs, 0, ".", "."); ?></h5>
                        </div>
                    </div>
                </div>
                <?php
                if (!$invoice_data['kota'] == '') {
                ?>
                    <div class="opsi_pengiriman">
                        <div class="isi_opsi_pengiriman_1">
                            <h5>Opsi Pengiriman:</h5>
                        </div>
                        <div class="box_isi_opsi_pengiriman">
                            <div class="isi_opsi_pengiriman">
                                <h4 id="ubah_onkirrrr" onclick="UbahOngkir('<?php echo $kota_tujuan; ?>')">UBAH</h4>
                            </div>
                            <div class="isi_opsi_pengiriman isi_opsi_pengiriman_nk">
                                <h5><?php echo strtoupper($kurir_ivd); ?> <?php echo $layanan_kurir_ivd; ?></h5>
                                <p>Perkiraan sampai <?php echo $etd_pengiriman_ivd; ?> hari</p>
                            </div>
                            <div class="isi_opsi_pengiriman isi_opsi_pengiriman_hg">
                                <h5>Rp <?php echo number_format($harga_ongkir, 0, ".", "."); ?></h5>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <script>
                        setting_lokasi.style.display = 'flex';
                        batal_lokasi.style.display = 'none';
                    </script>
                <?php
                }
                ?>
                <div class="total_pesanan">
                    <p>Total Pesanan:</p>
                    <?php
                    if (!$invoice_data['kota'] == '') {
                    ?>
                        <h5><span>Rp</span> <?php echo number_format($total_biaya, 0, ".", "."); ?></h5>
                    <?php
                    } else {
                    ?>
                        <h5><span>Rp</span> <?php echo number_format($harga_diskon_fs, 0, ".", "."); ?></h5>
                    <?php
                    }
                    ?>
                </div>
            </div>


            <div class="button_bayar">
                <?php if ($invoice_data['tipe_progress'] == 'Belum Bayar') { ?>
                    <form method="POST" action="../../system/checkout/request-cancel.php" onsubmit="return confirm('Ajukan pembatalan pesanan?')">
                        <input type="hidden" name="idinvoice" value="<?= $invoice_data['idinvoice'] ?>">
                        <button class="button btn-primary" type="submit" style="margin-right:10px; color:white; font-weight:bold;">Batalkan Pesanan</button>
                    </form>
                <?php } ?>
                <?php if ($invoice_data['tipe_progress'] == 'Menunggu Persetujuan Pembatalan') : ?>
                    <div class="status-info">
                        <p style="color: #FFA500; font-weight:bold;">Pesanan menunggu persetujuan pembatalan oleh admin.</p>
                    </div>
                <?php endif; ?>

                <?php if ($invoice_data['bukti_transfer'] == '') { ?>
                    <div class="box_bayar">
                        <?php if ($nama_tipe_pembayaran == 'Midtrans') { ?>
                            <div class="button" id="pay-button">
                                <p>Bayar Sekarang</p>
                            </div>
                        <?php } elseif ($nama_tipe_pembayaran == 'Manual') { ?>
                            <div class="button" onclick="pembayaran_manual_show()">
                                <p>Bayar Sekarang</p>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <h1 class="p_mokf_manual">Menunggu Konfirmasi</h1>
                <?php } ?>
            </div>

        </div>
    </div>
    <input type="hidden" id="id_invoice" value="<?php echo $id_invoice; ?>">
    <input type="hidden" id="berat_barang" value="<?php echo $berat_barang; ?>">
    <input type="hidden" id="jumlah_barang" value="<?php echo $invoice_data['jumlah']; ?>">
    <div id="res"></div>


    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        // For example trigger on button clicked, or any time you need
        payButton.addEventListener('click', function() {
            snap.pay('<?php echo $snapToken; ?>'); // Replace it with your transaction token
        });
    </script>

    <script>
        const dataKota = <?php echo json_encode($kota_per_provinsi); ?>;
        console.log('====================================');
        console.log(dataKota);
        console.log('====================================');

        function changeProvinsi() {
            const provinsiId = document.getElementById('provinsi').value;
            const kotaSelect = document.getElementById('kota');

            kotaSelect.innerHTML = '<option selected disabled hidden>Pilih Kota</option>';
            kotaSelect.disabled = true;

            if (dataKota[provinsiId]) {
                dataKota[provinsiId].forEach(kota => {
                    const opt = document.createElement('option');
                    opt.value = kota.city_id + ',' + kota.city_name;
                    opt.textContent = kota.city_name;
                    kotaSelect.appendChild(opt);
                });
                kotaSelect.disabled = false;
            }
        }
    </script>


    <!-- CONTENT -->

    <!-- FOOTER -->
    <?php include '../partials/footer.php'; ?>
    <!-- FOOTER -->

    <!-- JS -->
    <script src="../../assets/js/checkout/detail.js"></script>
    <!-- JS -->
</body>
<script>
    // JavaScript untuk menutup elemen ketika ikon "X" diklik
    document.getElementById("close_button").onclick = function() {
        document.getElementById("back_transfer_manual").style.display = "none";
    }
</script>

</html>