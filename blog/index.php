<?php 
	
	
    require_once "modelo/Entrada.php";
    require_once "modelo/Conexion.php";
    require_once "modelo/Repositorioentradas.php";
    require_once "plantillas/Cabecera.php";
    require_once "plantillas/Pie.php";
	
	

    //Creo el objeto Conexion y lo conecto a la BD
    $conexion=new Conexion();
    //Creo el objeto con el que voy a guardar/leer/borrar datos de la tabla de Entradas
    $repositorioEntradas=new RepositorioEntradas($conexion->getConexion());


    //Creo una cabecera y un pie de página
    $cabecera=new Cabecera("Página principal");
    $pie=new Pie("");   
    
    //Primero muestro la cabecera de la página
    $cabecera->mostrarConMenu();

    echo "<h1>Lista de entradas</h1>";
    //Ahora leo las entradas de la BBDD y las muestro
    $listaEntradas=$repositorioEntradas->listarTodasLasEntradas();
    for($i=0; $i<count($listaEntradas); $i++){
        $listaEntradas[$i]->mostrarMini();
    }

    //Por último muestro el pie de página
    $pie->mostrar();    

?>