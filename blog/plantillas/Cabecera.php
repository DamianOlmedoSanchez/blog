<?php
    class Cabecera{
        public $titulo="";
        public $menu="";
        public $menuCRUD="";

        public function __construct($titulo){
            $this->titulo=$titulo;
            $this->setMenu();
            $this->setMenuCRUD();
        }

        public function mostrar(){
			SESSION_START();
			if(!isset($_SESSION["usuario"])){
				header("Status: 301 Moved Permanently");
				header("Location: /damian/blog/login.php");
				exit;
			}
			
            echo "<!DOCTYPE html><html lang='es'><meta charset='UTF-8'>            
                <meta name='viewport' content='width=device-width, initial-scale=1.0'><head>
                <title>" . $this->titulo . "</title>";
            echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">';            
            echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>';
            echo "<style> label{font-weight: bold;}</style>";
            echo "</head><body>";
            
        }

        public function mostrarConMenu(){
            $this->mostrar();
            echo $this->menu;
        }

        public function mostrarConMenuCRUD(){
            $this->mostrar();
            echo $this->menuCRUD;
        }

        public function setMenu(){            
            $this->menu='<header class="p-3 text-bg-dark">
                <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                    </a>

                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="index.php" class="nav-link px-2 text-secondary">Inicio</a></li>
                        <li><a href="crud/crud.php" class="nav-link px-2 text-white">CRUD</a></li> 
						<li><a href="crudUsuarios/crud.php" class="nav-link px-2 text-white">CRUD Usuarios</a></li>						
                    </ul>

                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                        <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
                    </form>

                    <div class="text-end">
                    <button type="button" class="btn btn-outline-light me-2">Login</button>
                    <button type="button" class="btn btn-warning">Sign-up</button>
                    </div>
                </div>
                </div>
            </header>
            <div class="container">';            
        }        
        
        public function setMenuCRUD(){            
            $this->menuCRUD='<header class="p-3 text-bg-dark">
                <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                    </a>

                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="../index.php" class="nav-link px-2 text-secondary">Inicio</a></li>
                        <li><a href="/damian/blog/crud/crud.php" class="nav-link px-2 text-white">CRUD</a></li>
						<li><a href="/damian/blog/crudUsuarios/crud.php" class="nav-link px-2 text-white">CRUD Usuarios</a></li>
                    </ul>

                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                        <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
                    </form>

                    <div class="text-end">
                    <button type="button" class="btn btn-outline-light me-2">Login</button>
                    <button type="button" class="btn btn-warning">Sign-up</button>
                    </div>
                </div>
                </div>
            </header>
            <div class="container">';            
        }
    }
?>
