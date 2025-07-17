<?php
include("../conexion.php");
$sql = "SELECT * FROM donas";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Donas Registradas</title>
  <link rel="stylesheet" href="../css.css">
    <style>
    body {
      font-family: 'Nunito', sans-serif;
      padding: 40px;
      background-color: #fff7fb;
    }
    h2 {
      color: #d8185b;
      text-align: center;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #eee;
      text-align: center;
    }
    th {
      background-color: #f72c73;
      color: white;
    }
    img {
      max-height: 60px;
      border-radius: 6px;
    }
    a img {
      width: 25px;
    }
    
    button{
  display: inline-block;
  background-color: #f72c73;
  color: white;
  font-family: 'Nunito', sans-serif;
  font-weight: 600;
  padding: 12px 24px;
  margin: 20px auto;
  border: none;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  text-align: center;
  text-decoration: none;
  transition: background 0.3s ease;
  cursor: pointer;
}

 button:hover {
  background-color: #d8185b;
}
  </style>
</head>
<body>
  <h2>Donas Registradas</h2>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Sabor</th>
        <th>Imagen</th>
        <th>Precio</th>
        <th>Editar</th>
        <th>Eliminar</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $resultado->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nombre'] ?></td>
        <td><?= $row['sabor'] ?></td>
        <td><img src="data:image/jpeg;base64,<?= $row['imagen'] ?>" alt="Dona" width="60"></td>
        <td>$<?= number_format($row['precio'], 2) ?></td>
        <td>
          <a href="editar_dona.php?id=<?= $row['id'] ?>">
            <button>Editar</button>
          </a>
        </td>
        <td>
          <a href="eliminar_dona.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar esta dona?');">
            <p>Borrar</p>
          </a>
        </td>
      </tr>
      <?php endwhile; $conn->close(); ?>
    </tbody>
  </table>
  <div style="text-align:center;">
    <a href="../../insertar_dona"><button>Atras</button></a>
  </div>
  <div style="text-align:center;">
    <a href="../../../index.html"><button>Volver al Inicio</button></a>
  </div>
</body>
</html>
