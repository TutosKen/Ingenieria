<?php
session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once('../head.php');
    ?>
    <title><?php ?></title>
</head>
    <body>
        <?php
            require_once('../navbar.php');
            require_once('../../DB/Publicacion.php');
        ?>
    <main>

        <div class="container tarjeta">

                <?php
                    if (isset($_GET['IDimagen'])) {
                        $miPost = New Publicacion;
                        $miPost->setID($_GET['IDimagen']);
                        $miPost->aumentarCantVisitas();
                        $result = $miPost->getImagen();

                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<h2>".$row['Titulo']."</h2>";
                            echo "<div class='divImagenCompleta'><img class='imagenCompleta' src='".$row['URI']."'></div>";
                            echo "<div class='card bg-transparent border-dark' style='width: 100%;''>";
                            echo "<div class='card-header'>".$row['Nick'].", ".explode(' ',$row['Fecha_publicacion'])[0]."</div>";
                            echo "<div class='card-body'>".$row['Descripcion']."";
                            echo "<h5 class='mt-2'>Tags</h5>";
                            echo "<p>".$row['Tags']."</p>";
                            echo "</div>";
                            echo"</div>";
                        }
                    }
                ?>

                <div class="col-12 mt-5 mb-4">
                    <!-- <h6 class="card-title"></h6> -->
                    <textarea class="form-control comentario" id="textoComentario" placeholder="Agregar comentario..." cols="30" rows="4"></textarea>
                    <span><button id="agregarComentario" class="btn btn-success mt-1" style="display:none;">Agregar</button>
                    <button id="cancelarComentario" class="btn btn-danger mt-1" style="display:none;">Cancelar</button></span>
                </div>

                <div class="col-11">
                    <div class="card bg-transparent border-dark" style="width:100%">
                    <div class="card-header">Usuario</div>
                    <div class="card-body">Contenido aqui</div>

                    </div>
                </div>
            
        </div>
        


        <?php
            require_once('../JS.php');
        ?>
    </body>
</main>
</html>