<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM donas WHERE id_donas = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Dona eliminada correctamente.";
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
}

header("Location: consultar_dona.php");
exit;
?>
