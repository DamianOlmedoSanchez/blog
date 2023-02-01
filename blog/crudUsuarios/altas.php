<?php
    require_once "../modelo/Usuario.php";
	require_once "../modelo/Conexion.php";
    require_once "../modelo/RepositorioUsuarios.php";
    require_once "../plantillas/Cabecera.php";
    require_once "../plantillas/Pie.php";
    
    $cabecera=new Cabecera("Alta de usuarios");
    $pie=new Pie("");   
    
    if(isset($_POST["nombre"])){
        /*$nombreFichero = date("Y-m-d-H-i-s")."-".$_FILES['imagen']['name'];
        //Leo la ubicación temporal del archivo para después dejarlo en la carpeta deseada
        $file_loc = $_FILES['imagen']['tmp_name'];        
        //movemos el archivo a la carpeta deseada
        move_uploaded_file($file_loc,"../img/".$nombreFichero);*/

        $conexion=new Conexion();
        $repositorioUsuarios=new RepositorioUsuarios($conexion->getConexion());
        $usuario=new Usuario();
        $usuario->nombre=$_POST["nombre"];
        $usuario->correo=$_POST["correo"];
        $usuario->privilegios=$_POST["privilegios"];
        $usuario->password=$_POST["password"];
        $repositorioUsuarios->insertarUsuario($usuario);
        echo "<p class='alert alert-success'>Registro de la entrada -" . $usuario->nombre . "- añadido</p>";
    }

    $cabecera->mostrarConMenuCRUD();
    echo "<h1>Altas usuarios</h1>";
?>
    <form action="" method="POST" ">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe el nombre">            
        </div>
        <div class="form-group">
            <label for="correo">Correo Electonico</label>
            <input type="email" class="form-control" id="correo" name="correo" placeholder="Escribe el correo electronico">            
        </div>
        <div class="form-group">
            <label for="privilegios">Privilegios</label>
            <select name="privilegios">
				<option value="Administrador">Administrador</option>
				<option value="Plebeyo">Plebeyo</option>
			</select>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="Escribe la contraseña">            
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

<?php
    $pie->mostrar(); 
?>
