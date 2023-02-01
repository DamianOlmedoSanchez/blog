<?php
    class Conexion {
        public $conexion;

        public function __construct(){
            $this->conexion=new mysqli("localhost", "damian", "Murcia2022");

            //Creamos la base de datos si no existe            
            $this->conexion->query("CREATE DATABASE IF NOT EXISTS h0122u0007_damian;");

            //Seleccionamos la base de datos
            $this->conexion->select_db("h0122u0007_damian");            
        }

        public function getConexion(){
            return $this->conexion;
        }

    }   
?>