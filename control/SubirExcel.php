<?php

class SubirExcel
{
    /**
     * Controla si el archivo subido es de tipo texto (.xls, .xlsx),
     * retorna entero indicando true o false
     * @param string $archivoCargado
     * @return boolean
     */
    function controlarFormato($archivoCargado)
    {
        $archivoCargado = strtolower($archivoCargado['archivo']['name']);

        $pudo = true;

        //Busco en el nombre si aparece extensión .pdf o .doc
        $formato1 = '.xlsx';
        $formato2 = '.xls';
        $esFor1 = strpos($archivoCargado, $formato1);
        $esFor2 = strpos($archivoCargado, $formato2);

        //Controlar formatos
        if ($esFor1 === false && $esFor2 === false) {
            $pudo = false;
        }

        return $pudo;
    }

    /**
     * Controla que el archivo subido no pese más de 2mb, array con booleano y un número
     * @param array $archivoCargado
     * @return boolean
     */
    public function controlarPesoArchivo($archivoCargado)
    {
        $pudo = true;

        //Chequear tamaño - 2mb son 2.000.000 de bytes
        if ($archivoCargado['archivo']["size"] > 2000000) {
            $pudo = false;
        }
        return $pudo;
    }

    /**
     * Se encarga de subir el archivo al directorio temporal en caso de ser exitosa la carga, y notifica.
     * En caso de fallar, retornará un mensaje indicando el motivo.
     * @param array $archivoCargado
     * @return array
     */
    public function subir($archivoCargado)
    {
        $formato = $this->controlarFormato($archivoCargado);
        //$pesoArchivo = $this->controlarPesoArchivo($archivoCargado);

        if ($formato) {
                if (copy($archivoCargado['archivo']['tmp_name'], ROOT_PATH . '/uploads/' . $archivoCargado['archivo']['name'])) {
                    $mensaje = "El archivo se ha subido con éxito. ";
                    $pudo = "si";
                } else {
                    $mensaje = "El archivo no se ha subido. ";
                    $pudo = "no";
                }
        } else {
            $mensaje = "Error, el archivo debe ser .pdf o .doc.";
            $pudo = "no";
        }

        $salida = ['pudo' => $pudo, 'mensaje' => $mensaje];
        return $salida;
    }
}