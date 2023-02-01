<?php
    class RepositorioEntradas {
        public $conexion;

        public function __construct($conexion){
            $this->conexion=$conexion;
            
            $consulta="CREATE TABLE IF NOT EXISTS entradas (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                titulo VARCHAR(255) NOT NULL,
                contenido TEXT,
                fecha DATE,
                imagen VARCHAR(255) NOT NULL
            );";
            $conexion->query($consulta);
        }

        public function listarTodasLasEntradas(){
            $entradas=[];
            $consulta="SELECT * FROM entradas";
            $resultado=$this->conexion->query($consulta);    
            while($elemento=$resultado->fetch_object()){            
                $aux=new Entrada();
                $aux->setPropiedades($elemento->id, $elemento->titulo, $elemento->contenido, $elemento->fecha, $elemento->imagen);
                $entradas[]=$aux;
            }

            return $entradas;
        }

        public function getEntrada($id){            
            $consulta="SELECT * FROM entradas where id=$id";
            $resultado=$this->conexion->query($consulta);    
            if($elemento=$resultado->fetch_object()){            
                $aux=new Entrada();
                $aux->setPropiedades($elemento->id, $elemento->titulo, $elemento->contenido, $elemento->fecha, $elemento->imagen);
            }
            return $aux;
        }

        public function insertarEntrada($entrada){
            $sentencia = $this->conexion->prepare("INSERT INTO entradas (titulo, contenido, fecha, imagen) VALUES (?, ?, ?, ?)");
            
            $sentencia->bind_param('ssss', $titulo, $contenido, $fecha, $imagen);

            $titulo = $entrada->titulo;
            $contenido = $entrada->contenido;
            $fecha = $entrada->fecha;
            $imagen = $entrada->imagen;

            // insertar una fila            
            $sentencia->execute();
        }

        public function editarEntrada($entrada){
            $sentencia=$this->conexion->prepare("UPDATE entradas SET titulo=?, contenido=?, fecha=?, imagen=? WHERE id=?");

            $sentencia->bind_param('ssssi', $titulo, $contenido, $fecha, $imagen, $id);

            $titulo = $entrada->titulo;
            $contenido = $entrada->contenido;
            $fecha = $entrada->fecha;
            $imagen = $entrada->imagen;
            $id=$entrada->id;

            $sentencia->execute();
        }
        public function borrarEntrada($idEntrada){
            $sentencia=$this->conexion->prepare("DELETE FROM entradas  WHERE id=?");

            $sentencia->bind_param('i', $id);
            $id=$idEntrada;

            $sentencia->execute();
        }


    }   
?>