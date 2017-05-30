<?php

require_once "clases/AccesoDatos.php";
require_once "clases/Usuario.php";
require_once "clases/Auto.php";
require_once "clases/Cochera.php";

$queMuestro = isset($_POST['queMuestro']) ? $_POST['queMuestro'] : NULL;

switch($queMuestro){

    case "2":
        
        session_start();

        if(isset($_SESSION["Usuario"]))
        {
            session_unset();
            echo "OK";
        }else{
            echo "No OK";
        }
        break;

    default:
        echo ":(";
}


?>