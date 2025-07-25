<?php
include '../config.php';

$idproduct = $_GET['idproduct'];
$product = $server->query("SELECT * FROM `iklan`, `kategori` WHERE iklan.id='$idproduct' AND iklan.id_kategori=kategori.id ");
$product_data = mysqli_fetch_assoc($product);
// print_r($product_data['stok']);
$terjual = mysqli_num_rows($server->query("SELECT * FROM `invoice` WHERE `id_iklan`='$idproduct'"));
if ($product_data) {
    $hitung_diskon_fs = ($product_data['diskon'] / 100) * $product_data['harga'];
    $harga_diskon_fs = $product_data['harga'] - $hitung_diskon_fs;

    $select_rating_vp = $server->query("SELECT * FROM `akun`, `invoice`, `rating` WHERE invoice.id_iklan='$idproduct' AND rating.id_invoice_rat=invoice.idinvoice AND invoice.id_user=akun.id ORDER BY `rating`.`idrating` DESC ");
    $jumlah_rating_vp = mysqli_num_rows($select_rating_vp);

    $rata_rating_vp = $server->query("SELECT AVG(star_rat) AS rata_rat FROM rating, invoice WHERE invoice.id_iklan='$idproduct' AND rating.id_invoice_rat=invoice.idinvoice ");
    $data_rata_rating_vp = mysqli_fetch_assoc($rata_rating_vp);
    $hasil_rata_rat = substr($data_rata_rating_vp['rata_rat'], 0, 3);
    $for_star_loop = substr($data_rata_rating_vp['rata_rat'], 0, 1);
    $after_dot_rat = substr($data_rata_rating_vp['rata_rat'], 2, 1);
} else {
    header("location: " . $url);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
    <title><?php echo $product_data['judul']; ?></title>
    <link rel="icon" href="../../assets/icons/<?php echo $logo; ?>" type="image/svg">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../assets/css/product/view.css">
</head>

<body>
    <!-- PILIH VARIAN PRODUK -->
    <div class="back_varian_produk" id="back_varian_produk">
        <div class="varian_produk">
            <i class="fas fa-window-close close_varian_produk" onClick="close_back_varian_produk()"></i>
            <?php
            if (!$product_data['warna'] == '') {
            ?>
                <div class="varian_ukuran">
                    <h1>Warna</h1>
                    <div class="box_select_varian">
                        <?php
                        $exp_warna_vp = explode(',', $product_data['warna']);
                        foreach ($exp_warna_vp as $key_warna_vp => $value_warna_vp) {
                        ?>
                            <div class="isi_box_select_varian c_id_varian_warna" id="id_varian_warna<?php echo $key_warna_vp; ?>" onClick="click_varian_warna('<?php echo $key_warna_vp; ?>', '<?php echo $value_warna_vp; ?>')"><?php echo $value_warna_vp; ?></div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
            if (!$product_data['ukuran'] == '') {
            ?>
                <div class="varian_ukuran">
                    <h1>Size</h1>
                    <div class="box_select_varian">
                        <?php
                        $exp_ukuran_vp = explode(',', $product_data['ukuran']);
                        foreach ($exp_ukuran_vp as $key_ukuran_vp => $value_ukuran_vp) {
                            $exp_ukuran_saja_vp = explode('===', $value_ukuran_vp);
                            $hitung_diskon_vp = ($product_data['diskon'] / 100) * $exp_ukuran_saja_vp[1];
                            $harga_diskon_vp = $exp_ukuran_saja_vp[1] - $hitung_diskon_vp;
                        ?>
                            <div class="isi_box_select_varian c_id_varian_ukuran" id="id_varian_ukuran<?php echo $key_ukuran_vp; ?>" onClick="click_varian_ukuran('<?php echo $key_ukuran_vp; ?>', '<?php echo $exp_ukuran_saja_vp[0]; ?>', '<?php echo $harga_diskon_vp; ?>', '<?php echo $exp_ukuran_saja_vp[1]; ?>')"><?php echo $value_ukuran_vp[0]; ?></div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="harga_varian_produk">
                <p>Jumlah</p>
                <div class="box_pm_jumlah">
                    <button type="button" class="box_button_jumlah" id="btn-kurang" onclick="kurang()">
                        <img src="../../assets/icons/kurang.svg" alt="Kurang">
                    </button>
                    <div class="box_hasil_jumlah">
                        <input type="text" value="1" id="jumlah_produk" readonly>
                    </div>
                    <button type="button" class="box_button_jumlah" id="btn-tambah" onclick="tambah(1)">
                        <img src="../../assets/icons/tambah.svg" alt="Tambah">
                    </button>
                </div>
            </div>
            <div class="harga_varian_produk">
                <p>Harga</p>
                <h1>Rp <span id="harga_varian_produk"><?php echo number_format($harga_diskon_fs, 0, ".", "."); ?></span></h1>
                <!-- <p>Total Harga</p>
                <h1>Rp <span id="total_harga_produk"><?php echo number_format($harga_diskon_fs, 0, ".", "."); ?></span></h1> -->
            </div>

            <input type="hidden" id="ukuran_harga_satuan_value" value="<?php echo $harga_diskon_fs; ?>">

            <input type="hidden" id="warna_value">
            <input type="hidden" id="ukuran_value">
            <input type="hidden" id="ukuran_harga_value" value="<?php echo $harga_diskon_fs; ?>">
            <input type="hidden" id="ukuran_harga_satuan_value" value="<?php echo $harga_diskon_fs; ?>">
            <input type="hidden" id="ukuran_harga_satuan_value_send" value="<?php echo $product_data['harga']; ?>">
            <div class="box_button_varian" id="buvar_masukkan_keranjang">
                <div class="button" id="masukan_keranjang" onClick="addcart('<?php echo $idproduct; ?>')">
                    <p>Masukkan Keranjang</p>
                </div>
                <div class="button" id="loading_masukan_keranjang">
                    <img src="../../assets/icons/loading-w.svg" alt="">
                </div>
            </div>
            <div class="box_button_varian" id="buvar_beli_sekarang">
                <div class="button" id="beli_sekarang" onClick="checkout('<?php echo $idproduct; ?>',)">
                    <p>Beli Sekarang</p>
                </div>
                <div class="button" id="loading_beli_sekarang">
                    <img src="../../assets/icons/loading-w.svg" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- PILIH VARIAN PRODUK -->

    <!-- HEADER -->
    <?php include '../partials/header.php'; ?>
    <!-- HEADER -->

    <!-- CONTENT -->

    <div class="width">
        <?php
        if (isset($_COOKIE['login'])) {
        ?>

            <!-- PRODUK -->
            <div class="product">
                <div class="detail_product">
                    <div class="foto_product">
                        <div class="owl-carousel owl-theme">
                            <?php
                            $exp_gambar_vi = explode(',', $product_data['gambar']);
                            foreach ($exp_gambar_vi as $key_exp_gambar_vi => $value_exp_gambar_vi) {
                            ?>
                                <img src="../../assets/image/product/<?php echo $value_exp_gambar_vi; ?>">
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="deskripsi_product">
                        <h1><?php echo $product_data['judul']; ?></h1>
                        <div class="box_rate_product">
                            <?php
                            if ($jumlah_rating_vp) {
                            ?>
                                <div class="isi_box_rate_product">
                                    <h5><?php echo $hasil_rata_rat; ?></h5>
                                    <?php
                                    for ($j_icon_star = 1; $j_icon_star <= $for_star_loop; $j_icon_star++) {
                                    ?>
                                        <i class="ri-star-fill"></i>
                                    <?php
                                    }
                                    if ($after_dot_rat > 0) {
                                    ?>
                                        <i class="ri-star-half-fill"></i>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <span></span>
                            <?php
                            }
                            ?>
                            <div class="isi_box_rate_product">
                                <h4><?php echo $jumlah_rating_vp; ?></h4>
                                <p>Penilaian</p>
                            </div>
                            <span></span>
                            <div class="isi_box_rate_product">
                                <h4><?php echo $terjual; ?></h4>
                                <p>Terjual</p>
                            </div>
                        </div>
                        <div class="harga_box">
                            <div class="isi_harga_box">
                                <?php
                                if ($product_data['tipe_iklan'] == "flash sale") {
                                ?>
                                    <h3><span>Rp</span> <del><?php echo number_format($product_data['harga'], 0, ".", "."); ?></del></h3>
                                    <h2><span>Rp</span> <?php echo number_format($harga_diskon_fs, 0, ".", "."); ?></h2>
                                <?php
                                } else {
                                ?>
                                    <h2><span>Rp</span> <?php echo number_format($product_data['harga'], 0, ".", "."); ?></h2>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                            if ($product_data['tipe_iklan'] == "flash sale") {
                            ?>
                                <div class="isi_harga_flashsale">
                                    <i class="ri-flashlight-fill"></i>
                                    <p>Flash Sale</p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="rincian_product">
                            <div class="isi_rincian_product">
                                <h5>Kategori</h5>
                                <p><?php echo $product_data['nama']; ?></p>
                            </div>
                            <div class="isi_rincian_product">
                                <h5>Total Stok</h5>
                                <p><?php echo $product_data['stok']; ?></p>
                            </div>
                            <div class="isi_rincian_product">
                                <h5>Stok Tersisa</h5>
                                <p><?php echo $product_data['stok'] - $product_data['terjual']; ?></p>
                            </div>
                            <div class="isi_rincian_product">
                                <h5>Dikirim Dari</h5>
                                <p><?php echo $kota_toko . ' ' . $provinsi_toko; ?></p>
                            </div>
                        </div>
                        <div class="add_cart">
                            <div class="button_box_cart">
                                <div class="masukan_keranjang" id="masukan_keranjang2" onClick="view_addcart()">
                                    <i class="ri-shopping-bag-line"></i>
                                    <p>Masukkan Keranjang</p>
                                </div>
                                <div class="masukan_keranjang" id="loading_keranjang">
                                    <img src="../../assets/icons/loading-o.svg" alt="">
                                </div>
                                <div class="masukan_keranjang" id="hapus_keranjang" onClick="removecart('<?php echo $idproduct; ?>')">
                                    <i class="ri-delete-bin-7-line"></i>
                                    <p>Hapus Dari Keranjang</p>
                                </div>
                                <?php
                                $cart = $server->query("SELECT * FROM `keranjang` WHERE `id_iklan`='$idproduct' AND `id_user`='$iduser'");
                                $cart_data = mysqli_fetch_assoc($cart);
                                if ($cart_data) {
                                ?>
                                    <script>
                                        masukan_keranjang2.style.display = 'none';
                                        hapus_keranjang.style.display = 'flex';
                                    </script>
                                <?php
                                } else {
                                ?>
                                    <script>
                                        masukan_keranjang2.style.display = 'flex';
                                        hapus_keranjang.style.display = 'none';
                                    </script>
                                <?php
                                }
                                ?>
                                <div class="beli_sekarang" onClick="view_checkout()">
                                    <p>Beli Sekarang</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DESKRIPSI -->
            <div class="content_view">
                <div class="cv_title">
                    <p>Deskripsi Produk</p>
                </div>
                <div class="isi_cv">
                    <p><?php echo nl2br($product_data['deskripsi']); ?></p>
                </div>
            </div>
            <!-- PENILAIAN PRODUK -->
            <div class="content_view">
                <div class="cv_title">
                    <p>Penilaian Produk</p>
                    <p><?php echo $jumlah_rating_vp; ?></p>
                </div>
                <div class="isi_cv">
                    <?php
                    if ($jumlah_rating_vp) {
                    ?>
                        <div class="box_isi_rating">
                            <?php
                            while ($data_rating_vp = mysqli_fetch_assoc($select_rating_vp)) {
                                $jstar_user_vp = $data_rating_vp['star_rat'];
                            ?>
                                <div class="isi_user_rating">
                                    <img src="../../assets/image/profile/<?php echo $data_rating_vp['foto']; ?>" alt="">
                                    <div class="text_isi_user_rating">
                                        <div class="name_text_isi_user_rating">
                                            <h5><?php echo $data_rating_vp['nama_lengkap']; ?></h5>
                                            <p><?php echo $data_rating_vp['waktu_rat']; ?></p>
                                        </div>
                                        <div class="star_user_rating">
                                            <?php
                                            for ($lstarurat = 1; $lstarurat <= $jstar_user_vp; $lstarurat++) {
                                            ?>
                                                <i class="ri-star-fill"></i>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <h3 class="desk_rat_usr"><?php echo $data_rating_vp['deskripsi_rat']; ?></h3>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    } else {
                    ?>
                        <p>Belum ada penilaian</p>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="back_add_card"></div>
            <div id="res" style="display: block;"></div>
        <?php
        } else {
            include '../partials/belum-login.php';
        }
        ?>
    </div>
    <!-- CONTENT -->

    <!-- FOOTER -->
    <?php include '../partials/footer.php'; ?>
    <!-- FOOTER -->

    <!-- JS -->
    <script>
        const btnTambah = document.getElementById("btn-tambah");
        const btnKurang = document.getElementById("btn-kurang");
        const inputJumlah = document.getElementById("jumlah_produk");
        const stokTersedia = <?php echo $product_data['stok'] - $product_data['terjual']; ?>;

        btnTambah.addEventListener("click", () => {
            let jumlah = parseInt(inputJumlah.value);
            if (jumlah < stokTersedia) {
                jumlah += 1;
                inputJumlah.value = jumlah;
                updateTotal(jumlah);
            }
        });

        btnKurang.addEventListener("click", () => {
            let jumlah = parseInt(inputJumlah.value);
            if (jumlah > 1) {
                jumlah -= 1;
                inputJumlah.value = jumlah;
                updateTotal(jumlah);
            }
        });
    </script>

    <script>
        function kurang() {
            if (jumlah_produk.value > 1) {
                var kurang_jumlah = parseInt(jumlah_produk.value) - parseInt(1);
                jumlah_produk.value = kurang_jumlah;
                var ukuran_harga_value_id = ukuran_harga_satuan_value.value * kurang_jumlah;
                ukuran_harga_value.value = ukuran_harga_value_id;
                harga_varian_produk.innerHTML = rubah(ukuran_harga_value_id);
            }
        }

        function tambah(max_jumlah) {
            if (jumlah_produk.value < max_jumlah) {
                var tambah_jumlah = parseInt(jumlah_produk.value) + parseInt(1);
                jumlah_produk.value = tambah_jumlah;
                var ukuran_harga_value_id = ukuran_harga_satuan_value.value * tambah_jumlah;
                ukuran_harga_value.value = ukuran_harga_value_id;
                harga_varian_produk.innerHTML = rubah(ukuran_harga_value_id);
            }
        }

        function updateTotal() {
            var jumlah = parseInt(document.getElementById("jumlah_produk").value);
            var satuan = parseInt(document.getElementById("ukuran_harga_satuan_value").value);
            var total = jumlah * satuan;
            document.getElementById("total_harga_produk").innerText = rubah(total);
        }

        window.onload = function() {

        }

        $('.owl-carousel').owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true
        })

        function rubah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return ribuan;
        }



        function addcart(idproduk) {
            var data_add_cart = new FormData();
            data_add_cart.append("idproduk", idproduk);
            data_add_cart.append("jumlah_produk", document.getElementById('jumlah_produk').value);
            data_add_cart.append("warna_value", document.getElementById('warna_value').value);
            data_add_cart.append("ukuran_value", document.getElementById('ukuran_value').value);
            data_add_cart.append("ukuran_harga_satuan_value_send", document.getElementById('ukuran_harga_satuan_value_send').value);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 1) {
                    masukan_keranjang.style.display = 'none';
                    loading_masukan_keranjang.style.display = 'flex';
                }
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('res').innerHTML = this.responseText;
                    var getscriptres = document.getElementsByTagName('script');
                    for (var i = 0; i < getscriptres.length - 0; i++) {
                        if (getscriptres[i + 0].text != null) eval(getscriptres[i + 0].text);
                    }
                }
            }
            xhttp.open("POST", "../../system/cart/add.php", true);
            xhttp.send(data_add_cart);
        }

        function removecart(idproduk) {
            console.log(idproduk);
            var data_remove_cart = new FormData();
            data_remove_cart.append('id_product', idproduk);
            data_remove_cart.append('page_product', 'produk view');
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 1) {
                    masukan_keranjang2.style.display = 'none';
                    loading_keranjang.style.display = 'flex';
                    hapus_keranjang.style.display = 'none';
                }
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('res').innerHTML = this.responseText;
                    var getscriptres = document.getElementsByTagName('script');
                    for (var i = 0; i < getscriptres.length - 0; i++) {
                        if (getscriptres[i + 0].text != null) eval(getscriptres[i + 0].text);
                    }
                }
            }
            xhttp.open("POST", "../../system/cart/remove.php", true);
            xhttp.send(data_remove_cart);
        }

        function checkout(idproduk) {
            var data_checkout_cart = new FormData();
            data_checkout_cart.append('id_product', idproduk);
            data_checkout_cart.append('jumlah_product', document.getElementById('jumlah_produk').value);
            data_checkout_cart.append('ukuran_harga_satuan_value_send', document.getElementById('ukuran_harga_satuan_value_send').value);
            data_checkout_cart.append('warna_k_val', document.getElementById('warna_value').value);
            data_checkout_cart.append('ukuran_k_val', document.getElementById('ukuran_value').value);
            data_checkout_cart.append('tipe_checkout', 'beli_langsung');
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 1) {
                    beli_sekarang.style.display = 'none';
                    loading_beli_sekarang.style.display = 'flex';
                }
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('res').innerHTML = this.responseText;
                    var getscriptres = document.getElementsByTagName('script');
                    for (var i = 0; i < getscriptres.length - 0; i++) {
                        if (getscriptres[i + 0].text != null) eval(getscriptres[i + 0].text);
                    }
                }
            }
            xhttp.open("POST", "../../system/cart/checkout.php", true);
            xhttp.send(data_checkout_cart);
        }

        function click_varian_warna(key_warna_vp, value_warna_vp) {
            x_warna_vp = document.querySelectorAll(".c_id_varian_warna");
            for (i_x_warna_vp = 0; i_x_warna_vp < x_warna_vp.length; i_x_warna_vp++) {
                x_warna_vp[i_x_warna_vp].className = 'isi_box_select_varian c_id_varian_warna';
            }

            var add_id_varian_warna = 'id_varian_warna' + key_warna_vp;
            document.getElementById(add_id_varian_warna).className = 'isi_box_select_varian_active c_id_varian_warna';
            warna_value.value = value_warna_vp;
        }

        function click_varian_ukuran(key_ukuran_vp, value_ukuran_vp, value_harga_ukuran_vp, value_harga_ukuran_vp_send) {
            x_ukuran_vp = document.querySelectorAll(".c_id_varian_ukuran");
            for (i_x_ukuran_vp = 0; i_x_ukuran_vp < x_ukuran_vp.length; i_x_ukuran_vp++) {
                x_ukuran_vp[i_x_ukuran_vp].className = 'isi_box_select_varian c_id_varian_ukuran';
            }

            var add_id_varian_ukuran = 'id_varian_ukuran' + key_ukuran_vp;
            document.getElementById(add_id_varian_ukuran).className = 'isi_box_select_varian_active c_id_varian_ukuran';
            ukuran_value.value = value_ukuran_vp;
            var v_jumlah_produk = jumlah_produk.value;
            var ukuran_harga_value_var = value_harga_ukuran_vp * v_jumlah_produk;
            ukuran_harga_value.value = ukuran_harga_value_var;
            ukuran_harga_satuan_value.value = value_harga_ukuran_vp;
            harga_varian_produk.innerHTML = rubah(ukuran_harga_value_var);
            ukuran_harga_satuan_value_send.value = value_harga_ukuran_vp_send;
        }

        function view_addcart() {
            buvar_masukkan_keranjang.style.display = 'block';
            buvar_beli_sekarang.style.display = 'none';
            back_varian_produk.style.display = 'flex';
        }

        function view_checkout() {
            buvar_masukkan_keranjang.style.display = 'none';
            buvar_beli_sekarang.style.display = 'block';
            back_varian_produk.style.display = 'flex';
        }

        function close_back_varian_produk() {
            buvar_masukkan_keranjang.style.display = 'none';
            buvar_beli_sekarang.style.display = 'none';
            back_varian_produk.style.display = 'none';
        }
    </script>
    <script src="../../assets/js/product/view.js"></script>
    <?php
    if (!$product_data['warna'] == '') {
    ?>
        <script>
            id_varian_warna0.click();
        </script>
    <?php
    }
    if (!$product_data['ukuran'] == '') {
    ?>
        <script>
            id_varian_ukuran0.click();
        </script>
    <?php
    }
    ?>
    <!-- JS -->
</body>

</html>