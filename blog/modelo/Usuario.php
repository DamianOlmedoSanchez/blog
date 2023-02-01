<?php
class Usuario {
        
        public $id;
        public $nombre;
        public $correo;
        public $privilegios;
		public $password;
      

        //Métodos
        public function __construct(){            
        }    

        

        public function setPropiedades($id, $nombre, $correo, $privilegios, $password){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->correo = $correo;
            $this->privilegios=$privilegios;
			$this->password=$password;
        }    

        public function mostrar(){
            echo "<h1>" . $this->nombre . "</h1>";
            echo "<p>" . $this->correo . "</p>";
            echo "<p>" . $this->privilegios . "</p>";
			echo "<p>" . $this->password . "</p>";
        }

       /* public function mostrarMini(){
            $id=$this->id;
			
			if($id%2==0){
			echo "<div Style='height:200px;display:flex;justify-content:start; flex-direction: row-reverse;'>";
			echo "<div>";
			echo "<h2 Style='justify-content: flex-end;'><a href='detalle.php?id=$id'>" . $this->titulo . "</a></h2>";	
			echo "<p>" . substr($this->contenido, 0, 50) . "</p>";
			echo "</div>";
			echo "<div Style='margin-right:5%;'>";
            echo "<p>" .$this->imgIndex() ."</p>";
			echo "</div>";
			echo "</div>";
			}
			if($id%2!=0){
			echo "<div Style='height:200px;display:flex; flex-direction: row;'>";
			echo "<div>";
			echo "<h2 '><a href='detalle.php?id=$id'>" . $this->titulo . "</a></h2>";	
			echo "<p>" . substr($this->contenido, 0, 50) . "</p>";
			echo "</div>";
			echo "<div Style='margin-left:5%;'>";
            echo "<p >" .$this->imgIndex() ."</p>";
			echo "</div>";
			echo "</div>";
			}
			
        }*/

        public function mostrarCrud(){
            echo "<td>" . $this->id . "</td>";
            echo "<td>" . $this->nombre . "</td>";            
            echo "<td>" . $this->correo . "</td>";
            echo "<td>" . $this->privilegios . "</td>";
			echo "<td>" . $this->password . "</td>";
        }

    }
?>