<?php
// session_start();
include '../../../config.php';
require_once "../../../assets/composer/mpdf/vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf();
$mpdf->AddPage("L","","","","","10","10","10","0","","","","","","","","","","","","A4");
$mpdf->SetWatermarkImage ( "../assets/img/kemnaker.png"/*,"0", "D", "F"*/);
$mpdf->showWatermarkImage = true;
$mpdf->watermarkImageAlpha = 0.05;
ob_start();
function newDate($date){
	return explode('-', $date)[2]."/".explode('-', $date)[1]."/".explode('-', $date)[0];
}
function newDateBack($date){
	return explode('/', $date)[2]."-".explode('/', $date)[1]."-".explode('/', $date)[0];
}
function newDateTime($dateTime){
	$date = explode(' ', $dateTime)[0];
	return explode('-', $date)[2]."/".explode('-', $date)[1]."/".explode('-', $date)[0]." ".explode(' ', $dateTime)[1];
}
// $sql = mysqli_query($conn,"
//                 SELECT * FROM `tb_ac`
//                 ORDER BY idx DESC");
// // $sql = mysqli_query($conn,$query);
// $count = mysqli_num_rows($sql);
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
        margin: 20px 0; /* Jarak antar tabel dan elemen lainnya */
        border-spacing: 0; /* Jarak antar sel */
    }
    #st tr th, #st tr td {
        border: 1px solid black;
        padding: 8px; /* Jarak dalam sel */
        text-align: center;
    }
    #st tr th {
        background-color: #f2f2f2;
    }
    /* Atur lebar kolom nomor */
    #st tr td:first-child, #st tr th:first-child {
        width: 40px; /* Lebar tetap untuk kolom nomor */
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
			<!-- <h3>PEMERINTAH DAERAH KABUPATEN SUBANG</h3>
			<h2>DINAS KOPERASI, UMKM, PERDAGANGAN DAN PERINDUSTRIAN</h2>
			<p>Alamat : Jalan Aipda KS Tubun No. 14 Subang kode Pos : 41211</p>
			<p>Telp. (0260)-411310 Fax. (0260)-412966 </p>
			<p>Email : diskoperindagsarsubang@gmail.com</p> -->
			<h1 class="center">Laporan Transaksi Perbulan</h1>

		</td>
	</tr>
</table>
	
	<hr>
		<h4>Periode Bulan : <?=$_GET['bulan']?> / <?=$_GET['tahun']?></h4>
        <h4>Progres : <?=$_GET['progres']==""?"Semua":$_GET['status']?></h4>
		<table  id="st" >
			<tr class="center">
                <th>No</th>
                <th>Tanggal</th>
                <th>Total</th>
			</tr>
			
			<?php
                  if(empty($_GET['progres']) || $_GET['progres']==""){
                    $prog = "";
                  }else{
                    $prog = "AND tipe_progress='$_GET[progres]'";
                  }
                  $invoice = $server->query(
                    " SELECT a.*,b.nama_lengkap,c.judul,c.harga,SUM(a.harga_i) sumh,date(a.waktu) datet FROM `invoice` a
                      LEFT JOIN akun b ON a.id_user = b.id
                      LEFT JOIN iklan c ON a.id_iklan = c.id
                      WHERE month(a.waktu)='$_GET[bulan]' AND year(a.waktu)='$_GET[tahun]' 
                      $prog
                      GROUP BY date(a.waktu)
                    "
                  );
                  $no=1;
                  $subtot=0;
				  $count = mysqli_num_rows($invoice);
                  while ($data = mysqli_fetch_assoc($invoice)) {
                  ?>
                    <tr>
                      <td class="text-center"><?=$no++?></td>
                      <td><?=newDate($data['datet'])?></td>
                      <td class="text-right"><?=number_format($data['sumh'],0,",",".")?></td>
                    </tr>
                  <?php
				  $subtot+=$data['sumh'];
                  }
                  ?>
			<tr>
				<th colspan="2"  class="text-left">Total</th>
				<th class="text-right">Rp. <?=number_format($subtot,0,",",".");?></th>
			</tr>
		</table>
		<?php 
		if($count==0){
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
  $content = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
  ob_end_clean();
  $mpdf->WriteHTML($content);
  $mpdf->Output();
  ?>