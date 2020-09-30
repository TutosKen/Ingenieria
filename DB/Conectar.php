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

        mysqli_close($conn);
    }


    function IniciarSesion($email,$pass){
        $conn = $this->Conectar();
        $bandera = False;

        $miemail = mysqli_real_escape_string($conn,$email);
        $mipass = mysqli_real_escape_string($conn,$pass); 

        $sql = "Select * from usuario WHERE (Email = '$miemail' or Nick = '$miemail') AND Clave = '$mipass'";
        $result = mysqli_query($conn,$sql);


        mysqli_close($conn);
        return $result;
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
        mysqli_close($conn);
    }

    function getImagen($ID){
        $conn = $this->Conectar();
        $sql = "Select * from PostUsuario where IDPost = '$ID'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        mysqli_close($conn);
    }

    function aumentarCantVisitas($ID){
        $conn = $this->Conectar();
        $sql = "UPDATE post set CantVistas = CantVistas + 1 where IDPost = '$ID'";
        mysqli_query($conn,$sql);

        mysqli_close($conn);
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

        mysqli_close($conn);
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

        mysqli_close($conn);
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

        mysqli_close($conn);
        return $bandera;

    }

    function agregarUsuario($nombreR, $apellidoR, $emailR, $cedulaR, $direccionR, $telefonoR, $usuarioR,
        $passR, $preguntaR, $respuestaR){
            $conn = $this->Conectar();
                
                $sql = "INSERT INTO usuario(Nombre,Apellido,Cedula,Direccion,Email,Telefono,Nick,Clave,FK_Pregunta,RespuestaSecreta)
                VALUES ('$nombreR','$apellidoR','$cedulaR','$direccionR','$emailR','$telefonoR','$usuarioR','$passR','$preguntaR','$respuestaR')";

                    if (mysqli_query($conn,$sql)) {
                        return True;
                    }else{
                        return False;
                    }
    
            mysqli_close($conn);


    }

    function getPreguntaUsuario($email){
        $conn = $this->Conectar();
        $sql = "Select * from usuariopregunta where Email = '$email'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        mysqli_close($conn);
    }

    function getInfoUsuario($id){
        $conn = $this->Conectar();
        $sql = "select * from usuario WHERE IDUsuario = '$id'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        mysqli_close($conn);
    }

    function getCantPosts($id){
        $conn = $this->Conectar();
        $sql = "select count(*) as cantPosts from postusuario WHERE FK_Usuario = '$id'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $cantPosts = $row['cantPosts'];
            }
        }

        mysqli_close($conn);
        return $cantPosts;
    }


    function getPostsUsuario($id){
        $conn = $this->Conectar();
        $sql = "select * from postusuario WHERE FK_Usuario = '$id'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        mysqli_close($conn);
    }

    function actualizarUsuario($nombreR, $apellidoR, $emailR, $cedulaR, $direccionR, $telefonoR, $usuarioR,
    $passR , $preguntaR, $respuestaR,$id){
        $conn = $this->Conectar();
            
            $sql = "UPDATE usuario set Nombre = '$nombreR', Apellido = '$apellidoR', Cedula = '$cedulaR', Direccion = '$direccionR', Email = '$emailR', 
            Telefono = '$telefonoR', Nick = '$usuarioR', Clave = '$passR', FK_Pregunta = '$preguntaR', RespuestaSecreta = '$respuestaR' WHERE IDUsuario = '$id'";

                if (mysqli_query($conn,$sql)) {
                    return True;
                }else{
                    return False;
                }

        mysqli_close($conn);


    }

    function getImagenesFiltro($filtro){
        $conn = $this->Conectar();
        $sql = "select p.Titulo, p.Descripcion, p.Fecha_publicacion, p.CantVistas, p.Tags, p.URI, c.Nombre from post as p JOIN postxcategoria pc on 
        p.IDPost = pc.FK_Post JOIN categoria as c on c.IDCategoria = '$filtro'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        mysqli_close($conn);

    }


    function getCategorias(){
        $conn = $this->Conectar();
        $sql = "SELECT * from categoria";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        mysqli_close($conn);

    }

    function getCatPorNombre($nombre){
        $conn = $this->Conectar();
        $sql = "SELECT * from categoria where Nombre ='$nombre'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $IDCat = $row['IDCategoria'];
            }
        }

        mysqli_close($conn);
        return $IDCat;

    }

    function getPostFiltrados($nombre){
        $conn = $this->Conectar();
        $id = $this->getCatPorNombre($nombre);

        $sql = "select p.IDPost, p.Titulo, p.Descripcion, p.Fecha_publicacion, p.CantVistas,p.Tags, p.FK_Usuario, p.FK_Usuario, p.URI from post
         as p join postxcategoria as pc on pc.FK_Post = p.IDPost where pc.FK_Categoria = '$id'";
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
        mysqli_close($conn);
    }

    function eliminarCuenta($id){
        $conn = $this->Conectar();
            
        $sql = "DELETE FROM usuario where IDUsuario = '$id'";

            if (mysqli_query($conn,$sql)) {
                return True;
            }else{
                return False;
            }

    mysqli_close($conn);
    }




}

?>