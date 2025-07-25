<?php
include '../../config.php';
date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['idinvoice'])) {
    $idinvoice = intval($_POST['idinvoice']);
    $tanggal_batal = date("Y-m-d H:i:s");

    // Update invoice
    $query = "UPDATE invoice 
              SET tipe_progress = 'Dibatalkan', waktu_dibatalkan = '$tanggal_batal'
              WHERE idinvoice = '$idinvoice'";

    if ($server->query($query)) {
        echo "<script>
            alert('Permintaan pembatalan dikirim. Menunggu persetujuan admin.');
            window.location.href = '../../checkout/detail.php?id=$idinvoice';
        </script>";
    } else {
        echo "<script>
            alert('Gagal mengajukan pembatalan.');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('Permintaan tidak valid.');
        window.history.back();
    </script>";
}
