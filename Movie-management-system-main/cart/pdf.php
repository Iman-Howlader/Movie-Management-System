<?php
require_once('./dompdf/autoload.inc.php');

use Dompdf\Dompdf;
$dompdf = new Dompdf();

$username = "xyz";
$cnt = 0;

$html = '<h1>Irfan Shah Mayeen</h1>';

//////////////////////////////////////////
//file_get_contents('cart.html');

$dompdf->loadHtml($html3);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();
$dompdf->stream();
?>
