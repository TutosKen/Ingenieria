<?php
session_start();
require_once('Conectar.php');

class Comentario{
    private $IDComentario;
    private $Comentario;
    private $Fecha;
    private $FK_Usuario;
    private $conn;
    private $idPost;




    public function __construct(){
        $this->conn = New Conexion;
    }


    public function agregarComentario(){
        $conn = $this->conn->Conectar();
        $comentario = mysqli_real_escape_string($conn,$this->Comentario);
            
            $sql = "INSERT INTO comentario(Comentario,FK_Usuario) VALUES('$comentario',$this->FK_Usuario)";

                if (mysqli_query($conn,$sql)) {
                    if ($this->agregarPostComentario()) {
                        return True;
                    }
                }

        mysqli_close($conn);

    }

    public function agregarPostComentario(){
        $conn = $this->conn->Conectar();
        $id = intVal($this->getLastID());
            
            $sql = "INSERT INTO postxcomentario(FK_Post,FK_Comentario) VALUES($this->idPost,$id)";

                if (mysqli_query($conn,$sql)) {
                    return True;
                }else{
                    return False;
                }

        mysqli_close($conn);
    }

    public function getLastID(){
        $conn = $this->conn->Conectar();

            $sql = "SELECT MAX(IDComentario) as MaxID from comentario";
            $result = mysqli_query($conn,$sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        return $row['MaxID'];
                    }
                }

        mysqli_close($conn);
    }

    public function getPostComentarios(){
        $conn = $this->conn->Conectar();
        $sql = "SELECT * FROM postxcomentario ORDER BY FK_Comentario DESC";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
                return $result;
            }

        mysqli_close($conn);
    }

    public function getComentario(){
        $conn = $this->conn->Conectar();
        $sql = "CALL obtenerComentario($this->IDComentario)";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            while ($fila2 = mysqli_fetch_assoc($result)) {
                echo "<div class='col-12'>";
                echo "<div class='card bg-transparent border-dark'>";
                echo "<div class='card-header'><strong>".$fila2['Nick'].", ".explode(' ',$fila2['Fecha'])[0]."</strong></div>";
                echo "<div class='card-body'>".$fila2['Comentario']."</div>";
                echo "<button class='btn btn-dark btn-sm mostrarOpciones'>•••</button>";
                echo "<button class='btn btn-success btn-sm editarComent' style='display:none;' value='$this->IDComentario'>&#9998</button>";
                echo "<button class='btn btn-danger btn-sm eliminarComent' style='display:none;' value='$this->IDComentario'>&#10006</button>";
                echo" </div>";
                echo "<a class='responder' href=''>Responder</a>";
                echo "</div>";       
                $this->getRespuestas();
            }
            }

        mysqli_close($conn);
    }

    public function modificarComentario($respuesta = false){
        $conn = $this->conn->Conectar();
        $comentario = mysqli_real_escape_string($conn,$this->Comentario);
            
            if (!$respuesta) {
                $sql = "UPDATE comentario SET Comentario = '$comentario' WHERE IDComentario = $this->IDComentario";
            }else{
                $sql = "UPDATE respuesta SET Contenido = '$comentario' WHERE IDRespuesta = $this->IDComentario";
            }
            

                if (mysqli_query($conn,$sql)) {
                        return True;
                }

        mysqli_close($conn);
    }

    public function getRespuestas(){
        $conn = $this->conn->Conectar();
        $sql = "SELECT r.IDRespuesta, r.Contenido, r.Fecha, u.Nick FROM respuesta as r JOIN usuario as u on u.IDUsuario = r.FK_Usuario WHERE FK_Comentario = $this->IDComentario";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
            while ($fila = mysqli_fetch_assoc($result)) {  
                echo "<div class='col-9'>";
                echo "<div class='card bg-transparent border-dark'>";
                echo "<div class='card-header'><strong>".$fila['Nick'].", ".explode(' ',$fila['Fecha'])[0]."</strong></div>";
                echo "<div class='card-body'>".$fila['Contenido']."</div>";
                echo "<button class='btn btn-dark btn-sm mostrarOpciones'>•••</button>";
                echo "<button class='btn btn-success btn-sm editarComent respuesta' value='$fila[IDRespuesta]' style='display:none;'>&#9998</button>";
                echo "<button class='btn btn-danger btn-sm eliminarComent respuesta' style='display:none;' value='$fila[IDRespuesta]'>&#10006</button>";
                echo "</div>";
                echo "<a class='responder' href=''>Responder</a>";
                echo "</div>";
            }
                echo "<div class='col-12 mb-3'>&nbsp;</div>";
            }
            

        mysqli_close($conn);
    }

    public function eliminarComentario($respuesta = false){
        $conn = $this->conn->Conectar();
        if (!$respuesta) {
            $sql = "DELETE FROM comentario WHERE IDComentario = $this->IDComentario";  
        }else{
            $sql = "DELETE FROM respuesta WHERE IDRespuesta = $this->IDComentario";  
        }
        
        if (mysqli_query($conn,$sql)) {
            return True;
        }

        mysqli_close($conn);
    }

    public function agregarRespuesta(){

    }

    public function setFKUsuario($par){
        $this->FK_Usuario = $par;
    }

    public function setID($par){
        $this->IDComentario = $par;
    }

    public function setComent($par){
        $this->Comentario = $par;
    }

    public function setIDPost($par){
        $this->idPost = $par;
    }


}


?>