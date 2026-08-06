<?php
include 'conexion.php';

$mensaje = "";
$tipo_mensaje = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo']);
    $nombre = trim($_POST['nombre']);
    $asunto = trim($_POST['asunto']);
    $comentario = trim($_POST['comentario']);

    if ($correo && $nombre && $asunto && $comentario) {
        try {
            $sql = "INSERT INTO contacto (fecha, correo, nombre, asunto, comentario) 
                    VALUES (NOW(), :correo, :nombre, :asunto, :comentario)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':asunto', $asunto);
            $stmt->bindParam(':comentario', $comentario);
            $stmt->execute();

            $mensaje = "¡Gracias! Tu mensaje fue enviado correctamente.";
            $tipo_mensaje = "success";
        } catch (PDOException $e) {
            $mensaje = "Error al guardar el mensaje: " . $e->getMessage();
            $tipo_mensaje = "danger";
        }
    } else {
        $mensaje = "Por favor completa todos los campos.";
        $tipo_mensaje = "warning";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto - Librería Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">📚 Librería Online</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="libros.php">Libros</a></li>
        <li class="nav-item"><a class="nav-link" href="autores.php">Autores</a></li>
        <li class="nav-item"><a class="nav-link active" href="contacto.php">Contacto</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4">Contáctanos</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-<?php echo $tipo_mensaje; ?>"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <form method="POST" action="contacto.php">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" name="correo" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Asunto</label>
            <input type="text" class="form-control" name="asunto" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Comentario</label>
            <textarea class="form-control" name="comentario" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar mensaje</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>