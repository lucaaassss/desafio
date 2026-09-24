<?php
session_start();
$servidor = "localhost";   
$usuario = "root";         
$password = "";            
$base_datos = "desafiointers"; 
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);
?>