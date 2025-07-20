<?php
include '../../config.php';


$page_admin = 'laporan_transaksi_periode';

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
    :root {
      --warna-utama: #ec407a;
      --warna-hover: #ff6b81;
      --warna-soft: #fce4ec;
      --warna-putih: #ffffff;
      --warna-border: #e1edff;
      --font-utama: 'Inter', sans-serif;
    }

    select.formbold-form-input {
      background-color: var(--warna-soft);
      color: var(--warna-utama);
      border-color: var(--warna-utama);
    }

    select.formbold-form-input:focus {
      background-color: var(--warna-putih);
      border-color: var(--warna-hover);
      box-shadow: 0 0 0 2px rgba(255, 105, 135, 0.3);
      outline: none;
    }

    /* ===================== */
    /* Input type="date"     */
    /* ===================== */
    input[type="date"].formbold-form-input {
      background-color: var(--warna-soft);
      border: 1px solid var(--warna-utama);
      color: var(--warna-utama);
      transition: 0.3s;
    }

    input[type="date"].formbold-form-input:focus {
      background-color: #fff;
      border-color: var(--warna-hover);
      box-shadow: 0 0 0 2px rgba(255, 105, 135, 0.3);
      outline: none;
    }

    /* ===================== */
    /* Select Dropdown       */
    /* ===================== */
    select.formbold-form-input {
      background-color: var(--warna-soft);
      border: 1px solid var(--warna-utama);
      color: var(--warna-utama);
      transition: 0.3s;
      appearance: none;
      padding-right: 40px;
      background-image: url("data:image/svg+xml,%3Csvg fill='%23ec407a' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 1rem center;
      background-size: 16px;
    }

    select.formbold-form-input:focus {
      background-color: #fff;
      border-color: var(--warna-hover);
      box-shadow: 0 0 0 2px rgba(255, 105, 135, 0.3);
      outline: none;
    }



    /* Global reset */
    body {
      font-family: var(--font-utama);
      background-color: #fff;
      color: #353535;
    }

    /* Text alignment */
    .text-center {
      text-align: center;
    }

    .text-left {
      text-align: left;
    }

    .text-right {
      text-align: right;
    }

    /* Tombol utama */
    .button-43 {
      background-image: linear-gradient(-180deg, var(--warna-utama) 0%, var(--warna-utama) 100%);
      border-radius: 0.5rem;
      color: var(--warna-putih);
      display: flex;
      font-size: 16px;
      justify-content: center;
      padding: 1rem 0.1rem;
      text-decoration: none;
      width: 100%;
      border: 0;
      cursor: pointer;
      user-select: none;
      transition: all 0.3s ease;
    }

    .button-43:hover {
      background-image: linear-gradient(-180deg, var(--warna-hover) 0%, var(--warna-hover) 100%);
    }

    /* Tombol sekunder (jika dibutuhkan) */
    .button-secondary {
      background-color: #f2f2f2;
      color: var(--warna-utama);
      border: 1px solid var(--warna-utama);
      border-radius: 0.5rem;
      padding: 1rem 1.75rem;
      font-size: 16px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .button-secondary:hover {
      background-color: var(--warna-utama);
      color: var(--warna-putih);
    }

    /* Table */
    .demo-table {
      border-collapse: collapse;
      font-size: 13px;
      width: 100%;
      margin-top: 30px;
    }

    .demo-table th,
    .demo-table td {
      border: 1px solid var(--warna-border);
      padding: 7px 17px;
    }

    .demo-table thead th {
      background: var(--warna-utama);
      color: var(--warna-putih);
    }

    .demo-table tbody td {
      color: #353535;
    }

    .demo-table tbody tr:hover td {
      background-color: var(--warna-soft);
      border-color: var(--warna-utama);
      transition: all 0.2s ease;
    }

    .demo-table tfoot th {
      background-color: #f4f4f4;
    }

    .demo-table tbody td:empty {
      background-color: #ffcccc;
    }

    /* Form Input */
    .formbold-form-input {
      width: 100%;
      padding: 13px 22px;
      border-radius: 5px;
      border: 1px solid #dde3ec;
      background: #ffffff;
      font-weight: 500;
      font-size: 16px;
      color: #536387;
      outline: none;
      resize: none;
    }

    .formbold-form-input::placeholder,
    select.formbold-form-input {
      color: rgba(83, 99, 135, 0.5);
    }

    .formbold-form-input:focus {
      border-color: var(--warna-utama);
      box-shadow: 0px 3px 8px rgba(236, 64, 122, 0.2);
    }

    /* Form Label */
    .formbold-form-label {
      color: #536387;
      font-size: 14px;
      line-height: 24px;
      display: block;
      margin-bottom: 10px;
    }

    /* Form Section */
    .formbold-input-flex {
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
      margin-bottom: 15px;
    }

    .formbold-input-flex>div {
      flex: 1 1 100px;
      min-width: 100px;
    }

    /* Khusus untuk input tanggal agar tidak terlalu sempit */
    input[type="date"] {
      padding-left: 14px;
      padding-right: 14px;
      height: 45px;
      box-sizing: border-box;
    }

    /* Checkbox */
    #supportCheckbox:checked~div span {
      opacity: 1;
    }

    #supportCheckbox:checked~div {
      background: var(--warna-utama);
      border-color: var(--warna-utama);
    }

    .formbold-checkbox-inner {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 20px;
      height: 20px;
      margin-right: 16px;
      margin-top: 2px;
      border: 0.7px solid #dde3ec;
      border-radius: 3px;
    }

    /* File Upload */
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
      background: #EEEEEE;
      border: 0.5px solid #E7E7E7;
      border-radius: 3px;
      padding: 3px 12px;
      cursor: pointer;
      color: #637381;
      font-weight: 500;
      font-size: 12px;
      line-height: 16px;
      margin-right: 10px;
    }

    /* Button */
    .formbold-btn {
      font-size: 16px;
      border-radius: 5px;
      padding: 14px 25px;
      border: none;
      font-weight: 500;
      background-color: var(--warna-utama);
      color: white;
      cursor: pointer;
      margin-top: 25px;
    }

    .formbold-btn:hover {
      box-shadow: 0px 3px 8px rgba(236, 64, 122, 0.2);
    }
  </style>
</head>

<body>
  <div class="admin">
    <?php include '../partials/menu.php'; ?>
    <div class="content_admin">
      <h1 class="title_content_admin">Laporan Transaksi Admin</h1>

      <!-- Author: FormBold Team -->
      <!-- Learn More: https://formbold.com -->
      <form method="GET">

        <div class="formbold-input-flex">
          <div>
            <label for="post" class="formbold-form-label"> Dari Tanggal </label>
            <input
              type="date"
              name="dt"
              id="post"
              placeholder="ex:8976"
              class="formbold-form-input"
              value="<?= isset($_GET['dt']) ? $_GET['dt'] : '' ?>"
              required />
          </div>
          <div>
            <label for="city" class="formbold-form-label"> Sampai Tanggal </label>
            <input
              type="date"
              name="st"
              id="city"
              placeholder="ex: New York"
              class="formbold-form-input"
              value="<?= isset($_GET['st']) ? $_GET['st'] : '' ?>"
              required />
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
            <button type="submit" class="button-43" style="margin-top:30px;">Lihat Laporan</button>
          </div>
        </div>

      </form>
      <div <?= isset($_GET['dt']) ? '' : 'style="display:none;"' ?>>
        <table class="demo-table w-100 mt-3">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Nama Pengguna</th>
              <th>Produk</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Harga Pesanan</th>
              <th>Diskon</th>
              <th>Ongkir</th>
              <th>Total Harga</th>
            </tr>
          </thead>
          <tbody>

            <?php
            if (empty($_GET['progres']) || $_GET['progres'] == "") {
              $prog = "";
            } else {
              $prog = "AND tipe_progress='$_GET[progres]'";
            }
            $invoice = $server->query(
              " SELECT a.*,b.nama_lengkap,c.judul,c.harga FROM `invoice` a
                      LEFT JOIN akun b ON a.id_user = b.id
                      LEFT JOIN iklan c ON a.id_iklan = c.id
                      WHERE date(a.waktu)>='$_GET[dt]' AND date(a.waktu)<='$_GET[st]' 
                      $prog
                    "
            );
            $no = 1;
            $subtot = 0;
            $td = 0;
            $to = 0;
            $tot = 0;
            while ($data = mysqli_fetch_assoc($invoice)) {
            ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= newDateTime($data['waktu']) ?></td>
                <td class="text-center"><?= $data['tipe_progress'] ?></td>
                <td><?= $data['nama_lengkap'] ?></td>
                <td><?= $data['judul'] ?></td>
                <td class="text-right"><?= number_format($data['harga'], 0, ",", ".") ?></td>
                <td class="text-center"><?= $data['jumlah'] ?></td>
                <td class="text-right"><?= number_format(($data['harga'] * $data['jumlah']), 0, ",", ".") ?></td>
                <td class="text-right"><?= number_format($data['diskon_i'], 0, ",", ".") ?></td>
                <td class="text-right"><?= number_format($data['harga_ongkir'], 0, ",", ".") ?></td>
                <td class="text-right"><?= number_format(($data['harga'] * $data['jumlah']) - $data['diskon_i'] + $data['harga_ongkir'], 0, ",", ".") ?></td>
              </tr>
            <?php
              $subtot += ($data['harga'] * $data['jumlah']);
              $td += $data['diskon_i'];
              $to += $data['harga_ongkir'];
              $tot += ($data['harga'] * $data['jumlah']) - $data['diskon_i'] + $data['harga_ongkir'];
            }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="7">Sub Total</th>
              <th class="text-right"><?= number_format($subtot, 0, ",", ".") ?></th>
              <th class="text-right"><?= number_format($td, 0, ",", ".") ?></th>
              <th class="text-right"><?= number_format($to, 0, ",", ".") ?></th>
              <th class="text-right"><?= number_format($tot, 0, ",", ".") ?></th>
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
            <a href="print/print_report_range.php?dt=<?= $_GET['dt'] ?>&st=<?= $_GET['st'] ?>&progres=<?= $_GET['progres'] ?>" class="button-43" style="margin-top:30px;">Cetak PDF &nbsp;<i class="fa fa-file-pdf"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- JS -->
  <script src="../../assets/js/admin/transaction/index.js"></script>
  <script>
    $("[name='kategori']").val('<?= isset($_GET['kategori']) ? $_GET['kategori'] : '' ?>');
  </script>

  <!-- JS -->
</body>

</html>