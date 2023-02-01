<?php
    class Pie{
        public $contenido="";

        public function __construct($contenido){
            $this->contenido=$contenido;
        }

        public function mostrar(){            
            if($this->contenido!=""){
                echo $this->contenido;
            }
            echo "</div></body></html>";
            
        }

        
    }
?>