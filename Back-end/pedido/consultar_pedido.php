<?php
include("../conexion.php");

$sql = "SELECT o.id_orden, e.nombre_empleado, c.nombre_completo AS cliente, d.tipo AS dona, 
               s.direccion AS sucursal, o.medio_entrega, o.tipo_pago, o.cantidad, o.precio_total, o.fecha_hora
        FROM ordena o
        JOIN empleado e ON o.id_empleado = e.id_empleado
        JOIN cliente c ON o.id_cliente = c.id_cliente
        JOIN donas d ON o.id_donas = d.id_donas
        JOIN sucursal s ON o.id_sucursal = s.id_sucursal";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css.css">
    <title>Pedidos Registrados</title>
    <style>
        
    </style>
</head>
<body>
    <h2 style="text-align:center;">Pedidos Registrados</h2>
    <table>
        <thead>
            <tr class="tabla">
                <th># Pedido</th>
                <th>Empleado</th>
                <th>Cliente</a></th>
                <th>Dona</th>
                <th>Sucursal</th>
                <th>Entrega</th>
                <th>Pago</th>
                <th>Cantidad</th>
                <th>Precio Total</th>
                <th>Fecha y Hora</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_orden'] ?></td>
                    <td><?= $row['nombre_empleado'] ?></td>
                    <td><?= $row['cliente'] ?></td>
                    <td><?= $row['dona'] ?></td>
                    <td><?= $row['sucursal'] ?></td>
                    <td><?= $row['medio_entrega'] ?></td>
                    <td><?= $row['tipo_pago'] ?></td>
                    <td><?= $row['cantidad'] ?></td>
                    <td>$<?= $row['precio_total'] ?></td>
                    <td><?= $row['fecha_hora'] ?></td>
                    <td><a href="../php/modificar.php?id=<?= $row['id_orden'] ?>"><img src="../img/cam.png" alt="Editar"></a></td>
                    <td><a href="../php/eliminar.php?id=<?= $row['id_orden'] ?>" onclick="return confirm('¿Seguro que quieres eliminar este pedido?');"><img src="../img/borr.png" alt="Eliminar"></a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div style="text-align:center;">
        <a href="../index.html">Volver al Inicio</a>
    </div>
</body>
</html>
