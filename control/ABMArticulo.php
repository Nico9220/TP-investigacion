<?php
require_once '../Modelo/Conector/BaseDatos.php';
require_once '../Modelo/Articulo.php';
require_once '../vendor/erusev/parsedown/Parsedown.php'; // Asegúrate de tener Parsedown instalado

function agregarArticulo($titulo, $sinopsis) {
    $bd = new BaseDatos();
    $bd->Iniciar();
    
    $sql = "INSERT INTO articulos (titulo, sinopsis) VALUES ('$titulo', '$sinopsis')";
    $id = $bd->Ejecutar($sql);
    if ($id != -1) {
        return "Artículo agregado con éxito. ID: " . $id;
    } else {
        return "Error al agregar el artículo.";
    }
}

function modificarArticulo($id, $titulo, $sinopsis) {
    $bd = new BaseDatos();
    $bd->Iniciar();
    
    $sql = "UPDATE articulos SET titulo = '$titulo', sinopsis = '$sinopsis' WHERE id = $id";
    $resultado = $bd->Ejecutar($sql);
    if ($resultado != -1) {
        return "Artículo modificado con éxito.";
    } else {
        return "Error al modificar el artículo.";
    }
}

function obtenerArticulos() {
    $bd = new BaseDatos();
    $bd->Iniciar();
    
    $sql = "SELECT * FROM articulos";
    $cantidad = $bd->Ejecutar($sql);
    $articulos = [];
    
    if ($cantidad > 0) {
        while ($articulo = $bd->Registro()) {
            $articulos[] = $articulo;
        }
    }
    return $articulos;
}
?>
