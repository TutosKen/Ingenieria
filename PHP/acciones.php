<?php
session_start();

require_once('../DB/Conectar.php');

if (isset($_POST['email'])) {
    $conn = New Conexion;
    $email = $_POST['email']; 
    $passwd = $_POST['pass'];
    
    if ($conn->IniciarSesion($email,$passwd)) {
        $_SESSION['usuario'] = $email;
        echo "Valido";
    }else{
        echo "Invalido";
    }
}

if (isset($_POST['logout'])) {
    session_unset();
    header('location: /Animales/PHP/login.php');
}

if (isset($_POST['busqueda'])) {
    $str = $_POST['busqueda'];
    $conn = New Conexion;
    echo $conn->buscar($str);
}
?>