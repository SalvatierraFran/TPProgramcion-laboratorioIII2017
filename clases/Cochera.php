<?php

require_once "AccesoDatos.php";

class Cochera
{
    //Atributos
    private $_numero;
    private $_piso;
    private $_discapacitado;

    //Propiedades
    public function getNumero()
    {
        return $this->_numero;
    }

    public function getPiso()
    {
        return $this->_piso;
    }

    public function getDiscapacitado()
    {
        return $this->_discapacitado;
    }

    public function setNumero($valor)
    {
        $this->_numero = $valor;
    }

    public function setPiso($valor)
    {
        $this->_piso = $valor;
    }

    public function setDiscapacitado($valor)
    {
        $this->_discapacitado = $valor;
    }

    //toString
    public function toString()
    {
        return $this->_numero." - ".$this->_piso." - ".$this->_discapacitado."\r\n";
    }

    //Métodos para la BD
    public static function GuardarCocheraBD($obj)
    {
        try
        {
            $objAcceso = AccesoDatos::DameUnObjetoAcceso();
            $objConsulta = $objAcceso->RetornarConsulta("INSER INTO cochera (numero, piso, discapacitado) VALUES (:num, :piso, :disc)");

            $objConsulta->bindValue(':num', $obj->getNumero(), PDO::PARAM_INT);
            $objConsulta->bindValue(':piso', $obj->getPiso(), PDO::PARAM_INT);
            $objConsulta->bindValue(':disc', $obj->getDiscapacitado(), PDO::PARAM_STR);

            $objConsulta->execute();
        }catch(Exception $e){
            return FALSE;
        }
        return TRUE;
    }
}


?>