<?php
include("../conexion.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre_completo'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO cliente (nombre_completo, telefono) VALUES ('$nombre', '$telefono')";

   if ($conn->query($sql) === TRUE) {
       header("Location: registro_cliente.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>