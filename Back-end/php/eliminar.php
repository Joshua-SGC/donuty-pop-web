<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $id_orden = $_GET['id'];

    $sql = "DELETE FROM ordena WHERE id_orden = $id_orden";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../pedido/consultar_pedidos.php");
        exit();
    } else {
        echo "Error al eliminar el pedido: " . $conn->error;
    }
} else {
    echo "ID de pedido no proporcionado.";
}
?>
