<?php
include("../conexion.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['registro'])) {
    $nombre = $_POST['nombre'] ?? '';
    $sabor = $_POST['sabor'] ?? '';
    $precio = $_POST['precio'] ?? '';

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagenTemporal = $_FILES['imagen']['tmp_name'];
        $imagenBase64 = base64_encode(file_get_contents($imagenTemporal));

        $sql = "INSERT INTO donas (nombre, sabor, precio, imagen) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssds", $nombre, $sabor, $precio, $imagenBase64);
            if ($stmt->execute()) {
                echo "Dona registrada exitosamente.";
            } else {
                echo "Error al insertar: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error al preparar consulta: " . $conn->error;
        }
    } else {
        echo "No se recibió imagen correctamente. Código: " . $_FILES['imagen']['error'];
    }

    $conn->close();
}
?>
