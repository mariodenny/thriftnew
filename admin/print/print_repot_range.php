<?php
session_start();
include '../../../config.php';
require_once "../../../assets/composer/mpdf/vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf();
$mpdf->AddPage("P","","","","","10","10","10","0","","","","","","","","","","","","A4");
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
$sql = mysqli_query($conn,"
                SELECT * FROM `tb_ac`
                ORDER BY idx DESC");
// $sql = mysqli_query($conn,$query);
$count = mysqli_num_rows($sql);
?>
<html> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../../assets/img/logo.ico">
	<style>
		@font-face {
			font-family: wolf;
			src: url(Wolf.ttf);
		}
		body{
			font-family: 'wolf';
		}
		.center{
			text-align:center;
		}
		.left{
			text-align:left;
		}
		.right{
			text-align:right;
		}
		.justify{
			text-align:justify;
		}
		.table-title{
			width:100px;
		}
		.titik-dua{
			width:10px; 
		}
		#st{
			width:100%;
			border-collapse: collapse;
		}
		#st tr th{
			border:1px solid black;
		}
		#st tr td{
			border:1px solid black;
		}
	</style>
</head>
<body>
	

	</body>
	</html>
	<?php
  $content = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
  ob_end_clean();
  $mpdf->WriteHTML($content);
  $mpdf->Output();
  ?>