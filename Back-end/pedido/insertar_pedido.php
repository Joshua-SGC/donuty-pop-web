<?php
include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empleado = $_POST['id_empleado'];
    $id_cliente = $_POST['id_cliente'];
    $id_donas = $_POST['id_donas'];
    $id_sucursal = $_POST['id_sucursal'];
    $medio_entrega = $_POST['medio_entrega'];
    $tipo_pago = $_POST['tipo_pago'];
    $cantidad = $_POST['cantidad'];
    $precio_total = $_POST['precio_total'];
    $fecha_hora = $_POST['fecha_hora'];

    echo "Empleado: $id_empleado<br>";
echo "Cliente: $id_cliente<br>";
echo "Dona: $id_donas<br>";
echo "Sucursal: $id_sucursal<br>";



    $sql = "INSERT INTO ordena (
        id_empleado, id_cliente, id_donas, id_sucursal, medio_entrega, tipo_pago, cantidad, precio_total, fecha_hora
    ) VALUES (
        '$id_empleado', '$id_cliente', '$id_donas', '$id_sucursal', '$medio_entrega', '$tipo_pago', '$cantidad', '$precio_total', '$fecha_hora'
    )";

    $productos = json_decode($_POST['productos'], true);
foreach ($productos as $dona) {
  // Aquí puedes insertar cada dona en la tabla de pedidos o guardar el resumen
}


    if ($conn->query($sql) === TRUE) {
        header("Location: consultar_pedidos.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
