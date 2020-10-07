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
            require_once('../../DB/Comentario.php');
        ?>
    <main>

        <div class="container tarjeta">

                <?php
                    if (isset($_GET['IDimagen'])) {
                        $miPost = New Publicacion;
                        $id = $_GET['IDimagen'];
                        $miPost->setID($id);
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

                
                <div class="row mb-3">
                    <div class="col-12 mt-5">
                    <h5>Comentarios</h5>
                        <!-- <h6 class="card-title"></h6> -->
                        <textarea class="form-control comentario bg-transparent mb-1 mt-3" id="textoComentario" placeholder="Agregar comentario..." cols="30" rows="1"></textarea>
                        <hr class="trans--grow">
                        <span><button id="agregarComentario" class="btn btn-primary mt-1 border-0" style="display:none;" value="<?php echo $id?>">Agregar</button>
                        <button id="cancelarComentario" class="btn btn-dark mt-1 border-0" style="display:none;">Cancelar</button></span>
                    </div>

                </div>

                <div class="row" id="seccionComent">
                    <?php
                        $miComentario = New Comentario;
                        $postcom = $miComentario->getPostComentarios();

                        while ($fila = mysqli_fetch_assoc($postcom)) {
                            if ($fila['FK_Post'] == $id) {
                                $miComentario->setID($fila['FK_Comentario']);
                                $miComentario->getComentario();

                            }
                        }
                    
                    ?>


                </div>
        </div>
        


        <?php
            require_once('../JS.php');
        ?>
    </body>
</main>
</html>