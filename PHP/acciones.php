<?php
session_start();

require_once('../DB/Conectar.php');
$conn = New Conexion;

if (isset($_POST['email'])) {
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
    header('location: /Animales/');
}

if (isset($_POST['busqueda'])) {
    $str = $_POST['busqueda'];
    echo $conn->buscar($str);
}


if (isset($_POST['Nombre'])) {
    $nombreR = $_POST['Nombre'];
    $apellidoR = $_POST['Apellido'];
    $emailR = $_POST['Email'];
    $cedulaR = $_POST['Cedula'];
    $direccionR = $_POST['Direccion'];
    $telefonoR = $_POST['Telefono'];
    $usuarioR = $_POST['UsuarioR'];
    $passR = $_POST['Pass'];
    $confPassR = $_POST['ConfPass'];
    $preguntaR = $_POST['Pregunta'];
    $respuestaR = $_POST['Respuesta'];

    if ($conn->agregarUsuario($nombreR, $apellidoR, $emailR, $cedulaR, $direccionR, $telefonoR, $usuarioR,
    $passR, $confPassR, $preguntaR, $respuestaR)) {
        $_SESSION['usuario'] = $emailR;
        echo "Exito";

    }
}


if (isset($_POST['verEmail'])) {
    $email = $_POST['verEmail'];

    if ($conn->verificarEmail($email)) {
        echo "Existe";
    }
}


if (isset($_POST['verUsuario'])) {
    $usuario = $_POST['verUsuario'];

    if ($conn->verificarUsuario($usuario)) {
        echo "Existe";
    }
}

if (isset($_POST['verCedula'])) {
    $cedula = $_POST['verCedula'];

    if ($conn->verificarCedula($cedula)) {
        echo "Existe";
    }
}
?>