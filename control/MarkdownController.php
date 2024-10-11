<?php 

// El controlador manejará la lógica para recibir el texto en Markdown del formulario y procesarlo con Parsedown para convertirlo en HTML.

// Controladores/MarkdownController.php
require_once 'vendor/autoload.php'; // Incluye Composer autoload para Parsedown

use Parsedown;

class MarkdownController {

    public function procesarMarkdown() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $markdown = $_POST['markdown'] ?? '';

            if (!empty($markdown)) {
                // Convertir el Markdown a HTML usando Parsedown
                $parsedown = new Parsedown();
                $resultadoHtml = $parsedown->text($markdown);
            } else {
                $resultadoHtml = 'No se proporcionó texto en Markdown.';
            }

            // Pasar el resultado a la vista
            require_once 'Vistas/markdown_form.php';
        }
    }
}

?>
