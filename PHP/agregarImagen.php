<?php
    session_start();
    require_once('../DB/Publicacion.php');
    $miPost = New Publicacion;

// Primero subimos la imagen si existe
$id = $miPost->getLastID() + 1;
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
                $miPost->setURI($URIFinal);
            }else{ 
                echo 0; 
            } 
        }
    }else{
        $miPost->setURI($_POST['URI']);
    }

// Se agrega la info a la db
$cats = $_POST['cat'];

$miPost->setTitulo($_POST['titulo']);
$miPost->setDescripcion($_POST['desc']);
$miPost->setTags($_POST['tags']);
$miPost->setFKUsuario($_SESSION['IDUsuario']);

if ($miPost->agregarImagen()) {
    // Se obtiene el ID de la imagen que se acaba de agregar
    $id = $miPost->getImagenPorURI();

    // Se agregan las categorias a la tabla postxcategoria
    $elements = explode(',', $cats);    
    if ($miPost->agregarPostXCategoria($id,$elements)) {
        echo "Exito";
    }
}

?>