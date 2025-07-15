<?php
include("../conexion.php");

$sql = "SELECT * FROM cliente";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><link rel="stylesheet" href="../css.css">
    <title>Clientes Registrados</title>
</head>
<body>
    <h2 style="text-align:center;">Clientes Registrados</h2>
    <table>
        <thead>
            <tr>
                <th>ID Cliente</th>
                <th>Nombre</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_cliente'] ?></td>
                <td><?= $row['nombre_completo'] ?></td>
                <td><?= $row['telefono'] ?></td>
                <td><a href="editar_cliente.php?id=<?= $row['id_cliente'] ?>"><img src="../img/cam.png" alt="Editar"></a></td>
                <td><a href="eliminar_cliente.php?id=<?= $row['id_cliente'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este cliente?');"><img src="../img/borr.png" alt="Eliminar"></a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
     <div style="text-align:center;">
        <a href="../index.html">Volver al Inicio</a>
    </div>
</body>
</html>
