<?php
class Entrada {
        
        public $id;
        public $titulo;
        public $fecha;
        public $contenido;
        public $imagen;

        //Métodos
        public function __construct(){            
        }    

        public function img(){
            return "<img src='../img/" . $this->imagen . "' Style='height:100px;'>";
        }
		public function imgIndex(){
            return "<img src='img/" . $this->imagen . "' Style='height:100px;'>";
        }

        public function setPropiedades($id, $titulo, $contenido, $fecha, $imagen){
            $this->id = $id;
            $this->titulo = $titulo;
            $this->contenido = $contenido;
            $this->fecha=$fecha;
            $this->imagen=$imagen;
        }    

        public function mostrar(){
            echo "<h1>" . $this->titulo . "</h1>";
            echo "<img src='img/" . $this->imagen . "' class='img-fluid'>";
            echo "<h5>" . $this->fecha . "</h5>";
            echo "<p>" . $this->contenido . "</p>";
        }

        public function mostrarMini(){
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
			
        }

        public function mostrarCrud(){
            echo "<td>" . $this->id . "</td>";
            echo "<td>" . $this->titulo . "</td>";            
            echo "<td>" . substr($this->contenido, 0, 20) . "</td>";
            echo "<td>" . $this->fecha . "</td>";
            echo "<td>" . $this->img() . "</td>";
        }

    }
?>