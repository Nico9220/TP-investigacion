<?php
require_once __DIR__ . '/../vendor/autoload.php';
include('../Control/ABMPagina.php');
include('../configuracion.php');
include('Estructura/head.php');
?>

<main class="container mt-5">
        <h1 class="text-center mb-4">Creador de páginas web simples</h1>
        <form action="formAccion.php" method="post" class="border p-4 shadow-sm rounded">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido (Markdown):</label>
                <textarea name="contenido" rows="4" cols="50" class="form-control" required></textarea>
            </div>
            <!-- <div class="mb-3">
                <label for="id" class="form-label">ID (dejar en blanco para nuevo):</label>
                <input type="number" name="id" class="form-control">
            </div> -->
            <button type="submit" name="action" value="Agregar" class="btn btn-primary w-100">Agregar</button>
        </form>

        <h1 class="text-center mt-5">Páginas</h1>
        <?php
        $parsedown = new Parsedown();
        $paginas = obtenerPaginas();
        if (!empty($paginas)): ?>
            <ul class="list-group">
                <?php foreach ($paginas as $pagina): ?>
                <form action="formAccion.php" method="post" class="border p-4 shadow-sm rounded">
                    <li class="list-group-item">
                        <h5><?php echo htmlspecialchars($pagina['titulo']); ?></h5>
                        <div><?php echo $parsedown->text($pagina['contenido']); ?></div>
                        <!-- Agregar campo oculto para enviar el ID -->
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($pagina['id']); ?>">
                        <input type="hidden" name="titulo" value="<?php echo htmlspecialchars($pagina['titulo']); ?>">
                        <input type="hidden" name="contenido" value="<?php echo htmlspecialchars($pagina['contenido']); ?>">
                    </li>
                    <div class="d-flex mt-3">
                        <a href="editarPagina.php?id=<?php echo htmlspecialchars($pagina['id']); ?>" class="btn btn-primary me-2">Modificar</a>
                        <a href="borrarPagina.php?id=<?php echo htmlspecialchars($pagina['id']); ?>" class="btn btn-danger">Borrar</a>
                    </div>
                </form>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No se encontraron páginas.</p>
        <?php endif; ?>


    </main>


<?php
include('Estructura/footer.php');
?>



