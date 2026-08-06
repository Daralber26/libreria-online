<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Autores - Librería Online</title>
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
        <li class="nav-item"><a class="nav-link active" href="autores.php">Autores</a></li>
        <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2>Listado de Autores</h2>

    <?php
    $sql = "SELECT id_autor, nombre, apellido, telefono, ciudad, estado, pais FROM autores ORDER BY apellido ASC";
    $consulta = $conexion->query($sql);
    $autores = $consulta->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <p class="subtitulo">Total de autores encontrados: <strong><?php echo count($autores); ?></strong></p>

    <div class="buscador-wrap">
        <span class="icono-buscar">🔍</span>
        <input type="text" id="buscador" class="form-control" placeholder="Buscar autor por nombre o ciudad...">
    </div>

    <div class="grid-tarjetas">
        <?php foreach ($autores as $autor): ?>
            <?php
                $nombreCompleto = trim($autor['nombre']) . ' ' . trim($autor['apellido']);
                $textoBusqueda = strtolower($nombreCompleto . ' ' . $autor['ciudad']);
            ?>
            <div class="tarjeta" data-buscar="<?php echo htmlspecialchars($textoBusqueda); ?>">
                <span class="etiqueta"><?php echo htmlspecialchars($autor['pais']); ?></span>
                <h5><?php echo htmlspecialchars($nombreCompleto); ?></h5>
                <p class="detalle"><strong>ID:</strong> <?php echo htmlspecialchars($autor['id_autor']); ?></p>
                <p class="detalle"><strong>Teléfono:</strong> <?php echo htmlspecialchars($autor['telefono']); ?></p>
                <p class="detalle"><strong>Ubicación:</strong> <?php echo htmlspecialchars($autor['ciudad'] . ', ' . $autor['estado']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <p class="sin-resultados" id="sinResultados">No se encontraron autores que coincidan con tu búsqueda.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/buscador.js"></script>
</body>
</html>