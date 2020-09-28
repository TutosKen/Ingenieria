<?php
session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once('PHP/head.php');
    ?>
    <title>Animales</title>
</head>
    <body>
        <?php
            require_once('PHP/navbar.php');
            require_once('DB/Conectar.php');
        ?>
    <main>

        <div class="container tarjeta">
            <div class="row">
                <div id="barraBusqueda" class="col-12 mt-5">
                    <input id="buscar" type="text" class="form-control" placeholder="Buscar...">
                </div>

                <?php                    
                    $conn = New Conexion;
                    $conn->getImagenes();
                ?>
            
            </div>
        </div>
        


        <?php
            include('PHP/JS.php');
        ?>
    </body>
</main>
</html>