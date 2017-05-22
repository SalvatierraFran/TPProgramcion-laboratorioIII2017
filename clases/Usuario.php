<?php

require_once "AccesoDatos.php";

class Usuario
{
    //Atributos
    private $_id;
    private $_usuario;
    private $_clave;
    private $_turno;
    private $_tipo;
    private $_habilitar;

    //Propiedades
    public function getID()
    {
        return $this->_id;
    }

    public function getUsuario()
    {
        return $this->_usuario;
    }

    public function getClave()
    {
        return $this->_clave;
    }

    public function getTurno()
    {
        return $this->_turno;
    }

    public function getTipo()
    {
        return $this->_tipo;
    }

    public function getHabilitar()
    {
        return $this->_habilitar;
    }

    public function setUsuario($valor)
    {
        $this->_usuario = $valor;
    }

    public function setClave($valor)
    {
        $this->_clave = $valor;
    }

    public function setTurno($valor)
    {
        $this->_clave = $valor;
    }

    public function setTipo($valor)
    {
        $this->_tipo = $valor;
    }

    public function setHabilitar($valor)
    {
        $this->_habilitar = $valor;
    }

    //Constructor
    public function __struct($Usuario=NULL, $Clave=NULL, $Turno=NULL, $Tipo=NULL, $Habilitar=NULL)
    {
        if($Usuario !== NULL && $Clave !== NULL && $Turno !== NULL && $Tipo !== NULL && $Habilitar !== NULL)
        {
            $this->_usuario = $Usuario;
            $this->_clave = $Clave;
            $this->_turno = $Turno;
            $this->_tipo = $Tipo;
            $this->_habilitar = $Habilitar;
        }
    }

    //ToString
    public function ToString()
    {
        return $this->_usuario." - ".$this->_clave." - ".$this->_turno."\r\n";
    }

    //Funciones a la base de datos
    public static function GuardarBD($obj)
    {
        try
        {
            $objAcceso = AccesoDatos::DameUnObjetoAcceso();
            $objConsulta = $objAcceso->RetornarConsulta("INSERT INTO usuario (usuario, clave, turno, tipo, habilitado) VALUES (:user, :pass, :turno, :tipo, :hab)");

            $objConsulta->binValue(':user', $obj->getUsuario(), PDO::PARAM_STR);
            $objConsulta->bindValue(':pass', $obj->getClave(), PDO::PARAM_STR);
            $objConsulta->bindValue(':turno', $obj->getTurno(), PDO::PARAM_STR);
            $objConsulta->bindValue(':tipo', $obj->getTipo(), PDO::PARAM_STR);
            $objConsulta->bindValue(':hab', $obj->getHabilitar(), PDO::PARAM_STR);

            $objConsulta->execute();
        }catch(Exception $e){
            return FALSE;
        }

        return TRUE;
    }

    public static function TraerTodosLosUsuarios()
    {
        $objAcceso = AccesoDatos::DameUnObjetoAcceso();
        $objConsulta = $objAcceso->RetornarConsulta("SELECT  FROM usuarios");

        $objConsulta->execute();

        $miArray = array();

        while($datos = $objConsulta->fetchObject('usuario'))
        {
            array_push($miArray, $datos);
        }
        return $miArray;
    }

    public static function Eliminar($id)
    {
        try
        {
            $objAcceso = AccesoDatos::DameUnObjetoAcceso();

            $objConsulta = $objAcceso->RetornarConsulta("DELETE FROM usuarios WHERE id = :id");

            $objConsulta->bindValue(':id', $id, PDO::PARAM_INT);

            $objConsulta->execute();
        }catch(Exception $e){
            return FALSE;
        }

        return TRUE;
    }
}
    
?>