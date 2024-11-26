<?php include('lib/phpqrcode/qrlib.php'); 
$file_name = 'QR/ejemplo.png';
QRcode::png('http://google.com.mx', $file_name,2,10,3); //no se, tamaño, margen 
?>
