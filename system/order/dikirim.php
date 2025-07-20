<?php
include '../../config.php';

$select_invoice = $server->query("SELECT * FROM `invoice`, `iklan`, `kategori` WHERE invoice.id_user='$iduser' AND invoice.tipe_progress='Dikirim' AND invoice.id_iklan=iklan.id AND iklan.id_kategori=kategori.id ORDER BY `invoice`.`idinvoice` DESC");
$cek_invoice = mysqli_num_rows($select_invoice);
if ($cek_invoice == "0") {
?>
    <div class="box_res_order_0">
        <img src="../assets/icons/list.svg" alt="">
        <p>Belum ada pesanan</p>
    </div>
<?php
} else {
?>
    <div class="box_isi_res_order">
        <?php
        while ($invoice_data = mysqli_fetch_assoc($select_invoice)) {
            $hitung_diskon_fs = ($invoice_data['diskon_i'] / 100) * $invoice_data['harga_i'];
            $harga_diskon_fs = ($invoice_data['harga_i'] - $hitung_diskon_fs) * $invoice_data['jumlah'];
            $exp_gambar_od = explode(',', $invoice_data['gambar']);
        ?>
            <div class="isi_cart" id="isi_cart<?php echo $invoice_data['id']; ?>">
                <div class="box_gambar_judul">
                    <img src="<?php echo $url; ?>assets/image/product/<?php echo $exp_gambar_od[0]; ?>" alt="">
                    <div class="box_judul_ic">
                        <h1><?php echo $invoice_data['judul']; ?></h1>
                        <p>Kategori <span><?php echo $invoice_data['nama']; ?></span></p>
                        <p>Total Produk <span><?php echo $invoice_data['jumlah']; ?></span></p>
                        <p class="no_resi_p">No. Resi <span><?php echo $invoice_data['resi']; ?></span></p>
                    </div>
                </div>
                <div class="box_detail_isi_cart">
                    <div class="box_total_harga">
                        <p>Proses Dikirim</p>
                        <h1><?php echo $invoice_data['waktu_dikirim']; ?></h1>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
<?php
}
?>
<style>
    /* Add this variable to your CSS if it's not already defined */
    :root {
        --white: #ffffff;
        --semi-black: #343a40;
        --black: #212529;
        --grey: #6c757d;
        --accent-color: hotpink; /* Changed from orange to hotpink */
        --border-grey: #dee2e6;
    }

    .box_res_order_0 {
        width: 100%;
        background-color: var(--white);
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 170px 0;
    }

    .box_res_order_0 img {
        height: 80px;
    }

    .box_res_order_0 p {
        font-size: 15px;
        font-weight: 500;
        text-align: center;
        color: var(--semi-black);
        margin-top: 15px;
    }

    .box_isi_res_order {
        width: 100%;
        margin-top: 15px;
        display: grid;
        grid-template-columns: 1fr;
        grid-gap: 10px; /* Increased gap between items for better separation */
    }

    .isi_cart {
        width: 100%;
        padding: 15px 20px;
        background-color: var(--white);
        box-sizing: border-box;
        overflow: hidden;
        display: flex;
        align-items: center;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .isi_cart:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    }

    .box_gambar_judul {
        width: 450px;
        overflow: hidden;
        float: left;
        display: flex;
        align-items: center;
    }

    .isi_cart img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .box_judul_ic {
        flex-grow: 1;
        width: auto;
    }

    .box_judul_ic h1 {
        font-size: 16px;
        font-weight: 600;
        color: var(--black);
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .box_judul_ic p {
        font-size: 13px;
        font-weight: 500;
        color: var(--grey);
        margin-top: 0px;
        line-height: 1.5;
    }

    .box_judul_ic p span {
        color: var(--accent-color); /* Used the new accent color */
        font-weight: 600;
    }

    .box_judul_ic .no_resi_p {
        font-size: 13px;
        font-weight: 500;
        color: var(--semi-black);
        margin-top: 5px;
    }

    .box_judul_ic .no_resi_p span {
        color: var(--black);
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .box_detail_isi_cart {
        width: calc(100% - 450px);
        float: right;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-end;
    }

    .box_total_harga {
        margin-left: 20px;
        text-align: right;
    }

    .box_total_harga p {
        font-size: 13px;
        font-weight: 500;
        color: var(--grey);
        margin-top: 3px;
    }

    .box_total_harga h1 {
        font-size: 15px;
        font-weight: 600;
        color: var(--semi-black);
        margin-top: 3px;
    }

    .box_total_harga h1 span {
        font-size: 14px;
    }

    .bayar {
        background-color: var(--accent-color); /* Used the new accent color */
        color: var(--white);
        border-radius: 3px;
        height: 45px;
        font-weight: 500;
        font-size: 16px;
        margin-left: 20px;
        width: 120px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .bayar:hover {
        background-color: #ff69b4; /* Slightly darker pink on hover */
    }

    .bayar img {
        width: 20px;
        height: 20px;
    }

    .loading_checkout {
        display: none;
    }

    @media only screen and (max-width: 900px) {
        .isi_cart {
            display: block;
            padding: 15px;
            border-radius: 6px;
        }

        .box_gambar_judul {
            width: 100%;
            display: flex;
            align-items: center;
        }

        .isi_cart img {
            width: 65px;
            height: 65px;
            border-radius: 6px;
            margin-right: 10px;
        }

        .box_judul_ic {
            width: calc(100% - 75px);
            float: none;
            flex-grow: 1;
        }

        .box_judul_ic h1 {
            font-size: 14px;
            margin-bottom: 3px;
        }

        .box_judul_ic p {
            font-size: 12px;
        }

        .box_judul_ic p span {
            font-size: 12px;
        }

        .box_judul_ic .no_resi_p {
            font-size: 12px;
            margin-top: 3px;
        }

        .box_judul_ic .no_resi_p span {
            font-size: 12px;
        }

        .box_detail_isi_cart {
            width: 100%;
            margin-top: 15px;
            padding-top: 13px;
            border-top: 1px solid var(--border-grey);
            justify-content: flex-start;
            float: none;
        }

        .box_total_harga {
            flex: 1;
            margin-left: 0;
            text-align: left;
        }

        .box_total_harga p {
            font-size: 11px;
            margin-top: 0px;
        }

        .box_total_harga h1 {
            font-size: 13px;
        }

        .box_total_harga h1 span {
            font-size: 13px;
        }

        .box_remove_cart {
            margin-left: 10px;
        }

        .bayar {
            width: 100px;
            height: 35px;
            font-size: 13px;
        }

        .bayar img {
            width: 14px;
            height: 14px;
        }
    }
</style>