<!DOCTYPE html>
<html lang="es">

<!-- En la vista, crearemos un formulario donde los usuarios puedan escribir en Markdown.-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Películas</title>
    <link rel="stylesheet" href="../estructura/css/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Formulario de Información de Película</h2>
        <form action="formAccion.php" method="POST">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="sinopsis" class="form-label">Sinopsis (Markdown soportado)</label>
                <textarea class="form-control" id="sinopsis" name="sinopsis" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>
</html>

