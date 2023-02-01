<?php
    require_once "../modelo/Entrada.php";
    require_once "../modelo/Conexion.php";
    require_once "../modelo/Repositorioentradas.php";
    require_once "../plantillas/Cabecera.php";
    require_once "../plantillas/Pie.php";
    
    $cabecera=new Cabecera("Alta de entradas");
    $pie=new Pie("");   
    
    if(isset($_POST["titulo"])){
        $nombreFichero = date("Y-m-d-H-i-s")."-".$_FILES['imagen']['name'];
        //Leo la ubicación temporal del archivo para después dejarlo en la carpeta deseada
        $file_loc = $_FILES['imagen']['tmp_name'];        
        //movemos el archivo a la carpeta deseada
        move_uploaded_file($file_loc,"../img/".$nombreFichero);

        $conexion=new Conexion();
        $repositorioEntradas=new RepositorioEntradas($conexion->getConexion());
        $entrada=new Entrada();
        $entrada->titulo=$_POST["titulo"];
        $entrada->contenido=$_POST["contenido"];
        $entrada->fecha=$_POST["fecha"];
        $entrada->imagen=$nombreFichero; //En imagen se guarda el nombre del fichero de imagen
        $repositorioEntradas->insertarEntrada($entrada);
        echo "<p class='alert alert-success'>Registro de la entrada -" . $entrada->titulo . "- añadido</p>";
    }

    $cabecera->mostrarConMenuCRUD();
    echo "<h1>Altas entradas</h1>";
?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Escribe el título">            
        </div>
        <div class="form-outline">
            <label class="form-label" for="textAreaExample">Contenido</label>
            <textarea class="form-control" name="contenido" id="textAreaExample1" rows="4"></textarea>          
        </div>
        <div class="form-group">
            <label class="form-label" for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha">
        </div>
        <div class="form-group">
            <label for="imagen">Título</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">            
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

<?php
    $pie->mostrar();    
?>