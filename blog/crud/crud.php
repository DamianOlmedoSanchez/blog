<?php
    require_once "../modelo/Entrada.php";
    require_once "../modelo/Conexion.php";
    require_once "../modelo/Repositorioentradas.php";
    require_once "../plantillas/Cabecera.php";
    require_once "../plantillas/Pie.php";

    //Creo el objeto Conexion y lo conecto a la BD
    $conexion=new Conexion();
    //Creo el objeto con el que voy a guardar/leer/borrar datos de la tabla de Entradas
    $repositorioEntradas=new RepositorioEntradas($conexion->getConexion());
    //Creo una cabecera y un pie de página
    $cabecera=new Cabecera("CRUD de entradas");
    $pie=new Pie("");   
    

    $cabecera->mostrarConMenuCRUD();
    echo "<h1>CRUD entradas</h1>";
    echo "<a href='altas.php' class='btn btn-primary'>Nueva entrada</a>";
    echo "<table class='table'><thead>";
    echo "<th>id</th><th>Título</th><th>Contenido</th><th>Fecha</th><th>Imagen</th><th>Acciones</th>";
    echo "</thead>";
    echo "<tbody>";
    //Ahora leo las entradas de la BBDD y las muestro
    $listaEntradas=$repositorioEntradas->listarTodasLasEntradas();
    for($i=0; $i<count($listaEntradas); $i++){
        $id=$listaEntradas[$i]->id;
        echo "<tr>";
        $listaEntradas[$i]->mostrarCrud();        
        echo "<td><a href='editar.php?id=$id'>Editar</a></td>";
        echo "<td><a href='borrar.php?id=$id'onclick='return confirm(\"Seguro?\")'>Borrar</a></td>";
        echo "</tr>";
    }
    echo "</tbody>";    
    $pie->mostrar();    



?>