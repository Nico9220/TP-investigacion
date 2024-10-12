<?php
class Articulo
{
    private $id;
    private $titulo;
    private $sinopsis;

    public function __construct($id, $titulo, $sinopsis)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->sinopsis = $sinopsis;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getSinopsis()
    {
        return $this->sinopsis;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setSinopsis($sinopsis)
    {
        $this->sinopsis = $sinopsis;
    }
}
?>

