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
                    $result = $conn->getImagenes();

                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='animarImagen col-6 col-md-3 mt-5'>";
                        echo "<div class='imagen'><a href='/Animales/PHP/Post.php?IDimagen=".$row['IDPost']."'><img class='miniatura' src='".$row['URI']."'><h5 class='text-center'>".$row['Titulo']."</h5></a></div>";
                        echo "<div class='vistas'>👁<strong>".$row['CantVistas']."</strong></div>";
                        echo"</div>";
                    }
                ?>
            
            </div>
        </div>
        


        <?php
            include('PHP/JS.php');
        ?>
    </body>
</main>
</html>