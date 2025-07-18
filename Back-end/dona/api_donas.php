<?php
include("../conexion.php");

$sql = "SELECT * FROM donas";
$resultado = $conn->query($sql);

$donas = [];

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $base64 = base64_encode($row['imagen']); // codifica la imagen BLOB a base64
        $base64 = $row["imagen"];
        $tipoImagen = "image/jpeg"; // Ajusta esto si tienes otro formato (png, gif, etc.)

        $donas[] = [
            "id" => $row["id"],
            "nombre" => $row["nombre"],
            "imagen" => "data:" . $tipoImagen . ";base64," . $base64,

            "precio" => $row["precio"]
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($donas);
?>
