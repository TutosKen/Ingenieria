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
            require_once('DB/Publicacion.php');
            $miPost = New Publicacion;;
        ?>
    <main>

        <div class="container tarjeta">
            <div class="row">
                <div id="barraBusqueda" class="col-9 mt-5">
                    <input id="buscar" type="text" class="form-control" placeholder="Buscar...">
                </div>


                <div id="btnFiltro" class="col-3 mt-5 dropdown">
                    <button class="btn btn-info btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="img/imgsPagina/filtro.png" alt="" height="20"></button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <?php 
                    $filtro = $miPost->getCategorias();
                    echo "<a href='/Animales/' class='dropdown-item' style='color:black !important'>Todos</a>";

                    while($row = mysqli_fetch_assoc($filtro)) {
                        echo "<a href='javascript:{}' class='dropdown-item especial' style='color:black !important'>".$row['Nombre']."</a>";
                    }

                    ?>

                </div>
                </div>
                

                <?php                    
                    $result = $miPost->getImagenes();

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
            require_once('PHP/JS.php');
        ?>
    </body>
</main>
</html>