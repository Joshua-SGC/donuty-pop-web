<?php
include("../conexion.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre     = $_POST['nombre_empleado'];
    $correo     = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    $sql = "INSERT INTO empleado (nombre_empleado, correo, contraseña)
            VALUES ('$nombre', '$correo', '$hash')";

    if ($conn->query($sql) === TRUE) {
       header("Location: registro_empleado.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
