<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM cliente WHERE id_cliente = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Cliente eliminado correctamente.";
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
}

header("Location: consultar_cliente.php");
exit;
?>
