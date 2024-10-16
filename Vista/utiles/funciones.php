<?php
function data_submitted()
{
    $_AAux = array();

    // Obtener datos de POST o GET
    if (!empty($_POST)) {
        $_AAux = $_POST;
    } elseif (!empty($_GET)) {
        $_AAux = $_GET;
    }

    // Obtener datos de archivos de $_FILES
    if (!empty($_FILES)) {
        foreach ($_FILES as $key => $file) {
            $_AAux[$key] = $file;
        }
    }

    // Si hay valores vacíos, se asigna 'null'
    if (count($_AAux)) {
        foreach ($_AAux as $indice => $valor) {
            if ($valor == "") {
                $_AAux[$indice] = 'null';
            }
        }
    }

    return $_AAux;
}

function verEstructura($e)
{
    echo "<pre>";
    print_r($e);
    echo "</pre>";
}


// autoload para version 8.0
spl_autoload_register(
    function ($class_name) {
        $tps = array(
            $GLOBALS['ROOT'] . '1/',
            $GLOBALS['ROOT'] . '2/',
            $GLOBALS['ROOT'] . '3/',
            $GLOBALS['ROOT'] . '4/'

        );
        $directorys = array(
            'modelo/',
            'modelo/conector/',
            'control/',
            'utiles/',
            'test/',
        );
        //print_object($directorys) ;
        foreach ($tps as $tp) {
            foreach ($directorys as $directory) {
                if (file_exists($tp . $directory . $class_name . '.php')) {
                    //  echo "se incluyo".$directory.$class_name . '.php';
                    require_once($tp . $directory . $class_name . '.php');
                    return;
                }
            }
        }
    }
);
