<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM empleado WHERE id_empleado = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Empleado eliminado correctamente.";
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
}

header("Location: consultar_empleado.php");
exit;
?>
