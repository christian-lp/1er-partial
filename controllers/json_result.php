<?php
// Leer el archivo CSV y convertirlo a formato JSON
$file = fopen('../data/results.dat', 'r');
$data = [];

while (($row = fgetcsv($file, 0, '|')) !== false) {
    $rowData = [];
    for ($i = 0; $i < count($row); $i++) {
        $rowData["columna" . ($i + 1)] = trim($row[$i]);
    }
    $data[] = $rowData;
}

fclose($file);
    // Imprimir los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data);
?>
