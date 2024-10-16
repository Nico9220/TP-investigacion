<?php
// Incluir configuraciones y ParseDown
include('../configuracion.php');
include('../Control/ABMPagina.php'); // Asegúrate de incluir tu controlador ABM
include('../vendor/autoload.php');
include('./utiles/funciones.php');
include('Estructura/head.php');

// Obtengo los datos del formulario que encapsulé
$datos = data_submitted(); // Esta función debe estar en funciones.php

// Extraigo los datos individualmente
$titulo = isset($datos['titulo']) ? $datos['titulo'] : 'Sin título';
$contenido = isset($datos['contenido']) ? $datos['contenido'] : 'Sin contenido';
$id = isset($datos['id']) ? $datos['id'] : null; // ID para modificar, si se proporciona

// Instancio ParseDown para convertir Markdown a HTML
$parsedown = new Parsedown();
$contenido_html = $parsedown->text($contenido); // Convierte el Markdown a HTML

// Acción de agregar o modificar
if (isset($datos['action'])) {
    if ($datos['action'] === 'Agregar') {
        $mensaje = agregarPagina($titulo, $contenido);
    } 
    // elseif ($datos['action'] === 'Borrar') {
    //     $mensaje = borrarPagina($titulo, $contenido);
    // }
     elseif ($datos['action'] === 'Modificar' && $id !== null) {
        $mensaje = modificarPagina($id, $titulo, $contenido);
    }
}

// Obtener todos los artículos después de la acción
$paginas = obtenerPaginas();
?>

<main>
    <div class="container mt-5">
        <h2>Resultado de la Acción</h2>
        <div class="card p-4" style="background-color: #D8F1CF;">
            <h3 class="text-primary"><?php echo isset($mensaje) ? htmlspecialchars($mensaje) : ''; ?></h3>
            <div class="mt-3">
                <h5>Contenido (Formato Markdown):</h5>
                <div class="contenido">
                    <?php echo $contenido_html; ?>
                </div>
            </div>
        </div>
        <br>
        <h4>Páginas</h4>
        <?php if (!empty($paginas)): ?>
            <ul class="list-group">
                <?php foreach ($paginas as $pagina): ?>
                    <li class="list-group-item">
                        <h5><?php echo htmlspecialchars($pagina['titulo']); ?></h5>
                        <div><?php echo $parsedown->text($pagina['contenido']); ?></div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No se encontraron páginas.</p>
        <?php endif; ?>
        <a class="btn btn-primary" href="formulario.php">Volver</a>
    </div>
</main>
</html>

