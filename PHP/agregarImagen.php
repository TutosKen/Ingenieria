<?php
    session_start();
    include('../DB/Conectar.php');
    $conn = New Conexion;

// Primero subimos la imagen si existe
$id = $conn->getLastID() + 1;
$imagen = $_FILES['file']['name'];
$tamanno = $_FILES['file']['size'];

    if ($tamanno != 0) {
        $uploadOk = 1; 
        $location = "C:/AppServ/www/Animales/img/".$id.$imagen; 
        if($uploadOk == 0){ 
            echo 0;
        }else{ 
            if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){ 
                // echo "Exito";
                $URIexp = explode('/',$location);
                $URIFinal = "/".$URIexp[3]."/".$URIexp[4]."/".$URIexp[5];
                $URI = $URIFinal;
            }else{ 
                echo 0; 
            } 
        }
    }else{
        $URI = $_POST['URI'];
    }

// Se agrega la info a la db
$titulo = $_POST['titulo'];
$desc = $_POST['desc'];
$tags = $_POST['tags'];
$IDUsuario = $_SESSION['IDUsuario'];
$cats = $_POST['cat'];

if ($conn->agregarImagen($titulo,$desc,$tags,$IDUsuario,$URI)) {
    // Se obtiene el ID de la imagen que se acaba de agregar
    $id = $conn->getImagenPorURI($URI);

    // Se agregan las categorias a la tabla postxcategoria
    $elements = explode(',', $cats);    
    if ($conn->agregarPostXCategoria($id,$elements)) {
        echo "Exito";
    }
}

?>