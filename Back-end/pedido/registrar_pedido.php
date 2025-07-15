<?php
include("../conexion.php");

// Obtener datos para los SELECTs
$clientes = $conn->query("SELECT id_cliente, nombre_completo FROM cliente");
$donas = $conn->query("SELECT id_donas, tipo FROM donas");
$sucursales = $conn->query("SELECT id_sucursal, direccion FROM sucursal");
$empleados = $conn->query("SELECT id_empleado, nombre_empleado FROM empleado");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><link rel="stylesheet" href="../css.css">
    <title>Registrar Pedido</title>
</head>
<body>
    <h2>Formulario para Registrar Pedido</h2>
    <form action="insertar_pedido.php" method="POST">

        <label>Empleado:</label>
        <select name="id_empleado" required>
            <?php while ($emp = $empleados->fetch_assoc()): ?>
                <option value="<?= $emp['id_empleado'] ?>"><?= $emp['nombre_empleado'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Cliente:</label>
        <select name="id_cliente" required>
            <?php while ($cli = $clientes->fetch_assoc()): ?>
                <option value="<?= $cli['id_cliente'] ?>"><?= $cli['nombre_completo'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Dona:</label>
        <select name="id_donas" required>
            <?php while ($don = $donas->fetch_assoc()): ?>
                <option value="<?= $don['id_donas'] ?>"><?= $don['tipo'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Sucursal:</label>
        <select name="id_sucursal" required>
            <?php while ($suc = $sucursales->fetch_assoc()): ?>
                <option value="<?= $suc['id_sucursal'] ?>"><?= $suc['direccion'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Medio de Entrega:</label>
        <select name="medio_entrega" required>
            <option value="tienda">Tienda</option>
            <option value="domicilio">Domicilio</option>
        </select><br><br>

        <label>Tipo de Pago:</label>
        <select name="tipo_pago" required>
            <option value="efectivo">Efectivo</option>
            <option value="tarjeta">Tarjeta</option>
        </select><br><br>

        <label>Cantidad:</label>
        <input type="number" name="cantidad" min="1" required><br><br>

        <label>Precio total (MXN):</label>
        <input type="number" name="precio_total" min="0" step="0.01" required><br><br>

        <label>Fecha y hora:</label>
        <input type="datetime-local" name="fecha_hora" required><br><br>

        <button type="submit">Registrar Pedido</button>
    </form>
 <a href="../index.html">Inicio</a>
</body>
</html>
