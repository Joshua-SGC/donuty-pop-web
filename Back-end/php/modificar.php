<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $id_orden = $_GET['id'];

    // Obtener los datos actuales del pedido
    $query = "SELECT * FROM ordena WHERE id_orden = $id_orden";
    $result = $conn->query($query);
    $pedido = $result->fetch_assoc();

    // Obtener listas para los selects
    $empleados = $conn->query("SELECT id_empleado, nombre_empleado FROM empleado");
    $clientes = $conn->query("SELECT id_cliente, nombre_completo FROM cliente");
    $donas = $conn->query("SELECT id_donas, tipo FROM donas");
    $sucursales = $conn->query("SELECT id_sucursal, direccion FROM sucursal");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><link rel="stylesheet" href="../css.css">
    <title>Actualizar Pedido</title>
</head>
<body>
    <h2>Editar Pedido</h2>
    <form action="actualizar.php" method="POST">
        <input type="hidden" name="id_orden" value="<?= $pedido['id_orden'] ?>">

        <label>Empleado:</label>
        <select name="id_empleado" required>
            <?php while ($row = $empleados->fetch_assoc()): ?>
                <option value="<?= $row['id_empleado'] ?>" <?= $row['id_empleado'] == $pedido['id_empleado'] ? 'selected' : '' ?>>
                    <?= $row['nombre_empleado'] ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Cliente:</label>
        <select name="id_cliente" required>
            <?php while ($row = $clientes->fetch_assoc()): ?>
                <option value="<?= $row['id_cliente'] ?>" <?= $row['id_cliente'] == $pedido['id_cliente'] ? 'selected' : '' ?>>
                    <?= $row['nombre_completo'] ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Dona:</label>
        <select name="id_donas" required>
            <?php while ($row = $donas->fetch_assoc()): ?>
                <option value="<?= $row['id_donas'] ?>" <?= $row['id_donas'] == $pedido['id_donas'] ? 'selected' : '' ?>>
                    <?= $row['tipo'] ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Sucursal:</label>
        <select name="id_sucursal" required>
            <?php while ($row = $sucursales->fetch_assoc()): ?>
                <option value="<?= $row['id_sucursal'] ?>" <?= $row['id_sucursal'] == $pedido['id_sucursal'] ? 'selected' : '' ?>>
                    <?= $row['direccion'] ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Medio de Entrega:</label>
        <select name="medio_entrega" required>
            <option value="tienda" <?= $pedido['medio_entrega'] == 'tienda' ? 'selected' : '' ?>>Tienda</option>
            <option value="domicilio" <?= $pedido['medio_entrega'] == 'domicilio' ? 'selected' : '' ?>>Domicilio</option>
        </select><br><br>

        <label>Tipo de Pago:</label>
        <select name="tipo_pago" required>
            <option value="efectivo" <?= $pedido['tipo_pago'] == 'efectivo' ? 'selected' : '' ?>>Efectivo</option>
            <option value="tarjeta" <?= $pedido['tipo_pago'] == 'tarjeta' ? 'selected' : '' ?>>Tarjeta</option>
        </select><br><br>

        <label>Cantidad:</label>
        <input type="number" name="cantidad" value="<?= $pedido['cantidad'] ?>" min="1" required><br><br>

        <label>Precio total (MXN):</label>
        <input type="number" name="precio_total" value="<?= $pedido['precio_total'] ?>" min="0" step="0.01" required><br><br>

        <label>Fecha y hora:</label>
        <input type="datetime-local" name="fecha_hora" value="<?= date('Y-m-d\TH:i', strtotime($pedido['fecha_hora'])) ?>" required><br><br>

        <button type="submit">Actualizar Pedido</button>
    </form>
</body>
</html>
