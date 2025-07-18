<?php
include("../conexion.php");

// Mostrar errores durante desarrollo
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Solo acepta peticiones POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibir datos
    $cliente       = $_POST['cliente']       ?? '';
    $dona          = $_POST['dona']          ?? '';
    $sucursal      = $_POST['sucursal']      ?? '';
    $medio_entrega = $_POST['medio_entrega'] ?? 'en tienda';
    $cantidad      = $_POST['cantidad']      ?? 0;
    $precio_total  = $_POST['precio_total']  ?? 0;
    $fecha_hora    = $_POST['fecha_hora']    ?? date('Y-m-d H:i:s');

    // Validar entrada básica
    if ($cliente && $dona && $sucursal && $cantidad > 0 && $precio_total > 0) {
        $sql = "INSERT INTO pedido (cliente, dona, sucursal, medio_entrega, cantidad, precio_total, fecha_hora)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssids", $cliente, $dona, $sucursal, $medio_entrega, $cantidad, $precio_total, $fecha_hora);

            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Pedido registrado exitosamente."]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al ejecutar: " . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "Error al preparar consulta: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Datos incompletos."]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}
?>

