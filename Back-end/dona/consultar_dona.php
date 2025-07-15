<?php
include("../conexion.php");

$sql = "SELECT * FROM donas";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><link rel="stylesheet" href="../css.css">
    <title>Donas Registrados</title>
</head>
<body>
    <h2>Donas Registrados</h2>
    <table>
        <thead>
            <tr>
                <th>ID Dona</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_donas'] ?></td>
                <td><?= $row['tipo'] ?></td>
                <td><a href="editar_dona.php?id=<?= $row['id_donas'] ?>"><img src="../img/cam.png" alt="Editar"></a></td>
                <td><a href="eliminar_dona.php?id=<?= $row['id_donas'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este producto?');"><img src="../img/borr.png" alt="Eliminar"></a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
     <div style="text-align:center;">
        <a href="../index.html">Volver al Inicio</a>
    </div>
</body>
</html>
