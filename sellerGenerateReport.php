<?php
require './dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Initialize Dompdf with options
$options = new Options();
$options->set('defaultFont', 'Courier');
$dompdf = new Dompdf($options);

// Load HTML content from file
ob_start();
include 'sellerReport.php';
$html = ob_get_clean();

// Load HTML into Dompdf
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A3', 'portrait');

// Render the PDF
$dompdf->render();

// Output the generated PDF to a file
$output = $dompdf->output();
file_put_contents('reports/sellerInvoice.pdf'.uniqid(), $output);

$dompdf->stream();

// header("Location: adminPanal.php");

?>