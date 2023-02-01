<?php
    require_once "modelo/Entrada.php";
    require_once "modelo/Conexion.php";
    require_once "modelo/Repositorioentradas.php";
    require_once "plantillas/Cabecera.php";
    require_once "plantillas/Pie.php";

    $conexion=new Conexion();
    $repositorioEntradas=new RepositorioEntradas($conexion->getConexion());

    $cabecera=new Cabecera("Detalle artículo"); //Aún no muestro el titulo, después pongo el de la entrada
    $pie=new Pie("");     

    //Ahora recupero la entrada de la BBDD y las muestro
    if(isset($_GET["id"])){
        $id=$_GET["id"];
        $entrada=$repositorioEntradas->getEntrada($id);
        $cabecera->titulo=$entrada->titulo;
        $cabecera->mostrarConMenu();   
        $entrada->mostrar();
    }else{
        $cabecera->mostrarConMenu();
        echo "No ha seleccionado entrada";
    }
    
    $pie->mostrar();
?>