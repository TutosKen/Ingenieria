<?php
session_start();
require_once('Conectar.php');

class Usuario{
    private $Nombre;
    private $Apellido;
    private $Cedula;
    private $Direccion;
    private $Email;
    private $Telefono;
    private $Nick;
    private $Clave;
    private $FK_Pregunta;
    private $RespuestaSecreta;
    private $IDUsuario;
    private $conn;

    public function __construct(){
        $this->conn = New Conexion;
    }

    public function llenarInfo($nombre,$apellido,$cedula,$direccion,$email,$telefono,$nick,$clave,$pregunta,$respuesta){
        $this->Nombre = $nombre;
        $this->Apellido = $apellido;
        $this->Cedula = $cedula;
        $this->Direccion = $direccion;
        $this->Email = $email;
        $this->Telefono = $telefono;
        $this->Nick = $nick;
        $this->Clave = $clave;
        $this->FK_Pregunta = $pregunta;
        $this->RespuestaSecreta = $respuesta;
    }

    public function IniciarSesion(){
        $conn = $this->conn->Conectar();
        $miemail = mysqli_real_escape_string($conn,$this->Email);
        $mipass = mysqli_real_escape_string($conn,$this->Clave); 
        $mipass = $this->EncriptarPass($this->Clave);

        $sql = "Select * from usuario WHERE (Email = '$miemail' or Nick = '$miemail') AND Clave = '$mipass'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $_SESSION['IDUsuario'] = $fila['IDUsuario'];
                $_SESSION['email'] = $fila['Email'];
                $_SESSION['NombreUsuario'] = $fila['Nick'];
                $_SESSION['cedula'] = $fila['Cedula'];
            }
            return True;
        }else{
            return False;
        }

            mysqli_close($conn);
    }

    public function agregarUsuario(){
        $conn = $this->conn->Conectar();

        $nombre = mysqli_real_escape_string($conn,$this->Nombre);
        $apellido = mysqli_real_escape_string($conn,$this->Apellido);
        $cedula = mysqli_real_escape_string($conn,$this->Cedula);
        $direccion = mysqli_real_escape_string($conn,$this->Direccion);
        $email = mysqli_real_escape_string($conn,$this->Email);
        $telefono = mysqli_real_escape_string($conn,$this->Telefono);
        $nick = mysqli_real_escape_string($conn,$this->Nick);
        $clave = mysqli_real_escape_string($conn,$this->Clave);
        $clave = $this->EncriptarPass($clave);
        $pregunta = mysqli_real_escape_string($conn,$this->FK_Pregunta);
        $respuesta = mysqli_real_escape_string($conn,$this->RespuestaSecreta);
            
            $sql = "INSERT INTO usuario(Nombre,Apellido,Cedula,Direccion,Email,Telefono,Nick,Clave,FK_Pregunta,RespuestaSecreta)
            VALUES ('$nombre','$apellido','$cedula','$direccion','$email','$telefono','$nick','$clave','$pregunta','$respuesta')";

                if (mysqli_query($conn,$sql)) {
                    $this->IniciarSesion();
                    return True;
                }else{
                    return False;
                }

        mysqli_close($conn);

    }

    public function actualizarUsuario(){
        $conn = $this->conn->Conectar();

        $nombre = mysqli_real_escape_string($conn,$this->Nombre);
        $apellido = mysqli_real_escape_string($conn,$this->Apellido);
        $cedula = mysqli_real_escape_string($conn,$this->Cedula);
        $direccion = mysqli_real_escape_string($conn,$this->Direccion);
        $email = mysqli_real_escape_string($conn,$this->Email);
        $telefono = mysqli_real_escape_string($conn,$this->Telefono);
        $nick = mysqli_real_escape_string($conn,$this->Nick);
        $clave = mysqli_real_escape_string($conn,$this->Clave);
        $clave = $this->EncriptarPass($clave);
        $pregunta = mysqli_real_escape_string($conn,$this->FK_Pregunta);
        $respuesta = mysqli_real_escape_string($conn,$this->RespuestaSecreta);
        $id = mysqli_real_escape_string($conn,$this->IDUsuario);
            
            $sql = "UPDATE usuario set Nombre = '$nombre', Apellido = '$apellido', Cedula = '$cedula', Direccion = '$direccion', Email = '$email', 
            Telefono = '$telefono', Nick = '$nick', Clave = '$clave', FK_Pregunta = '$pregunta', RespuestaSecreta = '$respuesta' WHERE IDUsuario = '$id'";

                if (mysqli_query($conn,$sql)) {
                    return True;
                }else{
                    return False;
                }

        mysqli_close($conn);


    }

    public function eliminarCuenta(){
        $conn = $this->conn->Conectar();
        $id = $this->IDUsuario;
            
        $sql = "DELETE FROM usuario where IDUsuario = '$id'";

            if (mysqli_query($conn,$sql)) {
                return True;
            }else{
                return False;
            }

    mysqli_close($conn);
    }

    function getPreguntaUsuario(){
        $conn = $this->conn->Conectar();
        $sql = "Select * from usuariopregunta where Email = '$this->Email'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        mysqli_close($conn);
    }

    public function getInfoUsuario(){
        $conn = $this->conn->Conectar();
        $sql = "select * from usuario WHERE IDUsuario = '$this->IDUsuario'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        mysqli_close($conn);
    }

    public function getCantPosts(){
        $conn = $this->conn->Conectar();
        $sql = "select count(*) as cantPosts from postusuario WHERE FK_Usuario = '$this->IDUsuario'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $cantPosts = $row['cantPosts'];
            }
        }

        mysqli_close($conn);
        return $cantPosts;
    }


    public function getPostsUsuario(){
        $conn = $this->conn->Conectar();
        $sql = "select * from postusuario WHERE FK_Usuario = '$this->IDUsuario'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        mysqli_close($conn);
    }

    public function verificarEmail(){
        $bandera = False;
        $conn = $this->conn->Conectar();

        $email = mysqli_real_escape_string($conn,$this->Email);

        $sql = "Select Email from usuario where Email = '$email'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            $bandera = True;
        }

        mysqli_close($conn);
        return $bandera;



    }

    public function verificarUsuario(){
        $bandera = False;
        $conn = $this->conn->Conectar();

        $usuario = mysqli_real_escape_string($conn,$this->Nick);

        $sql = "Select Nick from usuario where Nick = '$usuario'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            $bandera = True;
        }

        mysqli_close($conn);
        return $bandera;

    }

    public function verificarCedula(){
        $bandera = False;
        $conn = $this->conn->Conectar();
        $ced = mysqli_real_escape_string($conn,$this->Cedula);

        $sql = "Select Cedula from usuario where Cedula = '$ced'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            $bandera = True;
        }

        mysqli_close($conn);
        return $bandera;

    }

    public function EncriptarPass($str){
        $cifrado = "AES-128-CTR";

        $iv_length = openssl_cipher_iv_length($cifrado); 
        $options = 0;
    
        $encryption_iv = '1234567891011121'; 
        
        $clave_enc = "ClaveDeEncriptado"; 
        
        $encryption = openssl_encrypt($str, $cifrado, 
                    $clave_enc, $options, $encryption_iv);

        return $encryption;
    }

    public function DesencriptarPass($str){
        $cifrado = "AES-128-CTR";
        $options = 0;

        $decryption_iv = '1234567891011121'; 
        $decryption_key = "ClaveDeEncriptado"; 
        
        $decryption = openssl_decrypt ($str, $cifrado,  
                $decryption_key, $options, $decryption_iv); 

        return $decryption;
    }

    public function setEmail($par){
        $this->Email = $par;
    }

    public function setClave($par){
        $this->Clave = $par;
    }

    public function setNick($par){
        $this->Nick = $par;
    }
    public function setCedula($par){
        $this->Cedula = $par;
    }

    public function getEmail(){
        return $this->Email;
    }

    public function getClave(){
        return $this->Clave;
    }

    public function setID($par){
        $this->IDUsuario = $par;
    }

    public function getID(){
        return $this->IDUsuario;
    }



}


?>