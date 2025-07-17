<?php
include("../conexion.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['id'])) {
    echo "ID no proporcionado.";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM donas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$dona = $resultado->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $sabor = $_POST['sabor'];
    $precio = $_POST['precio'];

    // Verifica si se subió imagen nueva
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagenBase64 = base64_encode(file_get_contents($_FILES['imagen']['tmp_name']));
        $sql = "UPDATE donas SET nombre = ?, sabor = ?, precio = ?, imagen = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsi", $nombre, $sabor, $precio, $imagenBase64, $id);
    } else {
        $sql = "UPDATE donas SET nombre = ?, sabor = ?, precio = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi", $nombre, $sabor, $precio, $id);
    }

    if ($stmt->execute()) {
        header("Location: consultar_dona.php");
        exit;
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Dona</title>
  <link rel="stylesheet" href="../../Front-end/css/estilo.css">
  <style>
    body {
      font-family: 'Nunito', sans-serif;
      padding: 40px;
      background-color: #fff7fb;
    }
    h2 {
      color: #d8185b;
      text-align: center;
    }
    form {
      background: #fff;
      padding: 30px;
      max-width: 500px;
      margin: auto;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input[type="text"],
    input[type="number"],
    input[type="file"] {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    button {
      margin-top: 20px;
      background-color: #f72c73;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
    }
    img {
      margin-top: 10px;
      border-radius: 6px;
      max-width: 120px;
    }
    button {
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
  <h2>Editar Dona</h2>
  <form action="" method="post" enctype="multipart/form-data">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($dona['nombre']) ?>" required>

    <label>Sabor:</label>
    <input type="text" name="sabor" value="<?= htmlspecialchars($dona['sabor']) ?>" required>

    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" value="<?= number_format($dona['precio'], 2, '.', '') ?>" required>

    <label>Imagen actual:</label>
    <img src="data:image/jpeg;base64,<?= $dona['imagen'] ?>" alt="Imagen actual">

    <label>Subir nueva imagen (opcional):</label>
    <input type="file" name="imagen" accept="image/*">

    <button type="submit">Guardar Cambios</button>
  </form>
</body>
</html>
