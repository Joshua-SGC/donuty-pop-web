<?php
include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['tipo'];

    $sql = "INSERT INTO donas (tipo) VALUES ('$tipo')";

    if ($conn->query($sql) === TRUE) {
       header("Location: registro_dona.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
