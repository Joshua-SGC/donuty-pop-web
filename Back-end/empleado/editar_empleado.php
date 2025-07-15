<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM empleado WHERE id_empleado = $id";
    $resultado = $conn->query($sql);
    $empleado = $resultado->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_empleado'];
    $nombre = $_POST['nombre_empleado'];
    $correo = $_POST['correo'];

    $update = "UPDATE empleado SET nombre_empleado='$nombre', correo='$correo' WHERE id_empleado=$id";

    if ($conn->query($update) === TRUE) {
        echo "empleado actualizado correctamente.";
        header("Location: consultar_empleado.php");
        exit;
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><link rel="stylesheet" href="../css.css">
    <title>Editar empleado</title>
</head>
<body>
    <h2>Editar empleado</h2>
    <form method="POST" action="editar_empleado.php">
        <input type="hidden" name="id_empleado" value="<?= $empleado['id_empleado'] ?>">

        <label>Nombre:</label>
        <input type="text" name="nombre_empleado" value="<?= $empleado['nombre_empleado'] ?>" required><br><br>

        <label>Correo:</label>
        <input type="text" name="correo" value="<?= $empleado['correo'] ?>" required><br><br>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
