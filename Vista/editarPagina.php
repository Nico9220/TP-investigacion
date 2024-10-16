<?php
// Incluir la lógica de obtención de la página por ID
include('../configuracion.php');
include('../Control/ABMPagina.php');
include('Estructura/head.php');

// Obtener la página según el ID
$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id) {
    $pagina = obtenerPaginaPorId($id); // Función que debe retornar la página por ID
    if (!$pagina) {
        echo "Página no encontrada.";
        exit;
    }
} else {
    echo "ID no proporcionado.";
    exit;
}

// Mostrar el formulario de edición
?>
<h1 class="text-center mt-5">Editar Página</h1>
<form action="formAccion.php" method="post" class="border p-4 shadow-sm rounded">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($pagina['id']); ?>">
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" id="titulo" name="titulo" class="form-control" value="<?php echo htmlspecialchars($pagina['titulo']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="contenido" class="form-label">Contenido (Markdown)</label>
        <textarea id="contenido" name="contenido" class="form-control" rows="6" required><?php echo htmlspecialchars($pagina['contenido']); ?></textarea>
    </div>
    <button type="submit" name="action" value="Modificar" class="btn btn-primary">Guardar Cambios</button>
    <a href="formulario.php" class="btn btn-secondary">Cancelar</a>
</form>



<?php
include('Estructura/footer.php');
?>