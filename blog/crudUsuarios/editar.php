<?php
    require_once "../modelo/Usuario.php";
    require_once "../modelo/Conexion.php";
    require_once "../modelo/RepositorioUsuarios.php";
    require_once "../plantillas/Cabecera.php";
    require_once "../plantillas/Pie.php";
    
    $cabecera=new Cabecera("Editar usuario");    
    $pie=new Pie("");   
    
    $conexion=new Conexion();
    $repositorioUsuarios=new RepositorioUsuarios($conexion->getConexion());

    if(isset($_POST["nombre"])){        
        $usuario=new Usuario();
        $usuario->id=$_GET["id"];
        $usuario->nombre=$_POST["nombre"];
        $usuario->corrreo=$_POST["correo"];
        $usuario->privilegios=$_POST["privilegios"];
		$usuario->password=$_POST["password"];
        
        /*if(isset($_FILES['imagen']['name']) && $_FILES['imagen']['name']!=""){  //Si nos pasan un nuevo fichero
            $nombreFichero = date("Y-m-d-H-i-s")."-".$_FILES['imagen']['name'];            
            $file_loc = $_FILES['imagen']['tmp_name'];                    
            move_uploaded_file($file_loc,"../img/".$nombreFichero);
            $entrada->imagen=$nombreFichero;
        }else{ //Si no modifican la imagen, mantenemos la anterior que estaba en un campo oculto del formulario
            $entrada->imagen=$_POST["imagenAnterior"];
        }*/

        $repositorioUsuarios->editarUsuario($usuario);
        
        header("Status: 301 Moved Permanently");
        header("Location: crud.php");
        exit;
    }

    if(isset($_GET["id"])){        
        $id=$_GET["id"];
        $usuario=$repositorioUsuarios->getUsuario($id);
        $id=$usuario->id;
        $nombre=$usuario->nombre;
        $correo=$usuario->correo;
        $privilegios=$usuario->privilegios;
        $password=$usuario->password;
    }

    $cabecera->mostrarConMenuCRUD();
    echo "<h1>Editar usuario</h1>";

    echo '<form action="" method="POST">';
    echo '<div class="form-group">';
    echo '<label for="id">Id</label>';
    echo "<input type='text' value='$id' class='form-control' id='id' name='id' disabled>";
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="nombre">Nombre</label>';
    echo "<input type='text' value='$nombre' class='form-control' id='nombre' name='nombre' placeholder='Escribe el nombre'>";
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="correo">Correo electronico</label>';
    echo "<input type='email' value='$correo' class='form-control' id='correo' name='correo' placeholder='Escribe el correo electronico'>";
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="privilegios">Privilegios</label>';
    echo '<select name="privilegios" id="privilegios">';
		if($privilegios=="Administrador"){
			$esAdministrador="selected";
			$esPlebeyo="";
		}else{
			$esAdministrador="";
			$esPlebeyo="selected";
		}
	echo '<option value="Administrador" $esAdministrador>Administrador</option>';
	echo '<option value="Plebeyo" $esPlebeyo>Plebeyo</option>';
	echo '</select>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="password">Contraseña</label>';
    echo "<input type='text' value='$password' class='form-control' id='password' name='password' placeholder='Escribe la contraseña'>";
    echo '</div>';
	
    echo '<button type="submit" class="btn btn-primary form-control">Enviar</button>';
    echo '</form>';

    echo "<br><a href='crud.php' class='btn btn-primary'>Volver</a>";

    $pie->mostrar();    
?>