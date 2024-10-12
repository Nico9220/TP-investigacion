<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Artículos</title>
</head>
<body>
    <h1>Agregar o Modificar Artículo</h1>
    <form action="formAccion.php" method="post">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br>
        
        <label for="sinopsis">Sinopsis (Markdown):</label>
        <textarea name="sinopsis" rows="4" cols="50" required></textarea><br>
        
        <label for="id">ID (dejar en blanco para nuevo):</label>
        <input type="number" name="id"><br>
        
        <input type="submit" name="action" value="Agregar">
        <input type="submit" name="action" value="Modificar">
    </form>
</body>
</html>



