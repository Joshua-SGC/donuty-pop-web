<?php
include("../conexion.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

$sql = "SELECT id_orden, cliente, dona, sucursal, medio_entrega, cantidad, precio_total, fecha_hora FROM pedido";
$resultado = $conn->query($sql);
$pedidos = [];

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $pedidos[] = [
            "id_orden"     => $row["id_orden"],
            "cliente"      => $row["cliente"],
            "dona"         => $row["dona"],
            "sucursal"     => $row["sucursal"],
            "medio_entrega"=> $row["medio_entrega"],
            "cantidad"     => (int)$row["cantidad"],
            "precio_total" => (float)$row["precio_total"],
            "fecha_hora"   => $row["fecha_hora"]
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($pedidos);
$conn->close();
?>
