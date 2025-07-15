<?php
include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_orden = $_POST['id_orden'];
    $id_empleado = $_POST['id_empleado'];
    $id_cliente = $_POST['id_cliente'];
    $id_donas = $_POST['id_donas'];
    $id_sucursal = $_POST['id_sucursal'];
    $medio_entrega = $_POST['medio_entrega'];
    $tipo_pago = $_POST['tipo_pago'];
    $cantidad = $_POST['cantidad'];
    $precio_total = $_POST['precio_total'];
    $fecha_hora = $_POST['fecha_hora'];

    $sql = "UPDATE ordena SET
        id_empleado = '$id_empleado',
        id_cliente = '$id_cliente',
        id_donas = '$id_donas',
        id_sucursal = '$id_sucursal',
        medio_entrega = '$medio_entrega',
        tipo_pago = '$tipo_pago',
        cantidad = '$cantidad',
        precio_total = '$precio_total',
        fecha_hora = '$fecha_hora'
        WHERE id_orden = '$id_orden'";

    if ($conn->query($sql) === TRUE) {
         header("Location: ../pedido/consultar_pedidos.php");
    } else {
        echo "Error al actualizar: " . $conn->error;
    }

    $conn->close();
}
?>
