<?php
// Incluir configuraciones y ParseDown
include('../configuracion.php');
include('../Control/abmArticulo.php'); // Asegúrate de incluir tu controlador ABM
include('../vendor/autoload.php');
include('./utiles/funciones.php');

// Obtengo los datos del formulario que encapsulé
$datos = data_submitted(); // Esta función debe estar en funciones.php

// Extraigo los datos individualmente
$titulo = isset($datos['titulo']) ? $datos['titulo'] : 'Sin título';
$sinopsis = isset($datos['sinopsis']) ? $datos['sinopsis'] : 'Sin sinopsis';
$id = isset($datos['id']) ? $datos['id'] : null; // ID para modificar, si se proporciona

// Instancio ParseDown para convertir Markdown a HTML
$parsedown = new Parsedown();
$sinopsis_html = $parsedown->text($sinopsis); // Convierte el Markdown a HTML

// Acción de agregar o modificar
if (isset($datos['action'])) {
    if ($datos['action'] === 'Agregar') {
        $mensaje = agregarArticulo($titulo, $sinopsis);
    } elseif ($datos['action'] === 'Modificar' && $id !== null) {
        $mensaje = modificarArticulo($id, $titulo, $sinopsis);
    }
}

// Obtener todos los artículos después de la acción
$articulos = obtenerArticulos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la Acción</title>
    <link rel="stylesheet" href="../estructura/css/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Resultado de la Acción</h2>
        <div class="card p-4" style="background-color: #D8F1CF;">
            <h3 class="text-primary"><?php echo isset($mensaje) ? htmlspecialchars($mensaje) : ''; ?></h3>
            <div class="mt-3">
                <h5>Sinopsis (Formato Markdown):</h5>
                <div class="sinopsis">
                    <?php echo $sinopsis_html; // Mostrar la sinopsis procesada ?>
                </div>
            </div>
        </div>
        <br>
        <h4>Lista de Artículos</h4>
        <?php if (!empty($articulos)): ?>
            <ul class="list-group">
                <?php foreach ($articulos as $articulo): ?>
                    <li class="list-group-item">
                        <h5><?php echo htmlspecialchars($articulo['titulo']); ?></h5>
                        <div><?php echo $parsedown->text($articulo['sinopsis']); ?></div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No se encontraron artículos.</p>
        <?php endif; ?>
        <a class="btn btn-primary" href="formulario.php">Volver</a>
    </div>
</body>
</html>

