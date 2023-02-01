<?php
    require_once "../modelo/Entrada.php";
    require_once "../modelo/Conexion.php";
    require_once "../modelo/Repositorioentradas.php";
    require_once "../plantillas/Cabecera.php";
    require_once "../plantillas/Pie.php";
    
    $cabecera=new Cabecera("Editar entrada");    
    $pie=new Pie("");   
    
    $conexion=new Conexion();
    $repositorioEntradas=new RepositorioEntradas($conexion->getConexion());

    if(isset($_POST["titulo"])){        
        $entrada=new Entrada();
        $entrada->id=$_GET["id"];
        $entrada->titulo=$_POST["titulo"];
        $entrada->contenido=$_POST["contenido"];
        $entrada->fecha=$_POST["fecha"];
        
        if(isset($_FILES['imagen']['name']) && $_FILES['imagen']['name']!=""){  //Si nos pasan un nuevo fichero
            $nombreFichero = date("Y-m-d-H-i-s")."-".$_FILES['imagen']['name'];            
            $file_loc = $_FILES['imagen']['tmp_name'];                    
            move_uploaded_file($file_loc,"../img/".$nombreFichero);
            $entrada->imagen=$nombreFichero;
        }else{ //Si no modifican la imagen, mantenemos la anterior que estaba en un campo oculto del formulario
            $entrada->imagen=$_POST["imagenAnterior"];
        }

        $repositorioEntradas->editarEntrada($entrada);
        
        header("Status: 301 Moved Permanently");
        header("Location: crud.php");
        exit;
    }

    if(isset($_GET["id"])){        
        $id=$_GET["id"];
        $entrada=$repositorioEntradas->getEntrada($id);
        $id=$entrada->id;
        $titulo=$entrada->titulo;
        $contenido=$entrada->contenido;
        $fecha=$entrada->fecha;
        $imagen=$entrada->imagen;
    }

    $cabecera->mostrarConMenuCRUD();
    echo "<h1>Editar entradas</h1>";

    echo '<form action="" method="POST" enctype="multipart/form-data">';
    echo '<div class="form-group">';
    echo '<label for="id">Id</label>';
    echo "<input type='text' value='$id' class='form-control' id='id' name='id' disabled>";
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="titulo">Título</label>';
    echo "<input type='text' value='$titulo' class='form-control' id='titulo' name='titulo' placeholder='Escribe el título'>";
    echo '</div>';
    echo '<div class="form-outline">';
    echo '<label class="form-label" for="textAreaExample">Contenido</label>';
    echo "<textarea class='form-control' name='contenido' id='textAreaExample1' rows='8'>$contenido</textarea>";
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label class="form-label" for="fecha">Fecha</label>';
    echo "<input class='form-control' type='date' id='fecha' name='fecha' value='$fecha'>";
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="imagen">Imagen</label>';
    echo "<input type='file' class='form-control' id='imagen' name='imagen' accept='image/*'>";
    echo '</div>';
    if($imagen!=""){
        echo "<br><img src='../img/$imagen' style='width: 100px'><br>";
        echo "<input type='hidden' value='$imagen' name='imagenAnterior'>";
    }
    echo '<button type="submit" class="btn btn-primary form-control">Enviar</button>';
    echo '</form>';

    echo "<br><a href='crud.php' class='btn btn-primary'>Volver</a>";

    $pie->mostrar();    
?>