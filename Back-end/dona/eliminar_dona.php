<?php
include("../conexion.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitiza el ID

    $sql = "DELETE FROM donas WHERE id = ?"; // corrige nombre de columna si usas 'id'

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: consultar_dona.php");
            exit;
        } else {
            echo "Error al eliminar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al preparar consulta: " . $conn->error;
    }
} else {
    echo "ID no recibido.";
}

$conn->close();
?>
