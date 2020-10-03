<?php
session_start();
require_once('Conectar.php');

class Publicacion{
    private $IDPost;
    private $Titulo;
    private $Descripcion;
    private $Fecha_Publicacion;
    private $CantVistas;
    private $Tags;
    private $FK_Usuario;
    private $URI;
    private $conn;
    private $Limit = 12;

    public function __construct(){
        $this->conn = New Conexion;
    }

    public function getImagenes(){
        $conn = $this->conn->Conectar();
        $sql = "Select * from post LIMIT $this->Limit";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='animarImagen col-6 col-md-3 mt-5'>";
                echo "<div class='imagen'><a href='/Animales/PHP/Paginas/Post.php?IDimagen=".$row['IDPost']."'><img class='miniatura' src='".$row['URI']."'><h5 class='text-center'>".$row['Titulo']."</h5></a></div>";
                echo "<div class='vistas'>👁<strong>".$row['CantVistas']."</strong></div>";
                echo"</div>";
            }
        }

        mysqli_close($conn);
    }

    public function countPosts(){
        $conn = $this->conn->Conectar();
        $sql = "Select count(*) as cant from post";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                return $row['cant'];
            }
        }

        mysqli_close($conn);
    }

    public function buscar($str){
        $conn = $this->conn->Conectar();

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

    public function getCategorias(){
        $conn = $this->conn->Conectar();
        $sql = "SELECT * from categoria";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        mysqli_close($conn);

    }

    public function getPostFiltrados($nombre){
        $conn = $this->conn->Conectar();
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

    public function getCatPorNombre($nombre){
        $conn = $this->conn->Conectar();
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


    public function getImagen(){
        $conn = $this->conn->Conectar();
        $sql = "Select * from PostUsuario where IDPost = '$this->IDPost'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }

        mysqli_close($conn);
    }

    public function aumentarCantVisitas(){
        $conn = $this->conn->Conectar();
        $sql = "UPDATE post set CantVistas = CantVistas + 1 where IDPost = '$this->IDPost'";
        mysqli_query($conn,$sql);

        mysqli_close($conn);
    }

    public function agregarImagen(){
        $conn = $this->conn->Conectar();
        $titulo = mysqli_real_escape_string($conn,$this->Titulo);
        $descripcion = mysqli_real_escape_string($conn,$this->Descripcion);
        $tags = mysqli_real_escape_string($conn,$this->Tags);
        $FK_Usuario = mysqli_real_escape_string($conn,$this->FK_Usuario);
        $URI = mysqli_real_escape_string($conn,$this->URI);
                
        $sql = "INSERT INTO post(Titulo,Descripcion,Tags,FK_Usuario,URI) VALUES('$titulo','$descripcion','$tags','$FK_Usuario','$URI');";

            if (mysqli_query($conn,$sql)) {
                return True;
            }else{
                return False;
            }

    mysqli_close($conn);
    }

    public function getImagenPorURI(){
        $conn = $this->conn->Conectar();
        $sql = "SELECT * from post where URI ='$this->URI'";
        $result = mysqli_query($conn,$sql);
        $IDPost = 0;

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $IDPost = $row['IDPost'];
            }
        }

        mysqli_close($conn);
        return $IDPost;
    }

    public function getLastID(){
        $conn = $this->conn->Conectar();
        $sql = "SELECT MAX(IDPost) AS MaxIDPost FROM post";
        $result = mysqli_query($conn,$sql);

            if (mysqli_query($conn,$sql)) {
                while($row = mysqli_fetch_assoc($result)) {
                    $ID = $row['MaxIDPost'];
                }
            }

        mysqli_close($conn);
        return $ID;
    }

    function agregarPostXCategoria($id,$arr){
        $conn = $this->conn->Conectar();

            foreach ($arr as $element) {
                $sql .= "CALL insertarCategorias('$id','$element');";
            }

            if (mysqli_multi_query($conn,$sql)) {
                return True;
        }

        mysqli_close($conn);
}


    public function setID($par){
        $this->IDPost = $par;
    }

    public function setTitulo($par){
        $this->Titulo = $par;
    }

    public function setDescripcion($par){
        $this->Descripcion = $par;
    }

    public function setTags($par){
        $this->Tags = $par;
    }

    public function setFKUsuario($par){
        $this->FK_Usuario = $par;
    }

    public function setURI($par){
        $this->URI = $par;
    }

    public function setLimit($par){
        $this->Limit = $par;
    }
}

?>