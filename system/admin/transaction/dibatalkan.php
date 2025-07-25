<?php
include '../../../config.php';

// Query untuk ambil transaksi yang minta dibatalkan (belum di-approve admin)
$select_pending = $server->query("SELECT * FROM `iklan`, `kategori`, `akun`, `invoice` WHERE invoice.tipe_progress='Permintaan_Dibatalkan' AND invoice.id_iklan=iklan.id AND iklan.id_kategori=kategori.id AND invoice.id_user=akun.id ORDER BY `invoice`.`idinvoice` DESC");

// Query untuk ambil transaksi yang sudah dibatalkan
$select_cancelled = $server->query("SELECT * FROM `iklan`, `kategori`, `akun`, `invoice` WHERE invoice.tipe_progress='Dibatalkan' AND invoice.id_iklan=iklan.id AND iklan.id_kategori=kategori.id AND invoice.id_user=akun.id ORDER BY `invoice`.`idinvoice` DESC");

$cek_pending = mysqli_num_rows($select_pending);
$cek_cancelled = mysqli_num_rows($select_cancelled);
$total = $cek_pending + $cek_cancelled;

if ($total == "0") {
?>
    <div class="box_res_order_0">
        <img src="<?php echo $url; ?>assets/icons/list.svg" alt="">
        <p>Belum ada pesanan dibatalkan</p>
    </div>
<?php
} else {
?>
    <div class="jumlah_isi_res_order">
        <h1>Total Dibatalkan</h1>
        <p><?php echo $total; ?> Produk</p>
        <?php if ($cek_pending > 0) { ?>
            <div class="pending_alert">
                <span><?php echo $cek_pending; ?> menunggu persetujuan</span>
            </div>
        <?php } ?>
    </div>

    <div class="box_isi_res_order">
        <?php
        // Tampilkan yang menunggu persetujuan dulu (prioritas)
        if ($cek_pending > 0) {
            while ($pending_data = mysqli_fetch_assoc($select_pending)) {
                $hitung_diskon_fs = ($pending_data['diskon_i'] / 100) * $pending_data['harga_i'];
                $harga_diskon_fs = ($pending_data['harga_i'] - $hitung_diskon_fs) * $pending_data['jumlah'];
                $harga_semua_fs = $harga_diskon_fs + $pending_data['harga_ongkir'];
                $exp_gambar_od = explode(',', $pending_data['gambar']);
        ?>
                <div class="isi_cart pending_cancel" id="isi_cart<?php echo $pending_data['id']; ?>">
                    <div class="status_badge_pending">MENUNGGU PERSETUJUAN</div>

                    <div class="box_gambar_judul">
                        <img src="<?php echo $url; ?>assets/image/product/<?php echo $exp_gambar_od[0]; ?>" alt="">
                        <div class="box_judul_ic">
                            <h1><?php echo $pending_data['judul']; ?></h1>
                            <p>Kategori <span><?php echo $pending_data['nama']; ?></span></p>
                            <p>Total Produk <span><?php echo $pending_data['jumlah']; ?></span></p>
                        </div>
                    </div>

                    <div class="box_detail_isi_cart">
                        <div class="box_total_harga">
                            <div class="box_profile_isi_cart">
                                <p><?php echo $pending_data['nama_lengkap']; ?></p>
                                <img src="<?php echo $url; ?>assets/image/profile/<?php echo $pending_data['foto']; ?>">
                            </div>
                            <p><?php echo $pending_data['waktu']; ?></p>
                            <h1><span>Rp</span> <?php echo number_format($harga_semua_fs, 0, ".", "."); ?></h1>
                        </div>

                        <div class="cancel_buttons">
                            <button class="btn_approve" onclick="approveCancel(<?php echo $pending_data['idinvoice']; ?>)">
                                ✓ Setujui
                            </button>
                            <button class="btn_reject" onclick="rejectCancel(<?php echo $pending_data['idinvoice']; ?>)">
                                ✗ Tolak
                            </button>
                        </div>
                    </div>
                </div>
            <?php
            }
        }

        // Tampilkan yang sudah dibatalkan
        while ($cancelled_data = mysqli_fetch_assoc($select_cancelled)) {
            $hitung_diskon_fs = ($cancelled_data['diskon_i'] / 100) * $cancelled_data['harga_i'];
            $harga_diskon_fs = ($cancelled_data['harga_i'] - $hitung_diskon_fs) * $cancelled_data['jumlah'];
            $harga_semua_fs = $harga_diskon_fs + $cancelled_data['harga_ongkir'];
            $exp_gambar_od = explode(',', $cancelled_data['gambar']);
            ?>
            <div class="isi_cart cancelled" id="isi_cart<?php echo $cancelled_data['id']; ?>">
                <div class="status_badge_cancelled">DIBATALKAN</div>

                <div class="box_gambar_judul">
                    <img src="<?php echo $url; ?>assets/image/product/<?php echo $exp_gambar_od[0]; ?>" alt="">
                    <div class="box_judul_ic">
                        <h1><?php echo $cancelled_data['judul']; ?></h1>
                        <p>Kategori <span><?php echo $cancelled_data['nama']; ?></span></p>
                        <p>Total Produk <span><?php echo $cancelled_data['jumlah']; ?></span></p>
                    </div>
                </div>

                <div class="box_detail_isi_cart">
                    <div class="box_total_harga">
                        <div class="box_profile_isi_cart">
                            <p><?php echo $cancelled_data['nama_lengkap']; ?></p>
                            <img src="<?php echo $url; ?>assets/image/profile/<?php echo $cancelled_data['foto']; ?>">
                        </div>
                        <p><?php echo $cancelled_data['waktu']; ?></p>
                        <h1><span>Rp</span> <?php echo number_format($harga_semua_fs, 0, ".", "."); ?></h1>
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
    .box_res_order_0 {
        width: 100%;
        background-color: var(--white);
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 150px 0;
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

    .jumlah_isi_res_order {
        width: 100%;
        padding: 15px 20px;
        background-color: var(--white);
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        box-sizing: border-box;
        align-items: center;
        position: relative;
    }

    .jumlah_isi_res_order h1 {
        font-size: 15px;
        font-weight: 500;
    }

    .jumlah_isi_res_order p {
        font-size: 15px;
        font-weight: 500;
    }

    .pending_alert {
        background: #ff6b6b;
        color: white;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 500;
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }

        100% {
            opacity: 1;
        }
    }

    .box_isi_res_order {
        width: 100%;
        margin-top: 10px;
        display: grid;
        grid-template-columns: 1fr;
        grid-gap: 5px;
    }

    .isi_cart {
        width: 100%;
        padding: 15px 20px;
        background-color: var(--white);
        box-sizing: border-box;
        overflow: hidden;
        display: flex;
        align-items: center;
        position: relative;
    }

    .isi_cart.pending_cancel {
        border-left: 4px solid #ff6b6b;
        background: #fff8f8;
    }

    .isi_cart.cancelled {
        opacity: 0.8;
        border-left: 4px solid #6c757d;
    }

    .status_badge_pending {
        position: absolute;
        top: 10px;
        right: 20px;
        background: #ff6b6b;
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status_badge_cancelled {
        position: absolute;
        top: 10px;
        right: 20px;
        background: #6c757d;
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .box_gambar_judul {
        width: 450px;
        overflow: hidden;
        float: left;
    }

    .isi_cart img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 3px;
        float: left;
    }

    .box_judul_ic {
        width: calc(100% - 95px);
        float: right;
    }

    .box_judul_ic h1 {
        font-size: 15px;
        font-weight: 500;
        color: var(--black);
        margin-bottom: 8px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .box_judul_ic p {
        font-size: 13px;
        font-weight: 500;
        color: var(--grey);
        margin-top: 3px;
    }

    .box_judul_ic p span {
        color: var(--orange);
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
        font-size: 18px;
        font-weight: 600;
        color: var(--orange);
        margin-top: 3px;
    }

    .box_total_harga h1 span {
        font-size: 14px;
    }

    .cancel_buttons {
        margin-left: 20px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .btn_approve,
    .btn_reject {
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        min-width: 80px;
    }

    .btn_approve {
        background: #28a745;
        color: white;
    }

    .btn_approve:hover {
        background: #218838;
        transform: translateY(-1px);
    }

    .btn_reject {
        background: #dc3545;
        color: white;
    }

    .btn_reject:hover {
        background: #c82333;
        transform: translateY(-1px);
    }

    .box_profile_isi_cart {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-bottom: 10px;
    }

    .box_profile_isi_cart img {
        width: 22px;
        height: 22px;
        border-radius: 22px;
        object-fit: cover;
    }

    .box_profile_isi_cart p {
        margin-right: 10px;
        color: var(--semi-black);
        font-weight: 500;
    }

    @media only screen and (max-width: 900px) {
        .isi_cart {
            display: block;
            padding: 15px;
        }

        .box_gambar_judul {
            width: 100%;
        }

        .isi_cart img {
            width: 65px;
            height: 65px;
        }

        .box_judul_ic {
            width: calc(100% - 80px);
            float: right;
        }

        .box_judul_ic h1 {
            font-size: 13px;
        }

        .box_judul_ic p {
            font-size: 11.5px;
        }

        .box_detail_isi_cart {
            width: 100%;
            margin-top: 15px;
            padding-top: 13px;
            border-top: 1px solid var(--border-grey);
            justify-content: space-between;
        }

        .box_total_harga {
            flex: 1;
            margin-left: 0;
            text-align: left;
        }

        .box_total_harga p {
            font-size: 11px;
            font-weight: 500;
            color: var(--grey);
            margin-top: 0px;
        }

        .box_total_harga h1 {
            font-size: 14px;
            font-weight: 600;
            color: var(--orange);
            margin-top: 3px;
        }

        .box_total_harga h1 span {
            font-size: 12px;
        }

        .cancel_buttons {
            margin-left: 15px;
            flex-direction: row;
            gap: 5px;
        }

        .btn_approve,
        .btn_reject {
            padding: 6px 10px;
            font-size: 11px;
            min-width: 60px;
        }

        .status_badge_pending,
        .status_badge_cancelled {
            position: static;
            display: inline-block;
            margin-bottom: 10px;
        }

        .pending_alert {
            position: static;
            transform: none;
            margin-left: 10px;
        }
    }
</style>

<script>
    function approveCancel(invoiceId) {
        if (confirm('Apakah Anda yakin ingin menyetujui pembatalan pesanan ini?')) {
            const button = event.target;
            button.disabled = true;
            button.innerHTML = '⏳ Processing...';

            fetch('../../system/admin/transaction/process_cancel.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'invoice_id=' + invoiceId + '&action=approve'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Pembatalan berhasil disetujui!');
                        location.reload();
                    } else {
                        alert('Error: ' + (data.message || 'Gagal memproses pembatalan'));
                        button.disabled = false;
                        button.innerHTML = '✓ Setujui';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('❌ Terjadi kesalahan sistem');
                    button.disabled = false;
                    button.innerHTML = '✓ Setujui';
                });
        }
    }

    function rejectCancel(invoiceId) {
        if (confirm('Apakah Anda yakin ingin menolak pembatalan ini?\nTransaksi akan kembali ke status sebelumnya.')) {
            const button = event.target;
            button.disabled = true;
            button.innerHTML = '⏳ Processing...';

            fetch('../../system/admin/transaction/process_cancel.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'invoice_id=' + invoiceId + '&action=reject'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('✅ Pembatalan berhasil ditolak!');
                        location.reload();
                    } else {
                        alert('❌ Error: ' + (data.message || 'Gagal memproses pembatalan'));
                        button.disabled = false;
                        button.innerHTML = '✗ Tolak';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('❌ Terjada kesalahan sistem');
                    button.disabled = false;
                    button.innerHTML = '✗ Tolak';
                });
        }
    }
</script>