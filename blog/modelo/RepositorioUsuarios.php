<?php
    class RepositorioUsuarios {
        public $conexion;

        public function __construct($conexion){
            $this->conexion=$conexion;
            
            $consulta="CREATE TABLE IF NOT EXISTS usuarios (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(255) NOT NULL,
                correo VARCHAR(255) NOT NULL UNIQUE,
				privilegios VARCHAR(255) NOT NULL,
				password VARCHAR(255) NOT NULL
            );";
            $conexion->query($consulta);
        }

        public function listarTodosLosUsuarios(){
            $usuarios=[];
            $consulta="SELECT * FROM usuarios";
            $resultado=$this->conexion->query($consulta);    
            while($elemento=$resultado->fetch_object()){            
                $aux=new Usuario();
                $aux->setPropiedades($elemento->id, $elemento->nombre, $elemento->correo, $elemento->privilegios, $elemento->password);
                $usuarios[]=$aux;
            }

            return $usuarios;
        }

        public function getUsuario($id){            
            $consulta="SELECT * FROM usuarios where id=$id";
            $resultado=$this->conexion->query($consulta);    
            if($elemento=$resultado->fetch_object()){            
                $aux=new Usuario();
                $aux->setPropiedades($elemento->id, $elemento->nombre, $elemento->correo, $elemento->privilegios, $elemento->password);
            }
            return $aux;
        }

        public function insertarUsuario($usuario){
            $sentencia = $this->conexion->prepare("INSERT INTO usuarios (nombre, correo, privilegios, password) VALUES (?, ?, ?, ?)");
            
            $sentencia->bind_param('ssss', $nombre, $correo, $privilegios, $password);

            $nombre = $usuario->nombre;
            $correo = $usuario->correo;
            $privilegios = $usuario->privilegios;
			$password = $usuario->password;

            // insertar una fila            
            $sentencia->execute();
        }

        public function editarUsuario($usuario){
            $sentencia=$this->conexion->prepare("UPDATE usuarios SET nombre=?, correo=?, privilegios=?, password=? WHERE id=?");

            $sentencia->bind_param('ssssi', $nombre, $correo, $privilegios, $password, $id);

           $nombre = $usuario->nombre;
            $correo = $usuario->correo;
            $privilegios = $usuario->privilegios;
			$password=$usuario->password;
            $id=$usuario->id;

            $sentencia->execute();
        }
        public function borrarUsuario($idUsuario){
            $sentencia=$this->conexion->prepare("DELETE FROM usuarios  WHERE id=?");

            $sentencia->bind_param('i', $id);
            $id=$idUsuario;

            $sentencia->execute();
        }
		
		 public function existeUsuario($Paramcorreo, $Parampassword){
            $sentencia = $this->conexion->prepare("SELECT * FROM usuarios WHERE correo=? AND password=?");            
            $sentencia->bind_param('ss', $correo, $password);

            $correo = $Paramcorreo;
            $password = $Parampassword;
            $sentencia->execute();
            $resultado=$sentencia->get_result();
            if($elemento=$resultado->fetch_object()){
                $usuario=new Usuario();                
                $usuario->setPropiedades($elemento->id, $elemento->nombre, $elemento->correo, $elemento->privilegios, $elemento->password);
                $aux=$usuario;
            }else{
                $aux=false;
            }
            return $aux;
        }
		
    }   
?>