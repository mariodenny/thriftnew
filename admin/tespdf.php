<?php
session_start();
require_once "../assets/composer/mpdf/vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf();
$mpdf->AddPage("P","","","","","10","10","10","0","","","","","","","","","","","","A4");
// $mpdf->SetWatermarkImage ( "../assets/img/kemnaker.png"/*,"0", "D", "F"*/);
$mpdf->showWatermarkImage = true;
$mpdf->watermarkImageAlpha = 0.05;
ob_start();
?>
<html> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	
</head>
<body>
	
	dfhdhfdhd
	</body>
	</html>
	<?php
  $content = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
  ob_end_clean();
  $mpdf->WriteHTML($content);
  $mpdf->Output();
  ?>