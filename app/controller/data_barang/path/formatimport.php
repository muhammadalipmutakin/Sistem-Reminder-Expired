<?php

// formatimport.php

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="import.csv"');

$output = fopen('php://output', 'w');

// Header
$headers = ['plu', 'barcode', 'descp', 'tag', 'conv1', 'conv2', 'planogram', 'return_day', 'min_disp', 'sub_category'];

// format pemisah
$delimiter = ';';

// hasil
fputcsv($output, $headers, $delimiter);

// tutup
fclose($output);
