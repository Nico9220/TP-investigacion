<?php

class ParsedownController {

    public function renderMarkdownToHtml($markdownText) {
        // Crear una instancia de Parsedown
        $parsedown = new Parsedown();

        // Convertir el Markdown a HTML
        $html = $parsedown->text($markdownText);

        // Devolver el HTML convertido
        return $html;
    }
}
