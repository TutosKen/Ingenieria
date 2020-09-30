<?php
session_start();
//session_unset();
require_once('../DB/Conectar.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$conn = New Conexion;

if (isset($_POST['email'])) {
    $emailL = $_POST['email']; 
    $passwd = $_POST['pass'];

    $bandera = $conn->IniciarSesion($emailL,$passwd);

    if (mysqli_num_rows($bandera) > 0) {
        while ($fila = mysqli_fetch_assoc($bandera)) {
            $_SESSION['IDUsuario'] = $fila['IDUsuario'];
            $_SESSION['email'] = $fila['Email'];
            $_SESSION['NombreUsuario'] = $fila['Nick'];
            $_SESSION['cedula'] = $fila['Cedula'];
        }
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

if (isset($_POST['NombreCat'])) {
    $str = $_POST['NombreCat'];
    echo $conn->getPostFiltrados($str);
    
    
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
    $preguntaR = $_POST['Pregunta'];
    $respuestaR = $_POST['Respuesta'];

    if ($conn->agregarUsuario($nombreR, $apellidoR, $emailR, $cedulaR, $direccionR, $telefonoR, $usuarioR,
    $passR, $preguntaR, $respuestaR)) {

        $flag = $conn->IniciarSesion($emailR,$passR);

        if (mysqli_num_rows($flag) > 0) {
            while ($filar = mysqli_fetch_assoc($flag)) {
                $_SESSION['IDUsuario'] = $filar['IDUsuario'];
                $_SESSION['email'] = $fila['Email'];
                $_SESSION['NombreUsuario'] = $fila['Nick'];
                $_SESSION['cedula'] = $fila['Cedula'];
            }
        }

        echo "Exito";

    }
}

if (isset($_POST['NombreEditado'])) {
    $nombreR = $_POST['NombreEditado'];
    $apellidoR = $_POST['Apellido'];
    $emailR = $_POST['Email'];
    $cedulaR = $_POST['Cedula'];
    $direccionR = $_POST['Direccion'];
    $telefonoR = $_POST['Telefono'];
    $usuarioR = $_POST['UsuarioR'];
    $passR = $_POST['Pass'];
    $preguntaR = $_POST['Pregunta'];
    $respuestaR = $_POST['Respuesta'];
    $idR = $_SESSION['IDUsuario'];

    if ($conn->actualizarUsuario($nombreR, $apellidoR, $emailR, $cedulaR, $direccionR, $telefonoR, $usuarioR,
    $passR, $preguntaR, $respuestaR,$idR)) {

        echo "Exito";

    }
}


if (isset($_POST['verEmail'])) {
    $email = $_POST['verEmail'];

    if ($conn->verificarEmail($email)) {
        if ($_SESSION['IDUsuario'] != '') {
            if ($email == $_SESSION['email']) {
                echo "PerteneceAlUsuario";
            }
        }

        echo "Existe";
    }
    
}


if (isset($_POST['verUsuario'])) {
    $usuario = $_POST['verUsuario'];

    if ($conn->verificarUsuario($usuario)) {
        if ($_SESSION['IDUsuario'] != '') {
            if ($usuario == $_SESSION['NombreUsuario']) {
                echo "PerteneceAlUsuario";
            }
        }
        echo "Existe";
    }
}

if (isset($_POST['verCedula'])) {
    $cedula = $_POST['verCedula'];

    if ($conn->verificarCedula($cedula)) {
        if ($_SESSION['IDUsuario'] != '') {
            if ($cedula == $_SESSION['cedula']) {
                echo "PerteneceAlUsuario";
            }
        }
        echo "Existe";
    }
}

if (isset($_POST['emailRecover'])) {
    $_SESSION['emailRecuperacion'] = $_POST['emailRecover'];
    $result = $conn->getPreguntaUsuario($_SESSION['emailRecuperacion']);

        while($row = mysqli_fetch_assoc($result)) {
            echo "<script>document.getElementById('emailRecover').setAttribute('disabled','')</script>";
            echo"<label id='preguntaS' class='fuente-custom mt-3 mb-2' for='respuestaS'>".$row['Pregunta']."</label>";
            echo"<input type='text' class='form-control form-control-sm' id='respuestaS' placeholder='Respuesta'>";
            $_SESSION['respuestaCorrecta'] = $row['RespuestaSecreta'];
            $_SESSION['Clave'] = $row['Clave'];
            
        }
}

if (isset($_POST['respuestaS'])) {
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

if (isset($_POST['EliminarCuenta'])) {
    $idElim = $_SESSION['IDUsuario'];
    
    if ($conn->eliminarCuenta($idElim)) {
        session_unset();
        echo "Exito";
    }
}


if(isset($_POST['agregarImagen'])){
    $imagen = $_FILES['subirImg']['tmp_name'];
    $uri = $_POST['URIn'];
    $titulo = $_POST['titulo'];
    $desc = $_POST['desc'];
    $tags = $_POST['tags'];
    $cats = $_POST['Cat'];

    if ($conn->agregarImagen($titulo, $desc, $tags, $_SESSION['IDUsuario'],$uri,$cats)) {
        echo "Exito";
    }

}
?>