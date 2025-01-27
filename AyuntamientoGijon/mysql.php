<?php
require '../../vendor/autoload.php'; // Asegúrate de que Composer esté instalado y autoload.php esté disponible

// Conectar a MongoDB
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$mongoDb = $mongoClient->selectDatabase('playasGijon'); // Reemplaza con tu base de datos
$mongoCollection = $mongoDb->selectCollection('playas'); // Reemplaza con tu colección

// Conectar a MySQL
$servidor = "localhost:3307"; // o la dirección de tu servidor
$usuario = "root"; // usuario de MySQL
$clave = ""; // clave del usuario
$db = "playasgijon"; //base de datos

//crear coexion
$conn = new mysqli($servidor, $usuario, $clave, $db);


// Leer datos de MongoDB
$cursor = $mongoCollection->find();
foreach ($cursor as $document) {
    // Preparar la consulta de inserción
    $titulo = $conn->real_escape_string($document['titulo']);
    $correo_electronico = $conn->real_escape_string($document['correo_electronico']);
    $codigo_postal = $conn->real_escape_string($document['codigo_postal']);
    $descripcion = $conn->real_escape_string($document['descripcion']);
    $direccion = $conn->real_escape_string($document['direccion']);
    $distrito = $conn->real_escape_string($document['distrito']);
    $facebook = $conn->real_escape_string($document['facebook']);
    $googleplus = $conn->real_escape_string($document['googleplus']);
    $instagram = $conn->real_escape_string($document['instagram']);
    $linkedin = $conn->real_escape_string($document['linkedin']);
    $pinterest = $conn->real_escape_string($document['pinterest']);
    $twitter = $conn->real_escape_string($document['twitter']);
    $youtube = $conn->real_escape_string($document['youtube']);
    $fax = $conn->real_escape_string($document['fax']);
    $horario = $conn->real_escape_string($document['horario']);
    $imagen = $conn->real_escape_string($document['imagen']);
    $kml = $conn->real_escape_string($document['kml']);
    $localizacion = $conn->real_escape_string($document['localizacion']);
    $lineas_bus = $conn->real_escape_string($document['lineas_bus']);
    $materias = $conn->real_escape_string($document['materias']);
    $municipio = $conn->real_escape_string($document['municipio']);
    $observaciones = $conn->real_escape_string($document['observaciones']);
    $pluscode = $conn->real_escape_string($document['pluscode']);
    $provincia = $conn->real_escape_string($document['provincia']);
    $telefono = $conn->real_escape_string($document['telefono']);
    $web = $conn->real_escape_string($document['web']);
    $idioma = $conn->real_escape_string($document['idioma']);
    $preguntas_frecuentes = $conn->real_escape_string($document['preguntas_frecuentes']);
    $etiquetas = $conn->real_escape_string($document['etiquetas']);

    // Preparar la consulta SQL
    $sql = "INSERT INTO playas (titulo, correo_electronico, codigo_postal, descripcion, direccion, distrito, facebook, googleplus, instagram, linkedin, pinterest, twitter, youtube, fax, horario, imagen, kml, localizacion, lineas_bus, materias, municipio, observaciones, pluscode, provincia, telefono, web, idioma, preguntas_frecuentes, etiquetas) 
            VALUES ('$titulo', '$correo_electronico', '$codigo_postal', '$descripcion', '$direccion', '$distrito', '$facebook', '$googleplus', '$instagram', '$linkedin', '$pinterest', '$twitter', '$youtube', '$fax', '$horario', '$imagen', '$kml', '$localizacion', '$lineas_bus', '$materias', '$municipio', '$observaciones', '$pluscode', '$provincia', '$telefono', '$web', '$idioma', '$preguntas_frecuentes', '$etiquetas')";

    // Ejecutar la consulta
    if (!$conn->query($sql)) {
        echo "Error: " . $conn->error . "\n";
    }
}

// Cerrar la conexión a MySQL
$conn->close();

echo "Datos transferidos de MongoDB a MySQL con éxito.";
?>