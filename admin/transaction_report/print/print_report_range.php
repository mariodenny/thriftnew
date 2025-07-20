<?php
include '../../../config.php';
require_once "../../../assets/composer/mpdf/vendor/autoload.php";

$mpdf = new \Mpdf\Mpdf();
$mpdf->AddPage("L", "", "", "", "", "10", "10", "10", "0", "", "", "", "", "", "", "", "", "", "", "A4");
$mpdf->SetWatermarkImage("../../../assets/image/logo.png");
$mpdf->showWatermarkImage = true;
$mpdf->watermarkImageAlpha = 0.05;
ob_start();

function newDate($date)
{
    return explode('-', $date)[2] . "/" . explode('-', $date)[1] . "/" . explode('-', $date)[0];
}

function newDateTime($dateTime)
{
    $date = explode(' ', $dateTime)[0];
    return explode('-', $date)[2] . "/" . explode('-', $date)[1] . "/" . explode('-', $date)[0] . " " . explode(' ', $dateTime)[1];
}
?>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: sans-serif;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        #st {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        #st th,
        #st td {
            border: 1px solid black;
            padding: 6px;
            font-size: 11px;
        }

        #st th {
            background-color: #f0f0f0;
        }

        #st td {
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <!-- Header Logo dan Judul -->
    <table style="width:100%;">
        <tr>
            <td style="width: 140px;">
                <img src="../../../assets/image/logo.png" style="width:120px; height:auto;">
            </td>
            <td class="text-center">
                <h2 style="margin: 0;">Laporan Transaksi Per-Periode</h2>
                <p style="margin: 0; font-size: 12px;">Periode: <?= newDate($_GET['dt']) ?> s/d <?= newDate($_GET['st']) ?></p>
            </td>
        </tr>
    </table>

    <hr style="margin: 10px 0;">

    <!-- Tabel Data -->
    <table id="st">
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th style="width: 90px;">Tanggal</th>
                <th style="width: 60px;">Status</th>
                <th style="width: 100px;">Kategori</th>
                <th style="width: 130px;">Nama Pengguna</th>
                <th style="width: 70px;">Produk</th>
                <th style="width: 70px;">Harga</th>
                <th style="width: 40px;">Qty</th>
                <th style="width: 90px;">Harga Pesanan</th>
                <th style="width: 60px;">Diskon</th>
                <th style="width: 60px;">Ongkir</th>
                <th style="width: 90px;">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filter = [];

            if (!empty($_GET['progres'])) {
                $filter[] = "a.tipe_progress = '" . mysqli_real_escape_string($server, $_GET['progres']) . "'";
            }

            if (!empty($_GET['kategori'])) {
                $filter[] = "c.id_kategori = '" . mysqli_real_escape_string($server, $_GET['kategori']) . "'";
            }

            $where_filter = $filter ? " AND " . implode(" AND ", $filter) : "";


            $no = 1;
            $subtotal = $total_diskon = $total_ongkir = $total_final = 0;
            $count = mysqli_num_rows($invoice);

            while ($data = mysqli_fetch_assoc($invoice)) {
                $harga_total = $data['harga'] * $data['jumlah'];
                $harga_final = $harga_total - $data['diskon_i'] + $data['harga_ongkir'];

                $subtotal += $harga_total;
                $total_diskon += $data['diskon_i'];
                $total_ongkir += $data['harga_ongkir'];
                $total_final += $harga_final;
            ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= newDateTime($data['waktu']) ?></td>
                    <td class="text-center"><?= $data['tipe_progress'] ?></td>
                    <td><?= $data['nama_lengkap'] ?></td>
                    <td><?= $data['judul'] ?></td>
                    <td class="text-right"><?= number_format($data['harga'], 0, ",", ".") ?></td>
                    <td class="text-center"><?= $data['jumlah'] ?></td>
                    <td class="text-right"><?= number_format($harga_total, 0, ",", ".") ?></td>
                    <td class="text-right"><?= number_format($data['diskon_i'], 0, ",", ".") ?></td>
                    <td class="text-right"><?= number_format($data['harga_ongkir'], 0, ",", ".") ?></td>
                    <td class="text-right"><?= number_format($harga_final, 0, ",", ".") ?></td>
                </tr>
            <?php } ?>
        </tbody>

        <?php if ($count > 0) { ?>
            <tfoot>
                <tr>
                    <th colspan="7" class="text-left">Total</th>
                    <th class="text-right">Rp. <?= number_format($subtotal, 0, ",", ".") ?></th>
                    <th class="text-right"><?= number_format($total_diskon, 0, ",", ".") ?></th>
                    <th class="text-right"><?= number_format($total_ongkir, 0, ",", ".") ?></th>
                    <th class="text-right"><?= number_format($total_final, 0, ",", ".") ?></th>
                </tr>
            </tfoot>
        <?php } ?>
    </table>

    <?php if ($count == 0): ?>
        <div class="text-center" style="margin-top: 30px;">
            <h4>Data Kosong</h4>
        </div>
    <?php endif; ?>

</body>

</html>

<?php
$content = ob_get_clean();
$mpdf->WriteHTML($content);
$mpdf->Output();
?>