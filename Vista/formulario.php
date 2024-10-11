<!DOCTYPE html>

<!-- En la vista, crearemos un formulario donde los usuarios puedan escribir en Markdown.-->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escribir en Markdown</title>
</head>
<body>
    <h1>Escribe en Markdown</h1>
    <form action="index.php?action=procesarMarkdown" method="POST">
        <textarea name="markdown" rows="10" cols="50" placeholder="Escribe aquí tu contenido en Markdown..."></textarea><br>
        <input type="submit" value="Convertir a HTML">
    </form>

    <?php if (isset($resultadoHtml)): ?>
        <h2>Resultado en HTML:</h2>
        <div>
            <?php echo $resultadoHtml; ?>
        </div>
    <?php endif; ?>
</body>
</html>
