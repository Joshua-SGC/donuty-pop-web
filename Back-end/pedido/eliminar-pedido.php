<?php
include("../conexion.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM pedido WHERE id_orden = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => $conn->error]);
    }
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "ID no recibido"]);
}
?>
