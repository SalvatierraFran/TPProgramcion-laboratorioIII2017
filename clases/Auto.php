<?php

require_once "AccesoDatos.php";

class Auto
{
    //Atributos
    private $_patente;
    private $_marca;
    private $_color;

    //Propiedades
    public function getPatente()
    {
        return $this->_patente;
    }

    public function getMarca()
    {
        return $this->_marca;
    }

    public function getColor()
    {
        return $this->_color;
    }

    public function setPatente($valor)
    {
        $this->_patente = $valor;
    }

    public function setMarca($valor)
    {
        $this->_marca = $valor;
    }

    public function setColor($valor)
    {
        $this->_color = $valor;
    }

    //toString
    public function toString()
    {
        return $this->_patente." - ".$this->_marca." - ".$this->_color."\r\n";
    }

    //Funciones para la BD
    public static function GuardarAutoBD($obj)
    {
        try
        {
            $objAcceso = AccesoDatos::DameUnObjetoAcceso();
            $objConsulta = $objAcceso->RetornarConsulta("INSERT INTO auto (patente, marca, color) VALUES (:patente, :marca, :color)");

            $objConsulta->bindValue(':patente', $obj->getPatente(), PDO::PARAM_STR);
            $objConsulta->bindValue(':marca', $obj->getMarca(), PDO::PARAM_STR);
            $objConsulta->bindValue(':color', $obj->getColor(), PDO::PARAM_STR);

            $objConsulta->execute();
        }catch(Exception $e){
            return FALSE;
        }
        return TRUE;
    }

    public static function TraerTodosLosAutos()
    {
        $objAcceso = AccesoDatos::DameUnObjetoAcceso();
        $objConsulta = $objAcceso->RetornarConsulta("SELECT patente, marca, color FROM auto");
        $objConsulta->execute();

        $miArray = array();

        while($datos = $objConsulta->fetchObject('auto')){
            array_push($miArray, $datos);
        }

        return $miArray;
    }

    public static function Eliminar($id)
    {
        try
        {
            $objAcceso = AccesoDatos::DameUnObjetoAcceso();
            $objConsulta = $objAcceso->RetornarConsulta("DELETE FROM auto WHERE id = :id");

            $objConsulta->bindValue(':id', $id, PDO::PARAM_INT);

            $objConsulta->execute();
        }catch(Exception $e){
            return FALSE;
        }
        return TRUE;
    }
}

?>