<?php
// Incluir configuraciones y ParseDown
include('../configuracion.php');
include('../Control/ParseDownController.php'); // ParseDown para procesar Markdown
include('../vendor/autoload.php');
include('./utiles/funciones.php');

// Obtengo los datos del formulario que encapsulé
$datos = data_submitted();

// Extraigo los datos individualmente
$titulo = isset($datos['titulo']) ? $datos['titulo'] : 'Sin título';
$sinopsis = isset($datos['sinopsis']) ? $datos['sinopsis'] : 'Sin sinopsis';

// Instancio ParseDown para convertir Markdown a HTML
$parsedown = new Parsedown();
$sinopsis_html = $parsedown->text($sinopsis); // Convierte el Markdown a HTML

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la Película</title>
    <link rel="stylesheet" href="../estructura/css/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Película Introducida</h2>
        <div class="card p-4" style="background-color: #D8F1CF;">
            <h3 class="text-primary">Título: <?php echo htmlspecialchars($titulo); ?></h3>
            <div class="mt-3">
                <h5>Sinopsis (Formato Markdown):</h5>
                <div class="sinopsis">
                    <?php echo $sinopsis_html; // Mostrar la sinopsis procesada ?>
                </div>
            </div>
        </div>
        <br>
        <a class="btn btn-primary" href="formulario.php">Volver</a>
    </div>
</body>
</html>
