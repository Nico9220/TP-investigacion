<?php
// Incluir la lógica de la base de datos y funciones
include('../configuracion.php');
include('../Control/ABMPagina.php');
include('Estructura/head.php');

// Obtener el ID de la página a borrar
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    $mensaje = borrarPagina($id); // Llamar a la función que borra la página
} else {
    echo "ID no proporcionado.";
    exit;
}

// Después de borrar, redirigir a la lista de páginas o mostrar un mensaje
$paginas = obtenerPaginas();
?>

<main>
    <div class="container mt-5">
        <h2>Resultado de la Acción</h2>
        <div class="card p-4" style="background-color: #F8D7DA;">
            <h3 class="text-danger"><?php echo isset($mensaje) ? htmlspecialchars($mensaje) : ''; ?></h3>
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


<?php
include('Estructura/footer.php');
?>
