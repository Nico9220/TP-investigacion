<?php
class Persona{
    private $perNombre;
    private $perDNI;
    private $perFechaNac;
    private $mensajeoperacion;

    public function __construct(){
        $this->perNombre = '';
        $this->perDNI = 0;
        $this->perFechaNac = '';
    }

    public function carga($perNombre,$perDNI,$perFechaNac){
        $this->perNombre = $perNombre;
        $this->perDNI = $perDNI;
        $this->perFechaNac = $perFechaNac;
    }

    public function setPerNombre($perNombre){
        $this->perNombre = $perNombre;
    }

    public function getPerNombre(){
        return $this->perNombre;
    }

    public function setPerDNI($perDNI){
        $this->perDNI = $perDNI;
    }

    public function getPerDNI(){
        return $this->perDNI;
    }

    public function setPerFechaNac($perFechaNac){
        $this->perFechaNac = $perFechaNac;
    }

    public function getPerFechaNac(){
        return $this->perFechaNac;
    }

    public function setmensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function getmensajeoperacion($mensajeoperacion){
        return $this->mensajeoperacion;
    }
    
    // MÉTODOS PROPIOS DE LA CLASE

    /**
     * Toma el atributo donde está cargado el id del objeto y lo utiliza para realizar
     * una consulta a la base de datos con el objetivo de actualizar el resto de los atributos del objeto.
     * Retora un booleano que indica el éxito o falla de la operación
     * @return boolean
     */
    public function cargar()
    {
        $exito = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM persona WHERE PerDNI = " . $this->getPerDNI();

        //Verifica si está activa la base de datos
        if ($base->Iniciar()) {

            //Ejercuta la consulta (en este caso es un SELECT, debe devolver un arreglo de registros)
            $res = $base->Ejecutar($sql);

            //Si $res es mayor a -1 quiere decir que la consulta se ejecutó con éxito
            if ($res > -1) {

                //Si $res es mayor a 0 quiere decir que la consulta generó al menos 1 registro
                if ($res > 0) {

                    /*Guardo en el arreglo $row el resultado del primer registro obtenido y seteo
                    esos valores al objeto Persona actual*/
                    $row = $base->Registro();

                    $this->carga(
                        $row['PerNombre'],
                        $row['PerDNI'],
                        $row['PerFechaNac'],
                    );

                    $exito = true;
                }
            }
        } else {
            $this->setmensajeoperacion("Persona->cargar: " . $base->getError());
        }
        return $exito;
    }

     /**
     * Lee los valores actuales de los atributos del objeto e inserta un nuevo
     * registro en la base de datos a partir de ellos.
     * Retorna un booleano que indica si le operación tuvo éxito
     * @return boolean
     */
    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "INSERT INTO persona(PerDNI, PerNombre, PerFechaNac) VALUES(
            '" . $this->getPerDNI() . "', 
            '" . $this->getPerNombre() . "', 
            '" . $this->getPerFechaNac() . "'
            );";

        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                //Este objeto no tiene id con autoincrement
                // $this->setNroDni($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Persona->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Persona->insertar: " . $base->getError());
        }
        return $resp;
    }

    /**
     * Lee los valores actuales de los atributos del objeto y los actualiza en la
     * base de datos.
     * Retorna un booleano que indica si le operación tuvo éxito
     * @return boolean
     */
    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "UPDATE persona SET 
        PerDNI = '" . $this->getPerDNI() . "', 
        PerNombre = '" . $this->getPerNombre() . "', 
        PerFechaNac = '" . $this->getPerFechaNac() ."'";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Persona->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Persona->modificar: " . $base->getError());
        }
        return $resp;
    }

    /**
     * Lee el id actual del objeto y si puede lo borra de la base de datos
     * Retorna un booleano que indica si le operación tuvo éxito
     * @return boolean
     */
    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "DELETE FROM persona WHERE PerDNI = '" . $this->getPerDNI() . "'";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Persona->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Persona->eliminar: " . $base->getError());
        }
        return $resp;
    }

     /**
     * Recibe condiciones de busqueda en forma de consulta sql para obtener
     * los registros requeridos.
     * Si por parámetro se envía el valor "" se devolveran todos los registros de la tabla
     * 
     * La función devuelve un arreglo compuesto por todos los objetos que cumplen la condición indicada
     * por parámetro
     * @return array
     */
    public static function listar($parametro)
    {
        $arreglo = array();
        $base = new BaseDatos();

        $sql = "SELECT * FROM persona ";

        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }

        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {

                    $obj = new Persona();
                    $obj->carga(
                        $row['PerNombre'],
                        $row['PerDNI'],
                        $row['PerFechaNac']
                    );
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("Persona->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
?>