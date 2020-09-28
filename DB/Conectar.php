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
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col-6 col-md-3 mt-5'>";
                echo "<div class='imagen'><a href='#'><img class='miniatura' src='".$row['URI']."'><h4 class='text-center'>".$row['Titulo']."</h4></a></div>";
                echo"</div>";
            }
        }

        mysqli_close($conexion);
    }
}

?>