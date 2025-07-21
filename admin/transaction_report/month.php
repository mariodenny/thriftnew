<?php
include '../../config.php';

$page_admin = 'laporan_transaksi_bulan';

if (isset($_COOKIE['login_admin'])) {
  if ($akun_adm == 'false') {
    header("location: " . $url . "system/admin/logout");
  }
} else {
  header("location: " . $url . "admin/login/");
}
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
function verifLog()
{
  if (empty($_SESSION['data'])) {
    // header("location:login.php?alertl=warning&msgl=Silahkan login terlebih dahulu");
    echo '<script>window.location="login.php?alertl=warning&msgl=Silahkan login terlebih dahulu"</script>';
  }
}
function newDateFormat($date)
{
  $bulan = explode(" ", $date)[1];
  $tanggal = explode(" ", $date)[0];
  $tahun = explode(" ", $date)[2];
  // return $bulan;
  if ($bulan == "Januari") {
    return $tahun . "-01-" . $tanggal;
  } elseif ($bulan == "Februari") {
    return $tahun . "-02-" . $tanggal;
  } elseif ($bulan == "Maret") {
    return $tahun . "-03-" . $tanggal;
  } elseif ($bulan == "April") {
    return $tahun . "-04-" . $tanggal;
  } elseif ($bulan == "Mei") {
    return $tahun . "-05-" . $tanggal;
  } elseif ($bulan == "Juni") {
    return $tahun . "-06-" . $tanggal;
  } elseif ($bulan == "Juli") {
    return $tahun . "-07-" . $tanggal;
  } elseif ($bulan == "Agustus") {
    return $tahun . "-08-" . $tanggal;
  } elseif ($bulan == "September") {
    return $tahun . "-09-" . $tanggal;
  } elseif ($bulan == "Oktober") {
    return $tahun . "-10-" . $tanggal;
  } elseif ($bulan == "November") {
    return $tahun . "-11-" . $tanggal;
  } elseif ($bulan == "Desember") {
    return $tahun . "-12-" . $tanggal;
  }
}
function newDateFormatback($date)
{
  $bulan = explode("-", $date)[1];
  $tanggal = explode("-", $date)[2];
  $tahun = explode("-", $date)[0];
  if ($bulan == "01") {
    return $tanggal . " Januari " . $tahun;
  } elseif ($bulan == "02") {
    return $tanggal . " Februari " . $tahun;
  } elseif ($bulan == "03") {
    return $tanggal . " Maret " . $tahun;
  } elseif ($bulan == "04") {
    return $tanggal . " April " . $tahun;
  } elseif ($bulan == "05") {
    return $tanggal . " Mei " . $tahun;
  } elseif ($bulan == "06") {
    return $tanggal . " Juni " . $tahun;
  } elseif ($bulan == "07") {
    return $tanggal . " Juli " . $tahun;
  } elseif ($bulan == "08") {
    return $tanggal . " Agustus " . $tahun;
  } elseif ($bulan == "09") {
    return $tanggal . " September " . $tahun;
  } elseif ($bulan == "10") {
    return $tanggal . " Oktober " . $tahun;
  } elseif ($bulan == "11") {
    return $tanggal . " November " . $tahun;
  } elseif ($bulan == "12") {
    return $tanggal . " Desember " . $tahun;
  } else {
    return "Tanggal Error";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Transaksi</title>
  <link rel="icon" href="../../assets/icons/<?php echo $logo; ?>" type="image/svg">
  <link rel="stylesheet" href="../../assets/css/admin/transaction/index.css">
  <link rel="stylesheet" href="../../assets/css/admin/product/index.css">
  <script src="../../assets/js/jquery/jquery.min.js"></script>
  <style>
    .text-center {
      text-align: center;
    }

    .text-left {
      text-align: left;
    }

    .text-right {
      text-align: right;
    }

    /* CSS */
    .button-43 {
      background-image: linear-gradient(-180deg, #ec407a 0%, #ec407a 100%);
      border-radius: .5rem;
      box-sizing: border-box;
      color: #FFFFFF;
      display: flex;
      font-size: 16px;
      justify-content: center;
      padding: 1rem 1.75rem;
      text-decoration: none;
      width: 100%;
      border: 0;
      cursor: pointer;
      user-select: none;
      -webkit-user-select: none;
      touch-action: manipulation;
    }

    .button-43:hover {
      background-image: linear-gradient(-180deg, #ff6b81 0%, #ff6b81 100%);
    }

    @media (min-width: 768px) {
      .button-43 {
        padding: 1rem 2rem;
      }
    }

    .w-100 {
      width: 100%;
    }

    .mt-3 {
      margin-top: 30px;
    }

    /* Table */
    .demo-table {
      border-collapse: collapse;
      font-size: 13px;
    }

    .demo-table th,
    .demo-table td {
      border: 1px solid #f8bbd0;
      padding: 7px 17px;
    }

    .demo-table .title {
      caption-side: bottom;
      margin-top: 12px;
    }

    /* Table Header */
    .demo-table thead th {
      background: #ec407a;
      color: #FFFFFF;
      border-color: #d81b60 !important;
      font-weight: normal;
    }

    /* Table Body */
    .demo-table tbody td {
      color: #353535;
    }

    .demo-table tbody tr:hover td {
      background-color: #ffe0ec;
      border-color: #ff99bb;
      transition: all .2s;
    }

    /* Table Footer */
    .demo-table tfoot th {
      background-color: #ffe6ef;
    }

    .demo-table tfoot th:first-child {
      text-align: left;
    }

    .demo-table tbody td:empty {
      background-color: #ffcccc;
    }

    /* Form Styles */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
    }

    .formbold-mb-3 {
      margin-bottom: 15px;
    }

    .formbold-relative {
      position: relative;
    }

    .formbold-opacity-0 {
      opacity: 0;
    }

    .formbold-stroke-current {
      stroke: #ffffff;
      z-index: 999;
    }

    #supportCheckbox:checked~div span {
      opacity: 1;
    }

    #supportCheckbox:checked~div {
      background: #ec407a;
      border-color: #ec407a;
    }

    .formbold-main-wrapper {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 48px;
    }

    .formbold-form-wrapper {
      margin: 0 auto;
      max-width: 570px;
      width: 100%;
      background: white;
      padding: 40px;
    }

    .formbold-img {
      display: block;
      margin: 0 auto 45px;
    }

    .formbold-input-wrapp>div {
      display: flex;
      gap: 20px;
    }

    .formbold-input-flex {
      display: flex;
      gap: 20px;
      margin-bottom: 15px;
    }

    .formbold-input-flex>div {
      width: 50%;
    }

    .formbold-form-input {
      width: 100%;
      padding: 10px 20px;
      border-radius: 5px;
      border: 1px solid #ec407a;
      background: #ffe6ef;
      font-weight: 400;
      /* normal, bukan bold */
      font-size: 16px;
      color: #ec407a;
      outline: none;
      transition: all 0.3s ease;
    }

    .formbold-form-input::placeholder {
      color: rgba(236, 64, 122, 0.6);
      font-weight: 400;
      /* placeholder juga normal */
    }

    .formbold-form-input:focus {
      border-color: #d81b60;
      background: #ffcade;
      box-shadow: 0 0 5px #d81b60;
      color: #d81b60;
      font-weight: 400;
      /* tetap normal */
    }


    .formbold-form-input::placeholder,
    select.formbold-form-input,
    .formbold-form-input[type='date']::-webkit-datetime-edit-text,
    .formbold-form-input[type='date']::-webkit-datetime-edit-month-field,
    .formbold-form-input[type='date']::-webkit-datetime-edit-day-field,
    .formbold-form-input[type='date']::-webkit-datetime-edit-year-field {
      color: rgba(83, 99, 135, 0.5);
    }

    .formbold-form-input:focus {
      border-color: #ec407a;
      box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
    }

    .formbold-form-label {
      color: #536387;
      font-size: 14px;
      line-height: 24px;
      display: block;
      margin-bottom: 10px;
    }

    .formbold-checkbox-label {
      display: flex;
      cursor: pointer;
      user-select: none;
      font-size: 16px;
      line-height: 24px;
      color: #536387;
    }

    .formbold-checkbox-label a {
      margin-left: 5px;
      color: #ec407a;
    }

    .formbold-input-checkbox {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border-width: 0;
    }

    .formbold-checkbox-inner {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 20px;
      height: 20px;
      margin-right: 16px;
      margin-top: 2px;
      border: 0.7px solid #f3c6d3;
      border-radius: 3px;
    }

    .formbold-form-file {
      padding: 12px;
      font-size: 14px;
      line-height: 24px;
      color: rgba(83, 99, 135, 0.5);
    }

    .formbold-form-file::-webkit-file-upload-button {
      display: none;
    }

    .formbold-form-file:before {
      content: 'Upload';
      display: inline-block;
      background: #ffe6ef;
      border: 0.5px solid #f3c6d3;
      border-radius: 3px;
      padding: 3px 12px;
      outline: none;
      white-space: nowrap;
      /* -webkit-user-select: none; */
      cursor: pointer;
      color: #ec407a;
      font-weight: 500;
      font-size: 12px;
      line-height: 16px;
      margin-right: 10px;
    }

    .formbold-btn {
      font-size: 16px;
      border-radius: 5px;
      padding: 14px 25px;
      border: none;
      font-weight: 500;
      background-color: #ec407a;
      color: white;
      cursor: pointer;
      margin-top: 25px;
    }

    .formbold-btn:hover {
      background-color: #d81b60;
      box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
    }

    .formbold-w-45 {
      width: 45%;
    }
  </style>
</head>

<body>

  <div class="admin">
    <?php include '../partials/menu.php'; ?>
    <div class="content_admin">
      <h1 class="title_content_admin">Laporan Transaksi Per-Bulan</h1>

      <!-- Author: FormBold Team -->
      <!-- Learn More: https://formbold.com -->
      <form method="GET">

        <div class="formbold-input-flex">
          <div>
            <label for="city" class="formbold-form-label"> Bulan</label>
            <select class="formbold-form-input" name="bulan" id="exampleFormControlSelect1" required>
              <option value="">Pilih Bulan</option>
              <option value="01">Januari</option>
              <option value="02">Februari</option>
              <option value="03">Maret</option>
              <option value="04">April</option>
              <option value="05">Mei</option>
              <option value="06">Juni</option>
              <option value="07">Juli</option>
              <option value="08">Agustus</option>
              <option value="09">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
            <script>
              $("[name='bulan']").val('<?= isset($_GET['bulan']) ? $_GET['bulan'] : '' ?>');
            </script>
          </div>
          <div>
            <label for="city" class="formbold-form-label"> Tahun </label>
            <input
              type="number"
              name="tahun"
              maxlength="4"
              minlength="4"
              placeholder="ex: 0000"
              class="formbold-form-input"
              value="<?= isset($_GET['tahun']) ? $_GET['tahun'] : '' ?>"
              required />
          </div>
          <div>
            <label for="city" class="formbold-form-label"> Progres</label>
            <select class="formbold-form-input" name="progres" id="exampleFormControlSelect1">
              <option value="">Semua</option>
              <option value="Belum Bayar">Belum Dibayar</option>
              <option value="Dikemas">Dikemas</option>
              <option value="Dikirim">Dikirim</option>
              <option value="Selesai">Selesai</option>
              <option value="Dibatalkan">Dibatalkan</option>
            </select>
            <script>
              $("[name='progres']").val('<?= isset($_GET['progres']) ? $_GET['progres'] : '' ?>');
            </script>
          </div>

          <div>
            <label for="kategori" class="formbold-form-label">Kategori</label>
            <select class="formbold-form-input" name="kategori" id="kategori">
              <option value="">Semua</option>
              <?php
              $get_kategori = $server->query("SELECT * FROM kategori ORDER BY nama ASC");
              while ($kat = mysqli_fetch_assoc($get_kategori)) {
                $selected = (isset($_GET['kategori']) && $_GET['kategori'] == $kat['id']) ? "selected" : "";
                echo "<option value='{$kat['id']}' $selected>{$kat['nama']}</option>";
              }
              ?>
            </select>
          </div>


          <div>
            <button type="submit" class="button-43" style="margin-top:30px;">Lihat Laporan</button>
          </div>
        </div>

      </form>
      <div <?= isset($_GET['bulan']) && isset($_GET['tahun']) ? '' : 'style="display:none;"' ?>>
        <table class="demo-table w-100 mt-3">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Kategori</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>

            <?php
            if (isset($_GET['bulan']) && isset($_GET['tahun'])) {
              // Build filter conditions dynamically
              $filter = [];

              if (!empty($_GET['progres'])) {
                $filter[] = "a.tipe_progress = '" . mysqli_real_escape_string($server, $_GET['progres']) . "'";
              }

              if (!empty($_GET['kategori'])) {
                $filter[] = "c.id_kategori = '" . mysqli_real_escape_string($server, $_GET['kategori']) . "'";
              }

              $where_filter = implode(" AND ", $filter);
              $where_filter = $where_filter ? " AND $where_filter" : "";

              $invoice = $server->query(
                "SELECT a.*, b.nama_lengkap, c.judul, c.harga, 
                        COALESCE(d.nama, 'Tanpa Kategori') AS kategori, 
                        SUM(a.harga_i) sumh, DATE(a.waktu) datet 
                 FROM invoice a
                 LEFT JOIN akun b ON a.id_user = b.id
                 LEFT JOIN iklan c ON a.id_iklan = c.id
                 LEFT JOIN kategori d ON c.id_kategori = d.id
                 WHERE MONTH(a.waktu) = '" . mysqli_real_escape_string($server, $_GET['bulan']) . "' 
                   AND YEAR(a.waktu) = '" . mysqli_real_escape_string($server, $_GET['tahun']) . "'
                   $where_filter
                 GROUP BY DATE(a.waktu), d.nama
                 ORDER BY DATE(a.waktu) ASC, d.nama ASC"
              );

              $no = 1;
              $subtot = 0;
              while ($data = mysqli_fetch_assoc($invoice)) {
            ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td><?= newDate($data['datet']) ?></td>
                  <td><?= $data['kategori'] ?></td>
                  <td class="text-right"><?= number_format($data['sumh'], 0, ",", ".") ?></td>
                </tr>
            <?php
                $subtot += $data['sumh']; // Fixed: use sumh instead of harga * jumlah
              }
            }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="3">Sub Total</th>
              <th class="text-right"><small>Rp</small><?= number_format($subtot, 0, ",", ".") ?></th>
            </tr>
          </tfoot>
        </table>
        <div class="formbold-input-flex">
          <div>
          </div>
          <div>
          </div>
          <div>
          </div>
          <div>
            <a href="print/print_report_month.php?bulan=<?= isset($_GET['bulan']) ? $_GET['bulan'] : '' ?>&tahun=<?= isset($_GET['tahun']) ? $_GET['tahun'] : '' ?>&progres=<?= isset($_GET['progres']) ? $_GET['progres'] : '' ?>&kategori=<?= isset($_GET['kategori']) ? $_GET['kategori'] : '' ?>" class="button-43" style="margin-top:30px;">Cetak PDF &nbsp;<i class="fa fa-file-pdf"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- JS -->
  <script src="../../assets/js/admin/transaction/index.js"></script>
  <!-- JS -->
</body>

</html>