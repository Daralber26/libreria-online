<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libros - Librería Online</title>
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
        <li class="nav-item"><a class="nav-link active" href="libros.php">Libros</a></li>
        <li class="nav-item"><a class="nav-link" href="autores.php">Autores</a></li>
        <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2>Listado de Libros</h2>

    <?php
    $sql = "SELECT id_titulo, titulo, tipo, precio, fecha_pub FROM titulos ORDER BY titulo ASC";
    $consulta = $conexion->query($sql);
    $libros = $consulta->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <p class="subtitulo">Total de libros encontrados: <strong><?php echo count($libros); ?></strong></p>

    <div class="buscador-wrap">
        <span class="icono-buscar">🔍</span>
        <input type="text" id="buscador" class="form-control" placeholder="Buscar libro por título o categoría...">
    </div>

    <div class="grid-tarjetas">
        <?php foreach ($libros as $libro): ?>
            <?php
                $textoBusqueda = strtolower($libro['titulo'] . ' ' . $libro['tipo']);
            ?>
            <div class="tarjeta" data-buscar="<?php echo htmlspecialchars($textoBusqueda); ?>">
                <span class="etiqueta"><?php echo htmlspecialchars($libro['tipo']); ?></span>
                <h5><?php echo htmlspecialchars($libro['titulo']); ?></h5>
                <p class="detalle"><strong>ID:</strong> <?php echo htmlspecialchars($libro['id_titulo']); ?></p>
                <p class="detalle"><strong>Publicado:</strong> <?php echo date('d/m/Y', strtotime($libro['fecha_pub'])); ?></p>
                <div class="precio">
                    <?php echo $libro['precio'] !== null ? '$' . number_format($libro['precio'], 2) : 'Precio N/D'; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <p class="sin-resultados" id="sinResultados">No se encontraron libros que coincidan con tu búsqueda.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/buscador.js"></script>
</body>
</html>