<?php
SESSION_START();
    require_once "../modelo/Usuario.php";
    require_once "../modelo/Conexion.php";
    require_once "../modelo/RepositorioUsuarios.php";
    require_once "../plantillas/Cabecera.php";
    require_once "../plantillas/Pie.php";
	
	 if(isset($_SESSION["usuario"])) {
		$usuario=unserialize($_SESSION["usuario"]);
		if($usuario->privilegios!="Administrador"){
        header("Status:301 Moved Permanently");
        header("Location:../index.php");
        exit;
		}
    }

    //Creo el objeto Conexion y lo conecto a la BD
    $conexion=new Conexion();
    //Creo el objeto con el que voy a guardar/leer/borrar datos de la tabla de Entradas
    $repositorioUsuarios=new RepositorioUsuarios($conexion->getConexion());
    //Creo una cabecera y un pie de página
    $cabecera=new Cabecera("CRUD de usuarios");
    $pie=new Pie("");   
    

    $cabecera->mostrarConMenuCRUD();
    echo "<h1>CRUD Usuarios</h1>";
    echo "<a href='altas.php' class='btn btn-primary'>Nuevo usuario</a>";
    echo "<table class='table'><thead>";
    echo "<th>id</th><th>Nombre</th><th>Correo</th><th>Privilegios</th><th>Contraseña</th><th>Acciones</th>";
    echo "</thead>";
    echo "<tbody>";
    //Ahora leo las entradas de la BBDD y las muestro
    $listaUsuarios=$repositorioUsuarios->listarTodosLosUsuarios();
    for($i=0; $i<count($listaUsuarios); $i++){
        $id=$listaUsuarios[$i]->id;
        echo "<tr>";
        $listaUsuarios[$i]->mostrarCrud();        
        echo "<td><a href='editar.php?id=$id'>Editar</a></td>";
		echo "<td><a href='borrar.php?id=$id'onclick='return confirm(\"Seguro?\")'>Borrar</a></td>";
        echo "</tr>";
    }
    echo "</tbody>";    
    $pie->mostrar();    



?>