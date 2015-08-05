<?php
require_once WP_CONTENT_DIR . '/lib/dompdf/dompdf_config.inc.php';

// $html =
//     '<html><body>'.
//     '<p>Foo</p>'.
//     '</body></html>';
// $html = file_get_contents ( __DIR__ . '/download-pricing-content.php' );
echo '<pre>';
var_dump(DOMPDF_DIR, DOMPDF_DIR);
echo '<pre>';
$dompdf = new DOMPDF();
// $dompdf->load_html($html);
$dompdf->load_html_file(DOMPDF_DIR. '/pricing/download-pricing-content.html');
$dompdf->render();

// The next call will store the entire PDF as a string in $pdf
// var_dump($pdf);
$pdf = $dompdf->output();
// error_log($pdf);
// error_log(var_dump($pdf));
// You can now write $pdf to disk, store it in a database or stream it
// to the client.

file_put_contents(ABSPATH . "/pdf/saved_pdf-3.pdf", $pdf);
?>