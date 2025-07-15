<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM donas WHERE id_donas = $id";
    $resultado = $conn->query($sql);
    $donas = $resultado->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_donas'];
    $tipo = $_POST['tipo'];

    $update = "UPDATE donas SET tipo='$tipo' WHERE id_donas=$id";

    if ($conn->query($update) === TRUE) {
        echo "Tipo de dona actualizada correctamente.";
        header("Location: consultar_dona.php");
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
    <title>Editar tipo de dona</title>
</head>
<body>
    <h2>Editar tipo de dona</h2>
    <form method="POST" action="editar_dona.php">
        <input type="hidden" name="id_donas" value="<?= $donas['id_donas'] ?>">

        <label>Dona:</label>
        <input type="text" name="tipo" value="<?= $donas['tipo'] ?>" required><br><br>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
