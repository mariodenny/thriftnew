<?php
// session_start();
include '../../../config.php';
require_once "../../../assets/composer/mpdf/vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf();
$mpdf->AddPage("L", "", "", "", "", "10", "10", "10", "0", "", "", "", "", "", "", "", "", "", "", "", "A4");
$mpdf->SetWatermarkImage("../assets/img/kemnaker.png"/*,"0", "D", "F"*/);
$mpdf->showWatermarkImage = true;
$mpdf->watermarkImageAlpha = 0.05;
ob_start();

function newDate($date)
{
  return explode('-', $date)[2] . "/" . explode('-', $date)[1] . "/" . explode('-', $date)[0];
}
function newDateBack($date)
{
  return explode('/', $date)[2] . "-" . explode('/', $date)[1] . "-" . explode('/', $date)[0];
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../../assets/img/logo.png">
  <style>
    @font-face {
      font-family: wolf;
      src: url(Wolf.ttf);
    }

    body {
      font-family: 'wolf';
    }

    .text-center {
      text-align: center;
    }

    .text-left {
      text-align: left;
    }

    .text-right {
      text-align: right;
    }

    .text-justify {
      text-align: justify;
    }

    #st {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      border-spacing: 0;
    }

    #st tr th,
    #st tr td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
    }

    #st tr th {
      background-color: #f2f2f2;
    }

    #st tr td:first-child,
    #st tr th:first-child {
      width: 40px;
    }
  </style>
</head>

<body>
  <table style="width:100%;">
    <tr>
      <td style="width:auto;">
        <img src="../../../assets/image/logo.png" style="width:120px; height:auto;">
      </td>
      <td class="text-center">
        <h1 class="center">Laporan Transaksi Perbulan</h1>
      </td>
    </tr>
  </table>

  <hr>
  <?php
  // Get and sanitize input parameters
  $bulan = mysqli_real_escape_string($server, $_GET['bulan'] ?? '');
  $tahun = mysqli_real_escape_string($server, $_GET['tahun'] ?? '');
  $progres = mysqli_real_escape_string($server, $_GET['progres'] ?? '');
  $kategori = mysqli_real_escape_string($server, $_GET['kategori'] ?? '');

  // Build filter conditions
  $filter = [];

  if (!empty($progres)) {
    $filter[] = "a.tipe_progress = '$progres'";
  }

  if (!empty($kategori)) {
    $filter[] = "c.id_kategori = '$kategori'";
  }

  $where_filter = implode(" AND ", $filter);
  $where_filter = $where_filter ? " AND $where_filter" : "";

  // Get category name for display
  $kategori_name = "Semua";
  if (!empty($kategori)) {
    $kat_query = $server->query("SELECT nama FROM kategori WHERE id = '$kategori'");
    if ($kat_data = mysqli_fetch_assoc($kat_query)) {
      $kategori_name = $kat_data['nama'];
    }
  }
  ?>

  <h4>Periode Bulan : <?= $bulan ?> / <?= $tahun ?></h4>
  <h4>Progres : <?= $progres == "" ? "Semua" : $progres ?></h4>
  <h4>Kategori : <?= $kategori_name ?></h4>

  <table id="st">
    <tr class="center">
      <th>No</th>
      <th>Tanggal</th>
      <th>Kategori</th>
      <th>Total</th>
    </tr>

    <?php
    $invoice = $server->query(
      "SELECT a.*, b.nama_lengkap, c.judul, c.harga, 
                COALESCE(d.nama, 'Tanpa Kategori') AS kategori, 
                SUM(a.harga_i) sumh, DATE(a.waktu) datet 
         FROM invoice a
         LEFT JOIN akun b ON a.id_user = b.id
         LEFT JOIN iklan c ON a.id_iklan = c.id
         LEFT JOIN kategori d ON c.id_kategori = d.id
         WHERE MONTH(a.waktu) = '$bulan' 
           AND YEAR(a.waktu) = '$tahun'
           $where_filter
         GROUP BY DATE(a.waktu), d.nama
         ORDER BY DATE(a.waktu) ASC, d.nama ASC"
    );

    $no = 1;
    $subtot = 0;
    $count = mysqli_num_rows($invoice);

    while ($data = mysqli_fetch_assoc($invoice)) {
    ?>
      <tr>
        <td class="text-center"><?= $no++ ?></td>
        <td><?= newDate($data['datet']) ?></td>
        <td><?= $data['kategori'] ?></td>
        <td class="text-right"><?= number_format($data['sumh'], 0, ",", ".") ?></td>
      </tr>
    <?php
      $subtot += $data['sumh'];
    }
    ?>
    <tr>
      <th colspan="3" class="text-left">Total</th>
      <th class="text-right">Rp. <?= number_format($subtot, 0, ",", "."); ?></th>
    </tr>
  </table>

  <?php
  if ($count == 0) {
  ?>
    <div class="center">
      <h4>Data Kosong</h4>
    </div>
  <?php
  }
  ?>

</body>

</html>
<?php
$content = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($content);
$mpdf->Output();
?>