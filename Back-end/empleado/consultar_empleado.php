<?php
include("../conexion.php");

$sql = "SELECT * FROM empleado";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><link rel="stylesheet" href="../css.css">
    <title>Empleados Registrados</title>
</head>
<body>
    <h2>Empleados Registrados</h2>
    <table>
        <thead>
            <tr>
                <th>ID Empleado</th>
                <th>Nombre</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_empleado'] ?></td>
                <td><?= $row['nombre_empleado'] ?></td>
                <td><?= $row['correo'] ?></td>
                <td><a href="editar_empleado.php?id=<?= $row['id_empleado'] ?>"><img src="../img/cam.png" alt="Editar"></a></td>
                <td><a href="eliminar_empleado.php?id=<?= $row['id_empleado'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este empleado?');"><img src="../img/borr.png" alt="Eliminar"></a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
     <div style="text-align:center;">
        <a href="../index.html">Volver al Inicio</a>
    </div>
</body>
</html>
