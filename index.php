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
                <div class="col-12 mt-5">
                    <input type="text" class="form-control" placeholder="Buscar...">
                </div>

                <?php                    
                    $conn = New Conexion;
                    $conn->getImagenes();
                ?>

                <div class="col-6 col-md-3 mt-5">
                    <div class="imagen"><a href="#"><img class="miniatura" src="img/airtm.jpg" alt=""><h4 class="text-center">Hola</h4></a></div>
                </div>

                <div class="col-6 col-md-3 mt-5">
                    <div class="imagen"><a href="#"><img class="miniatura" src="img/airtm.jpg" alt=""><h4 class="text-center">Hola</h4></a></div>
                </div>

                <div class="col-6 col-md-3 mt-5">
                    <div class="imagen"><a href="#"><img class="miniatura" src="img/airtm.jpg" alt=""><h4 class="text-center">Hola</h4></a></div>
                </div>
                
                <div class="col-6 col-md-3 mt-5">
                    <div class="imagen"><a href="#"><img class="miniatura" src="img/airtm.jpg" alt=""><h4 class="text-center">Hola</h4></a></div>
                </div>

                <div class="col-6 col-md-3 mt-5">
                    <div class="imagen"><a href="#"><img class="miniatura" src="img/airtm.jpg" alt=""><h4 class="text-center">Hola</h4></a></div>
                </div>

                <div class="col-6 col-md-3 mt-5">
                    <div class="imagen"><a href="#"><img class="miniatura" src="img/airtm.jpg" alt=""><h4 class="text-center">Hola</h4></a></div>
                </div>

                <div class="col-6 col-md-3 mt-5">
                    <div class="imagen"><a href="#"><img class="miniatura" src="img/airtm.jpg" alt=""><h4 class="text-center">Hola</h4></a></div>
                </div>

            
            </div>
        </div>
        


        <?php
            require_once('PHP/JS.php');
        ?>
    </body>
</main>
</html>