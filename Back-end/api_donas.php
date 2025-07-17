<?php
include("../conexion.php");
header('Content-Type: application/json');

$sql = "SELECT * FROM donas";
$resultado = $conn->query($sql);

$donas = [];

while($row = $resultado->fetch_assoc()) {
  $donas[] = $row;
}

echo json_encode($donas);
?>
