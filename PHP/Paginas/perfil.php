<?php
session_start();
if (!isset($_SESSION['IDUsuario'])) {
    header('location: /Animales/');
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once('../head.php');
    ?>
    <title>Animales</title>
</head>
    <body>
        <?php
            require_once('../navbar.php');
            require_once('../../DB/Usuario.php');

            $miUsuario = New Usuario;
            $miUsuario->setID($_SESSION['IDUsuario']);
            $infoUsuario = $miUsuario->getInfoUsuario();

            while($row = mysqli_fetch_assoc($infoUsuario)) {
                $Nombre = $row['Nombre']." ". $row['Apellido'];
                $UserName = $row['Nick'];
            }
        ?>
    <main>

        <div class="container tarjeta">
            <div class="row" style="background-color:#bfdbde; border-radius:7px;">
                <div class="col-7 col-md-6 mt-2">
                    <img class="imagen-usuario" src="../../img/LogoUsuario/usuario.jpg" alt="">
                </div>

                <div class="col-5 col-md-6">
                        <p class="fuenteGrande">Publicaciones</p>
                        <p id="cantPosts" class="fuenteGrande ml-1" style="margin-top:-10px;"><?php echo $miUsuario->getCantPosts();?></p>
                </div>

                <div class="col-12 col-md-12 mt-1">
                    <p class="fuenteGrande"><?php echo $UserName; ?></p>
                    <p class="fuenteGrande" style="margin-top:-10px;"><?php echo $Nombre; ?></p>
                </div>

                <div class="col-12 col-md-12 text-center mb-3">
                        <button id="modificarPerfil" class="btn btn-dark" style="width:100%">
                            Editar
                        </button>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-12 mt-4">
                    <h4 class="text-center">Mis publicaciones</h4>
                </div>

                <?php

                    $infoPost = $miUsuario->getPostsUsuario();
                    while($row = mysqli_fetch_assoc($infoPost)) {
                        // &#8230;
                        echo "<div class='animarImagen col-6 col-md-3 mt-5'>";
                        echo "<button class='showBtns modelm btn btn-sm btn-dark' style='border:none;'>•••</button>";
                        echo "<button class='editarPost btn btn-sm btn-success' onclick='editar(".$row['IDPost'].")' style='border:none; display:none;'>&#9998</button>";
                        echo "<button class='eliminarPost btn btn-sm btn-danger' value='".$row['IDPost']."' style='border:none; display:none;'>&#10006</button>";
                        echo "<div class='imagen'><a href='/Animales/PHP/Paginas/Post.php?IDimagen=".$row['IDPost']."'><img class='miniatura' src='".$row['URI']."'><h5 class='text-center'>".$row['Titulo']."</h5></a></div>";
                        echo "<div class='vistas'>👁<strong>".$row['CantVistas']."</strong></div>";
                        echo"</div>";
                    }
                ?>
            </div>

            <div class="col-12 mt-5">
                <div id="postElim" class="alert alert-success esconder" role="alert">
                        Publicacion eliminada correctamente
                </div>
            </div>
        </div>
        


        <?php
            require_once('../JS.php');
        ?>
            </div>
            </div>
            <script>
                function editar(id){
                    window.location.replace("/Animales/PHP/Paginas/editarPost.php?IDimg="+id);
                }
            </script>
    </body>
</main>
</html>