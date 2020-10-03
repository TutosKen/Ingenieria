<?php
session_start();
require_once('Conectar.php');

class Comentario{
    private $IDComentario;
    private $Comentario;
    private $Fecha;
    private $FK_Usuario;
    private $conn;




    public function __construc(){
        $this->conn = New Conexion;
    }


    public function agregarComentario(){
        $conn = $this->conn->Conectar();
        $comentario = mysqli_real_escape_string($conn,$this->Comentario);
            
            $sql = "INSERT INTO Comentario(Comentario,FK_Usuario) VALUES('$Comentario',$this->FK_Usuario)";

                if (mysqli_query($conn,$sql)) {
                    return True;
                }else{
                    return False;
                }

        mysqli_close($conn);

    }

    public function modificarComentario(){

    }

    public function eliminarComentario(){

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



}


?>