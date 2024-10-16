<?php
class Pagina
{
    private $id;
    private $titulo;
    private $contenido;

    public function __construct($id, $titulo, $contenido)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->contenido = $contenido;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getContenido()
    {
        return $this->contenido;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
    }
}
?>

