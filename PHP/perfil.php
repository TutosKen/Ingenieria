<?php
session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once('head.php');
    ?>
    <title>Animales</title>
</head>
    <body>
        <?php
            require_once('navbar.php');
            require_once('../DB/Conectar.php');
        ?>
    <main>

        <div class="container tarjeta">
            <div class="row" style="background-color:#d0dadb; border-radius:7px;">
                <div class="col-7 col-md-6 mt-2">
                    <img class="imagen-usuario" src="../img/LogoUsuario/usuario.jpg" alt="">
                </div>

                <div class="col-5 col-md-6">
                        <p class="fuenteGrande">Publicaciones</p>
                        <p class="fuenteGrande ml-4" style="margin-top:-10px;">30</p>
                </div>

                <div class="col-12 col-md-12 mt-1">
                    <p class="fuenteGrande">TutosKen</p>
                    <p class="fuenteGrande" style="margin-top:-10px;">Keneth Chaves Cubero</p>
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
            </div>
        </div>
        


        <?php
            include('JS.php');
        ?>
    </body>
</main>
</html>