<?php
require_once "../modelo/Entrada.php";
require_once "../modelo/Conexion.php";
require_once "../modelo/Repositorioentradas.php";
require_once "../plantillas/Cabecera.php";
require_once "../plantillas/Pie.php";

$cabecera=new Cabecera("Borrar entrada");    
$pie=new Pie("");

$conexion=new Conexion();
    $repositorioEntradas=new RepositorioEntradas($conexion->getConexion());
    

    if(isset($_GET["id"])){        
        $id=$_GET["id"];
        $entrada=$repositorioEntradas->borrarEntrada($id);
    }
    header("Status: 301 Moved Permanently");
    header("Location: crud.php");
    exit;
?>