<?php
class Conexion{
    private $servername = "localhost";
    private $username = "root";
    private $password = "toor1234";
    private $db = "animales";

    function Conectar(){
        $conn = mysqli_connect($this->servername, $this->username, $this->password,$this->db);


        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        //echo "Conectado satisfactoriamente";
        return $conn;
    }


    function getImagenes(){
        $conn = $this->Conectar();
        $sql = "Select * from post";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        mysqli_close($conexion);
    }


    function IniciarSesion($email,$pass){
        $conn = $this->Conectar();
        $bandera = False;

        $miemail = mysqli_real_escape_string($conn,$email);
        $mipass = mysqli_real_escape_string($conn,$pass); 

        $sql = "Select * from usuario WHERE Email = '$miemail' AND Clave = '$mipass'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            $bandera = True;
        }

        mysqli_close($conexion);
        return $bandera;
    }


    function buscar($str){
        $conn = $this->Conectar();

        $sql = "select * from post where Titulo LIKE '%$str%' or Descripcion LIKE '%$str%' or Tags LIKE '%$str%'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col-6 col-md-3 mt-5'>";
                echo "<div class='imagen'><a href='/Animales/PHP/Post.php?IDimagen=".$row['IDPost']."'><img class='miniatura' src='".$row['URI']."'><h5 class='text-center'>".$row['Titulo']."</h5></a></div>";
                echo "<div class='vistas'>👁<strong>".$row['CantVistas']."</strong></div>";
                echo"</div>";
            }
        
        }else{
            echo "<h4 class='ml-3 mt-3' id='noResult'>No se encontraron resultados</h4>";
        }
        mysqli_close($conexion);
    }

    function getImagen($ID){
        $conn = $this->Conectar();
        $sql = "Select * from PostUsuario where IDPost = '$ID'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        mysqli_close($conexion);
    }

    function aumentarCantVisitas($ID){
        $conn = $this->Conectar();
        $sql = "UPDATE post set CantVistas = CantVistas + 1 where IDPost = '$ID'";
        mysqli_query($conn,$sql);

        mysqli_close($conexion);
    }

    function verificarEmail($email){
        $bandera = False;
        $conn = $this->Conectar();
        $em = mysqli_real_escape_string($conn,$email);

        $sql = "Select Email from usuario where Email = '$em'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            $bandera = True;
        }

        mysqli_close($conexion);
        return $bandera;



    }

    function verificarUsuario($usuario){
        $bandera = False;
        $conn = $this->Conectar();
        $us = mysqli_real_escape_string($conn,$usuario);

        $sql = "Select Nick from usuario where Nick = '$us'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            $bandera = True;
        }

        mysqli_close($conexion);
        return $bandera;

    }

    function verificarCedula($cedula){
        $bandera = False;
        $conn = $this->Conectar();
        $ced = mysqli_real_escape_string($conn,$cedula);

        $sql = "Select Cedula from usuario where Cedula = '$ced'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            $bandera = True;
        }

        mysqli_close($conexion);
        return $bandera;

    }

    function agregarUsuario($nombreR, $apellidoR, $emailR, $cedulaR, $direccionR, $telefonoR, $usuarioR,
        $passR, $confPassR, $preguntaR, $respuestaR){
            $conn = $this->Conectar();

                $sql = "INSERT INTO usuario(Nombre,Apellido,Cedula,Direccion,Email,Telefono,Nick,Clave,FK_Pregunta,RespuestaSecreta)
                VALUES ('$nombreR','$apellidoR','$cedulaR','$direccionR','$emailR','$telefonoR','$usuarioR','$passR','$preguntaR','$respuestaR')";

                    if (mysqli_query($conn,$sql)) {
                        return True;
                    }else{
                        return False;
                    }
                


            
        
    
            mysqli_close($conexion);


    }

}

?>