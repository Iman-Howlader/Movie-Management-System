<?php
require_once('./dompdf/autoload.inc.php');

use Dompdf\Dompdf;
$dompdf = new Dompdf();

for ($x = 0; $x <= 10; $x++) {
    $html = '<h1 style="color:red;">Hello world </h1>';
  }


//$html = file_get_contents('./test.html');
$dompdf->loadHtml($html);

$dompdf->setPaper('A4','landscape');

$dompdf->render();
$dompdf->stream();


?>
