<?php

    require_once "clases/AccesoDatos.php";
    require_once "clases/Usuario.php";

    if(isset($_POST["usuario"]) && isset($_POST["clave"]))
    {
        $objeto = new stdClass();
        $objeto->usuario = $_POST["usuario"];
        $objeto->clave = $_POST["clave"];

        $usuario = Usuario::TraerUsuarioLogueado($objeto);

        if($usuario !== false)
        {
            session_start();

            $_SESSION["Usuario"] = json_encode($usuario);

            echo "OK";
        }
        else
        {
            echo "ERROR";
        }
    }
    else
    {
        header("location:index.php");
    }

?>