<?php
class BaseDatos extends PDO
{
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
    private $debug;
    private $conec;
    private $indice;
    private $resultado;
    private $error;
    private $sql;

    public function __construct()
    {
        $this->engine = 'mysql';
        $this->host = 'localhost';
        $this->database = 'investigacion';
        $this->user = 'root';
        $this->pass = '';
        $this->debug = true;
        $this->error = "";
        $this->sql = "";
        $this->indice = 0;

        $dns = $this->engine . ':dbname=' . $this->database . ";host=" . $this->host;
        try {
            parent::__construct($dns, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->conec = true;
        } catch (PDOException $e) {
            $this->setError($e->getMessage());
            $this->conec = false;
        }
    }

    public function Iniciar()
    {
        return $this->getConec();
    }

    public function getConec()
    {
        return $this->conec;
    }

    public function setError($e)
    {
        $this->error = $e;
    }

    public function getError()
    {
        return "\n" . $this->error;
    }

    public function Ejecutar($sql)
    {
        $this->setError("");
        $this->sql = $sql;
        if (stristr($sql, "insert")) {
            return $this->EjecutarInsert($sql);
        }
        if (stristr($sql, "update") or stristr($sql, "delete")) {
            return $this->EjecutarDeleteUpdate($sql);
        }
        if (stristr($sql, "select")) {
            return $this->EjecutarSelect($sql);
        }
    }

    private function EjecutarInsert($sql)
    {
        $resultado = parent::query($sql);
        if (!$resultado) {
            return -1; // Devuelve -1 en caso de error
        } else {
            return $this->lastInsertId();
        }
    }

    private function EjecutarDeleteUpdate($sql)
    {
        $resultado = parent::query($sql);
        if (!$resultado) {
            return -1; // Devuelve -1 en caso de error
        } else {
            return $resultado->rowCount();
        }
    }

    private function EjecutarSelect($sql)
    {
        $resultado = parent::query($sql);
        if (!$resultado) {
            return -1; // Devuelve -1 en caso de error
        } else {
            $this->resultado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $this->indice = 0;
            return count($this->resultado);
        }
    }

    public function Registro()
    {
        if ($this->indice >= 0) {
            if ($this->indice < count($this->resultado)) {
                return $this->resultado[$this->indice++];
            }
        }
        return false;
    }
}
?>


