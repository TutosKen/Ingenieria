<?php
class Conexion{
    private $servername = "localhost";
    private $username = "root";
    private $password = "toor1234";
    private $db = "animales";

    public function Conectar(){
        $conn = mysqli_connect($this->servername, $this->username, $this->password,$this->db);


        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        //echo "Conectado satisfactoriamente";
        return $conn;
    }



    // function getImagenesFiltro($filtro){
    //     $conn = $this->Conectar();
    //     $sql = "select p.Titulo, p.Descripcion, p.Fecha_publicacion, p.CantVistas, p.Tags, p.URI, c.Nombre from post as p JOIN postxcategoria pc on 
    //     p.IDPost = pc.FK_Post JOIN categoria as c on c.IDCategoria = '$filtro'";
    //     $result = mysqli_query($conn,$sql);

    //     if (mysqli_num_rows($result) > 0) {
    //         return $result;
    //     }

    //     mysqli_close($conn);

    // }


}

?>