<?php 
function data_submitted() {
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
        
function verEstructura($e){
    echo "<pre>";
    print_r($e);
    echo "</pre>"; 
}

/*
function __autoload($class_name){
    //echo "class ".$class_name ;
    $directorys = array(
        $_SESSION['ROOT'].'Modelo/',
        $_SESSION['ROOT'].'Modelo/conector/',
        $_SESSION['ROOT'].'Control/',
      //  $GLOBALS['ROOT'].'util/class/',
    );
    //print_object($directorys) ;
    foreach($directorys as $directory){
        if(file_exists($directory.$class_name . '.php')){
            // echo "se incluyo".$directory.$class_name . '.php';
            require_once($directory.$class_name . '.php');
            return;
        }
    }
}*/


// autoload para version 8.0
spl_autoload_register(function($class_name) {
    $directorys = array(
        $_SESSION['ROOT'].'Modelo/',
        $_SESSION['ROOT'].'Modelo/conector/',
        $_SESSION['ROOT'].'control/',
      //  $GLOBALS['ROOT'].'util/class/',
    );
    //print_object($directorys) ;
    foreach($directorys as $directory){
        if(file_exists($directory.$class_name . '.php')){
            //  echo "se incluyo".$directory.$class_name . '.php';
            require_once($directory.$class_name . '.php');
            return;
        }
    }
}
)
?>