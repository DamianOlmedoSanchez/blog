<?php
require_once "../modelo/Usuario.php";
require_once "../modelo/Conexion.php";
require_once "../modelo/RepositorioUsuarios.php";
require_once "../plantillas/Cabecera.php";
require_once "../plantillas/Pie.php";

$cabecera=new Cabecera("Borrar usuario");    
$pie=new Pie("");

$conexion=new Conexion();
    $repositorioUsuarios=new RepositorioUsuarios($conexion->getConexion());
    

    if(isset($_GET["id"])){        
        $id=$_GET["id"];
        $usuario=$repositorioUsuarios->borrarUsuario($id);
    }
    header("Status: 301 Moved Permanently");
    header("Location: crud.php");
    exit;
?>