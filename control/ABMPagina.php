<?php
include_once __DIR__ . '/../includes/configuracion.php';
include_once ROOT_PATH . '/modelo/conector/BaseDatos.php';
include_once ROOT_PATH . '/modelo/Pagina.php';
include_once ROOT_PATH . '/vendor/erusev/parsedown/Parsedown.php'; // Asegúrate de tener Parsedown instalado

function agregarPagina($titulo, $contenido) {
    $bd = new BaseDatos();
    $bd->Iniciar();
    
    $sql = "INSERT INTO paginas (titulo, contenido) VALUES ('$titulo', '$contenido')";
    $id = $bd->Ejecutar($sql);
    if ($id != -1) {
        return "Página agregado con éxito. ID: " . $id;
    } else {
        return "Error al agregar página.";
    }
}

function modificarPagina($id, $titulo, $contenido) {
    $bd = new BaseDatos();
    $bd->Iniciar();
    
    $sql = "UPDATE paginas SET titulo = '$titulo', contenido = '$contenido' WHERE id = $id";
    $resultado = $bd->Ejecutar($sql);
    if ($resultado != -1) {
        return "Página modificada con éxito.";
    } else {
        return "Error al modificar página.";
    }
}

function borrarPagina($id) {
    $bd = new BaseDatos();
    $bd->Iniciar();
    
    // Evitar inyección SQL asegurando que el ID es un número entero
    $sql = "DELETE FROM paginas WHERE id = $id";
    $resultado = $bd->Ejecutar($sql);
    
    if ($resultado != -1) {
        return "Página borrada con éxito.";
    } else {
        return "Error al borrar la página.";
    }
}

function obtenerPaginas() {
    $bd = new BaseDatos();
    $bd->Iniciar();
    
    $sql = "SELECT * FROM paginas";
    $cantidad = $bd->Ejecutar($sql);
    $paginas = [];
    
    if ($cantidad > 0) {
        while ($pagina = $bd->Registro()) {
            $paginas[] = $pagina;
        }
    }
    return $paginas;
}

function obtenerPaginaPorId($id) {
    $bd = new BaseDatos();
    $bd->Iniciar();
    
    // Evitar inyección SQL asegurando que el ID es un número entero
    $sql = "SELECT * FROM paginas WHERE id = $id";
    $cantidad = $bd->Ejecutar($sql);
    
    if ($cantidad > 0) {
        $pagina = $bd->Registro(); // Devuelve el registro de la página encontrada
        return $pagina;
    } else {
        return null; // No se encontró ninguna página con el ID dado
    }
}

?>
