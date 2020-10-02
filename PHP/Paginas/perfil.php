<?php
session_start();
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
                        <p class="fuenteGrande ml-1" style="margin-top:-10px;"><?php echo $miUsuario->getCantPosts();?></p>
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
                        echo "<div class='animarImagen col-6 col-md-3 mt-5'>";
                        echo "<div class='imagen'><a href='/Animales/PHP/Post.php?IDimagen=".$row['IDPost']."'><img class='miniatura' src='".$row['URI']."'><h5 class='text-center'>".$row['Titulo']."</h5></a></div>";
                        echo "<div class='vistas'>👁<strong>".$row['CantVistas']."</strong></div>";
                        echo"</div>";
                    }
                ?>
            </div>
        </div>
        


        <?php
            require_once('../JS.php');
        ?>
            </div>
            </div>
    </body>
</main>
</html>