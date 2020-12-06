<?php
session_start();
include '../DB/Usuario.php';
include '../DB/Publicacion.php';
include '../DB/Comentario.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


function CargarImagenes(){
    $miPost = New Publicacion;
    $miPost->getImagenes();
}

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
    $miUsuario = New Usuario;
    $res = trim($miUsuario->EncriptarPass($_POST['respuestaS']));

    if ($res == $_SESSION['respuestaCorrecta']) {  
            $mail = New PHPMailer(true);
            $mail->IsSMTP();
            try {
                $mail->From = "tucorreoaqui@gmail.com";
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls'; //seguridad
                $mail->Host = "smtp.gmail.com"; // servidor smtp
                $mail->Port = 587; //puerto
                $mail->Username ='tucorreoaqui@gmail.com'; //nombre usuario
                $mail->Password = 'tucontrasennaAqui'; //contraseña
        
                $mail->AddAddress($_SESSION['emailRecuperacion'],'Admin@animales.com');
                $mail->Subject = 'Recuperacion de contrasenna';
                $mail->Body = 'Tu contraseña es: '.$miUsuario->DesencriptarPass($_SESSION['Clave']);
        
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


function mostrarMas(){
    $miPost = new Publicacion;
    $miPost->setLimit($_POST['nuevaCuenta']);
    $miPost->getImagenes();
}

function verificarMaxPosts(){
    $miPost = new Publicacion;
    $result = $miPost->countPosts();

    if ($result <= $_POST['MaxPosts']) {
        echo 1;
    }
}

function agregarTag(){
    $tag = $_POST['tag'];
    $tag = explode(",",$tag)[0];
    echo "<div class='col-md-2 col-4 mt-2 bg-dark tag ml-2'>";
        echo "<button class='eliminarTag btn btn-sm' style='background:transparent; border:none;'>&#10005;</button>";
        echo "<p class='tagContent'>".$tag."</p>";
    echo "</div>";
}

function ModificarImagen(){
    $miPost = new Publicacion; 
    $cats = $_POST['cat'];
    // echo $miPost->getID();
    $miPost->setID($_POST['id']);
    $miPost->setTitulo($_POST['titulo']);
    $miPost->setDescripcion($_POST['desc']);
    $miPost->setTags($_POST['tags']);
    if ($miPost->modificarImagen()) {
        $elements = explode(',',$cats);
        if ($miPost->actualizarPostXCategoria($miPost->getID(),$elements)) {
            echo "Exito";
        }else{
            echo 0;
        }
    }
}

function EliminarPost(){
    $miPost = New Publicacion;
    $miPost->setID($_POST['idElimP']);

    if ($miPost->eliminarPost()) {
        echo 1;
    }
}

function agregarComentario(){
    $miComentario = New Comentario;
    $texto = $_POST['agregarCom'];
    $idPost = $_POST['idPost'];

    $miComentario->setComent($texto);
    $miComentario->setIDPost($idPost);
    $miComentario->setFKUsuario($_SESSION['IDUsuario']);

    if ($miComentario->agregarComentario()) {
        $postcom = $miComentario->getPostComentarios();

        while ($fila = mysqli_fetch_assoc($postcom)) {
            if ($fila['FK_Post'] == $idPost) {
                $miComentario->setID($fila['FK_Comentario']);
                $miComentario->getComentario();
            }
        }
    }

    
}

function modificarComentario(){
    $miComentario = New Comentario;
    $comentario = $_POST['comentario'];
    $esRespuesta = $_POST['esRespuesta'];
    $id = $_POST['IDcoment'];

    $miComentario->setComent($comentario);
    $miComentario->setID($id);

    if ($esRespuesta != "") {
        if ($miComentario->modificarComentario(true)) {
            echo 1;
        }
    }else{
        if ($miComentario->modificarComentario()) {
            echo 1;
        }
    }
}

function eliminarComentario(){
    $miComentario = New Comentario;
    $id = $_POST['elimComent'];
    $respuesta = $_POST['esRespuesta'];
    $miComentario->setID($id);

    if ($respuesta != "") {
        if ($miComentario->eliminarComentario(true)) {
            echo 1;
        }
    }else{
        if ($miComentario->eliminarComentario()) {
            echo 1;
        }
    }
}


if (isset($_POST['agregarCom'])) {
    agregarComentario();
}

if (isset($_POST['cargar'])) {
    CargarImagenes();
}

if (isset($_POST['tag'])) {
    agregarTag();
}

if (isset($_POST['MaxPosts'])) {
    verificarMaxPosts();
}

if (isset($_POST['nuevaCuenta'])) {
    mostrarMas();
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

if (isset($_POST['titulo'])) {
    ModificarImagen();
}

if (isset($_POST['idElimP'])) {
    EliminarPost();
}

if (isset($_POST['comentario'])) {
    modificarComentario();
}

if (isset($_POST['elimComent'])) {
    eliminarComentario();
}
?>
