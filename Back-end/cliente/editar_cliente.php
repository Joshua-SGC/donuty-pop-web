<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cliente WHERE id_cliente = $id";
    $resultado = $conn->query($sql);
    $cliente = $resultado->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_cliente'];
    $nombre = $_POST['nombre_completo'];
    $telefono = $_POST['telefono'];

    $update = "UPDATE cliente SET nombre_completo='$nombre', telefono='$telefono' WHERE id_cliente=$id";

    if ($conn->query($update) === TRUE) {
        echo "Cliente actualizado correctamente.";
        header("Location: consultar_cliente.php");
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
    <title>Editar cliente</title>
</head>
<body>
    <h2>Editar Cliente</h2>
    <form method="POST" action="editar_cliente.php">
        <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?>">

        <label>Nombre completo:</label>
        <input type="text" name="nombre_completo" value="<?= $cliente['nombre_completo'] ?>" required><br><br>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?= $cliente['telefono'] ?>" required><br><br>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
