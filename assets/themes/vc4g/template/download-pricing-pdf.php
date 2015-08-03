<?php
require_once WP_CONTENT_DIR . '/lib/dompdf/dompdf_config.inc.php';

$html =
    '<html><body>'.
    '<p>Foo</p>'.
    '</body></html>';

$dompdf = new DOMPDF();
$dompdf->load_html($html);

$dompdf->render();

// The next call will store the entire PDF as a string in $pdf

$pdf = $dompdf->output();
error_log($pdf);
error_log(var_dump($pdf));
// You can now write $pdf to disk, store it in a database or stream it
// to the client.

file_put_contents(WP_CONTENT_DIR . "/pdf/saved_pdf.pdf", $pdf);
?>