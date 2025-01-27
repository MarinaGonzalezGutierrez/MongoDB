<?php
// Requiere el autoload de Composer
require '../../vendor/autoload.php'; // Asegúrate de que el autoload de Composer esté en la ruta correcta


// Conectar a MongoDB
$cliente = new MongoDB\Client("mongodb://localhost:27017");

// Seleccionar la base de datos y la colección
$baseDeDatos = $cliente->playasGijon; // Cambia 'playasGijon' por el nombre de tu base de datos
$coleccion = $baseDeDatos->playas; // Cambia 'playas' por el nombre de tu colección

// Leer el archivo JSON
$jsonFile = 'playas.json'; // Cambia esto por la ruta a tu archivo JSON
$jsonData = file_get_contents($jsonFile);

// Decodificar el JSON
$datos = json_decode($jsonData, true); // true para obtener un array asociativo

// Verificar si los datos se decodificaron correctamente
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error al decodificar el JSON: ' . json_last_error_msg());
}

// Insertar los datos en la colección
if (is_array($datos)) {
    // Si es un array, inserta múltiples documentos
    $resultado = $coleccion->insertMany($datos);
    echo "Se insertaron " . $resultado->getInsertedCount() . " documentos.\n";
} else {
    // Si es un solo objeto, inserta un solo documento
    $resultado = $coleccion->insertOne($datos);
    echo "Se insertó un documento con ID: " . $resultado->getInsertedId() . "\n";
}



?>