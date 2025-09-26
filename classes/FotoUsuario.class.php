<?php
require_once "CRUD.class.php";

class FotoUsuario extends CRUD
{
    protected $table = "foto_usuario";
    private $id_foto;
    private $nome_foto;
    private $fk_usuario;

    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function getIdFoto()
    {
        return $this->id_foto;
    }

    public function setIdFoto($id)
    {
        $this->id_foto = $id;
    }

    public function getNomeFoto()
    {
        return $this->nome_foto;
    }

    public function setNomeFoto($nome)
    {
        $this->nome_foto = $nome;
    }

    public function getFkUsuario()
    {
        return $this->fk_usuario;
    }

    public function setFkUsuario($fk)
    {
        $this->fk_usuario = $fk;
    }
}
