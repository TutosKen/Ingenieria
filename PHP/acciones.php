<?php
session_start();
include '../DB/Usuario.php';
include '../DB/Publicacion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function Login(){
    $miUsuario = New Usuario;
    $miUsuario->setEmail($_POST['email']); 
    $miUsuario->setClave($_POST['pass']);;

    if ($miUsuario->IniciarSesion()) {
        echo "Valido";
    }else{
        echo "Invalido";
    }
}

function Registro(){
    $miUsuario = New Usuario;
    $miUsuario->llenarInfo($_POST['Nombre'],$_POST['Apellido'],$_POST['Cedula'],$_POST['Direccion'],$_POST['Email'],$_POST['Telefono'],$_POST['UsuarioR'],
    $_POST['Pass'],$_POST['Pregunta'],$_POST['Respuesta']);

    if ($miUsuario->agregarUsuario()) {
        echo "Exito";

    }
}

function verEmail(){
    $miUsuario = New Usuario;
    $email = $_POST['verEmail'];
    $miUsuario->setEmail($email);

    if ($miUsuario->verificarEmail()) {
        if ($_SESSION['IDUsuario'] != '') {
            if ($email == $_SESSION['email']) {
                echo "PerteneceAlUsuario";
            }
        }

        echo "Existe";
    }
}

function verUsuario(){
    $miUsuario = New Usuario;
    $usuario = $_POST['verUsuario'];
    $miUsuario->setNick($usuario);

    if ($miUsuario->verificarUsuario()) {
        if ($_SESSION['IDUsuario'] != '') {
            if ($usuario == $_SESSION['NombreUsuario']) {
                echo "PerteneceAlUsuario";
            }
        }
        echo "Existe";
    }
}

function verCedula(){
    $miUsuario = New Usuario;
    $cedula = $_POST['verCedula'];
    $miUsuario->setCedula($cedula);

    if ($miUsuario->verificarCedula()) {
        if ($_SESSION['IDUsuario'] != '') {
            if ($cedula == $_SESSION['cedula']) {
                echo "PerteneceAlUsuario";
            }
        }
        echo "Existe";
    }
}

function EditarInfoUsuario(){
    $miUsuario = New Usuario;
    $miUsuario->llenarInfo($_POST['NombreEditado'],$_POST['Apellido'],$_POST['Cedula'],$_POST['Direccion'],$_POST['Email'],$_POST['Telefono'],$_POST['UsuarioR'],
    $_POST['Pass'],$_POST['Pregunta'],$_POST['Respuesta']);
    $miUsuario->setID($_SESSION['IDUsuario']);

    if ($miUsuario->actualizarUsuario()) {
        echo "Exito";
    }
}

function EliminarUsuario(){
    $miUsuario = New Usuario;
    $miUsuario->setID($_SESSION['IDUsuario']);
    
    if ($miUsuario->eliminarCuenta()) {
        session_unset();
        echo "Exito";
    }
}

function RecuperarContra(){
    $miUsuario = New Usuario;
    $_SESSION['emailRecuperacion'] = $_POST['emailRecover'];
    $miUsuario->setEmail($_POST['emailRecover']);

    $result = $miUsuario->getPreguntaUsuario();

        while($row = mysqli_fetch_assoc($result)) {
            echo "<script>document.getElementById('emailRecover').setAttribute('disabled','')</script>";
            echo"<label id='preguntaS' class='fuente-custom mt-3 mb-2' for='respuestaS'>".$row['Pregunta']."</label>";
            echo"<input type='text' class='form-control form-control-sm' id='respuestaS' placeholder='Respuesta'>";
            $_SESSION['respuestaCorrecta'] = $row['RespuestaSecreta'];
            $_SESSION['Clave'] = $row['Clave'];
            
        }
}

function EnviarCorreoRecuperacion(){
    $res = trim($_POST['respuestaS']);

    if ($res == $_SESSION['respuestaCorrecta']) {  
            $mail = New PHPMailer(true);
            $mail->IsSMTP();
            try {
                $mail->From = "tutos1620@gmail.com";
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls'; //seguridad
                $mail->Host = "smtp.gmail.com"; // servidor smtp
                $mail->Port = 587; //puerto
                $mail->Username ='tutos1620@gmail.com'; //nombre usuario
                $mail->Password = 'keneth155tutos'; //contraseña
        
                $mail->AddAddress($_SESSION['emailRecuperacion'],'Admin@animales.com');
                $mail->Subject = 'Recuperacion de contrasenna';
                $mail->Body = 'Tu contraseña es: '.$_SESSION['Clave'];
        
                $mail->send();
                echo "Exito";
            } catch (Exception $e) {
                echo "El mensaje no se pudo enviar. Error: {$mail->ErrorInfo}";
            }      
        }
}

function BuscarPost(){
    $miPost = New Publicacion;
    $str = $_POST['busqueda'];
    echo $miPost->buscar($str);
}

function FiltrarCat(){
    $miPost = New Publicacion;
    $str = $_POST['NombreCat'];
    echo $miPost->getPostFiltrados($str); 
}

function CerrarSesion(){
    session_unset();
    header('location: /Animales/');
}

if (isset($_POST['email'])) {
    Login();
}

if (isset($_POST['Nombre'])) {
    Registro();
}

if (isset($_POST['verEmail'])) {
    verEmail();
}

if (isset($_POST['verUsuario'])) {
    verUsuario();
}

if (isset($_POST['verCedula'])) {
    verCedula();
}

if (isset($_POST['NombreEditado'])) {
    EditarInfoUsuario();

}

if (isset($_POST['EliminarCuenta'])) {
    EliminarUsuario();
}

if (isset($_POST['emailRecover'])) {
    RecuperarContra();
}

if (isset($_POST['respuestaS'])) {
    EnviarCorreoRecuperacion();
}

if (isset($_POST['logout'])) {
    CerrarSesion();
}

if (isset($_POST['busqueda'])) {
    BuscarPost();
}

if (isset($_POST['NombreCat'])) {
    FiltrarCat();   
}

?>